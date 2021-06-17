<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watcher;
use Illuminate\Support\Facades\Auth;

class WatchersController extends Controller
{
    public function watch($id)
    {
        $like = new Watcher;

        $like->user_id = Auth::id();
        $like->discussion_id = $id;

        $like->save();
        session()->flash('success', 'You are Watching this Discussion ');
        return redirect()->back();
    }

    public function unwatch($id)
    {

        $like = Watcher::where('discussion_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();
        session()->flash('success', 'You are no longer watching this Discussion ');
        return redirect()->back();
    }

}
