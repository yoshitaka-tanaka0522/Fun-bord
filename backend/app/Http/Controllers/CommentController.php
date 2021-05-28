<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\BulletinBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BulletinBoard $bulletin, Request $request)
    {
        //
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->bulletin_board_id = $bulletin->id;
        $comment->user_id = Auth::user()->id;
        $comment->save();
        return redirect()->route('bulletin.show', $bulletin);
    }

 
}
