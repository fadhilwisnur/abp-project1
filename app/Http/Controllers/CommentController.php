<?php

namespace App\Http\Controllers;

use App\Models\hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if(Auth::check())
        {
            $validator = Validator::make($request->all(),[
                'comment_body' => 'required|string'
            ]);

            if($validator->fails())
            {
                return redirect()->back()->with('message','comment area is mandatory');
            }

            $hotel = hotel::where('id', $request->post_slug)->first();
            if($hotel)
            {
                Comment::create([
                    'post_id' => $hotel->id,
                    'user_id' => auth()->user()->id,
                    'comment_body' => $request->comment_body
                ]);
                return redirect()->back();
            }
            else
            {
                return redirect()->back()->with('message','No Such Post Found');
            }
        }
        else
        {
            return redirect()->back()->with('message','login First to comment');
        }
    }
    public function destroy(Request $request)
    {
        if(Auth::check())
        {
            $comment = Comment::where('id', $request->comment_id)->where('user_id',Auth::user()->id)->first();
            $comment->delete();
            return response()->json([
                'status'=> 200,
                'message'=> 'Comment deleted Successfuly'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 401,
                'message'=> 'Login to delete this Comment'
            ]);
        }
    }
}
