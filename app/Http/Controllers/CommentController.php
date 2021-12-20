<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index(Request $request){
        $comments = Comment::orderBy('created_at', 'DESC')->with(array('user' => function($query) {
            $query->select('id', 'first_name', 'last_name');
        }));

        if(!isset($request->allComments)){
            $comments = $comments->take(7);
        }

        $commentsCount = Comment::all()->count();

        $respnse = [
            'comments' => $comments->get(),
            'commentCount' => $commentsCount
        ];

        return $respnse;
    }

    public function create(Request $request){
        $newComment = new Comment;
        $newComment->comment_text = $request->comment['comment_text'];
        $newComment->user_id = auth()->user()->id;
        $newComment->save();

        return $newComment;
    }

    public function destroy($id){
        $comment = Comment::where('user_id', auth()->user()->id)->where('id', $id)->first();
        if($comment){
            $comment->delete();
            return response('deleted', 201);
        }

        return "Item not found";

    }
}
