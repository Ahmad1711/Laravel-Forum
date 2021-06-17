<?php

namespace App\Http\Controllers;

use App\Discussion;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($filter=null)
    {
        switch($filter){
            case 'me':
                $discussions = Discussion::where('user_id',Auth::id())->paginate(3);
                break;

            case 'answered':
                $answered=array();
                foreach(Discussion::all() as $discussion){
                    if($discussion->has_best_answer()){
                        array_push($answered,$discussion);
                    }
                }
                $discussions=new Paginator($answered,3);
                $discussions->withPath('/dashboard/answered');
                break;

            case 'unanswered':
                $unanswered = array();
                foreach (Discussion::all() as $discussion) {
                    if (!$discussion->has_best_answer()) {
                        array_push($unanswered, $discussion);
                    }
                }
                $discussions = new Paginator($unanswered,3);
                $discussions->withPath('/dashboard/unanswered');
                
                break;

            default:
                $discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);
        }
      
        return view('home')->with('discussions',$discussions);
    }
}
