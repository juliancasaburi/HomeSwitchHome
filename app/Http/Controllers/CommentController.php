<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'texto'=>'required',
        ]);

        $input = $request->all();
        if(auth()->user()){
            $input['usuario_id'] = auth()->user()->id;
        }
        else{
            $input['usuario_id'] = null;
        }

        Comment::create($input);

        return back();
    }
}