<?php

namespace App\Http\Controllers;

use App\Like;
use App\Discussion;
use App\Reply;
use App\User;
use App\Notifications\NewReplyadded;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $discussion = Discussion::where('slug', $request->slug)->first();

        $reply = new Reply;
        $reply->discussion_id = $discussion->id;
        $reply->user_id = Auth::id();
        $reply->content = $request->content;
        $reply->save();
        $reply->user->points+=25;
        $reply->user->save();

        $watchers=array();
        foreach($discussion->watchers as $watcher):
            array_push($watchers,User::find($watcher->user_id));
        endforeach;
        
        Notification::send($watchers,new NewReplyadded($discussion));

        session()->flash('success', 'Reply created successfully ');
        return redirect()->route('discussions.show', ['slug' => $discussion->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reply=Reply::find($id);
        return view('replies.update',['reply'=>$reply]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reply=Reply::find($id);
        $reply->content=$request->content;
        $reply->save();
        session()->flash('success', 'Reply Updated successfully ');
        return redirect()->route('discussions.show', ['slug' => $reply->discussion->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function like($id){

        $like=new Like;

        $like->user_id=Auth::id();
        $like->reply_id=$id;

        $like->save();
        session()->flash('success', 'You Liked the reply ');
        return redirect()->back();
    }

    public function unlike($id){

        $like=Like::where('reply_id',$id)->where('user_id',Auth::id())->first();
        $like->delete();
        session()->flash('success', 'You unLiked the reply ');
        return redirect()->back();

    }

    public function bestanswer($id){
        $reply=Reply::find($id);
        $reply->best_answer=1;
        $reply->save();
        $reply->user->points += 100;
        $reply->user->save();
        session()->flash('success', 'You select this reply as best answer ');
        return redirect()->back();
    }
}
