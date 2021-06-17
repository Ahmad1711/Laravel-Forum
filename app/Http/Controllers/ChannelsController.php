<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Channel::all();

        return view('channels.index')->with('channels', $channels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('channels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'cname' => 'required'

        ]);

        $channel = new Channel;
        $channel->title = $request->cname;
        $channel->slug = str_slug($request->cname);
        $channel->save();
        session()->flash('success', 'Channel created successfully ');
        return redirect()->route('channels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $channel = Channel::where('slug', $slug)->first();
        return view('channels.show')->with('discussions', $channel->discussions()->paginate(5));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $channel = Channel::find($id);
        return view('channels.edit')->with('channel', $channel);
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
        $this->validate($request, [

            'cname' => 'required'

        ]);

        $channel = Channel::find($id);
        $channel->title = $request->cname;
        $channel->save();
        session()->flash('success', 'Channel updated successfully ');
        return redirect()->route('channels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $channel = Channel::find($id);
        foreach ($channel->discussions as $discussion) {
            foreach ($discussion->replies as $reply) {
                $reply->forcedelete();
            }
            $discussion->forcedelete();
        }
        $channel->delete();
        session()->flash('success', 'Channel deleted successfully ');
        return redirect()->route('channels.index');
    }
}
