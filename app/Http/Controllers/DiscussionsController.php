<?php

namespace App\Http\Controllers;

use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DiscussionsController extends Controller
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
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required'
        ]);

        $discussion=new Discussion;
        $discussion->title=$request->title;
        $discussion->slug = str_slug($request->title);
        $discussion->content = $request->content;
        $discussion->user_id=Auth::id();
        $discussion->channel_id=$request->channel;
        $discussion->save();
        session()->flash('success', 'Discussion created successfully ');
        return redirect()->route('discussions.show',['slug'=>$discussion->slug]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */ 
    public function show($slug)
    {
        $discussion= Discussion::where('slug', $slug)->first();
        $best=$discussion->replies()->where('best_answer',1)->first();
        return view('discussions.show')->with('discussion',$discussion)->with('best',$best);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $discussion=Discussion::where('slug',$slug)->first();
        return view('discussions.update')->with('discussion',$discussion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request, [

            'content' => 'required'

        ]);
        $discussion = Discussion::where('slug', $slug)->first();
        $discussion->content=$request->content;
        $discussion->save();
        $best = $discussion->replies()->where('best_answer', 1)->first();
        return view('discussions.show')->with('discussion', $discussion)->with('best', $best);
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

   
}
