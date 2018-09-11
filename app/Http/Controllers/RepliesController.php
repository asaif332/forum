<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Reply;
use Auth;

class RepliesController extends Controller
{
    public function like($id)
    {

        $like = Like :: create([
            'user_id' => Auth :: id(),
            'reply_id' => $id,
        ]);

        if ($like) {
            return redirect()->back()->with('success' , 'You liked');
        }
        return redirect()->back();
    }

    public function unlike($id)
    {

        $like = Like :: where('user_id' , Auth :: id())->where('reply_id' , $id)->first();

        if ($like->delete()) {
            return redirect()->back()->with('error' , 'You unliked');
        }
        return redirect()->back();
    }
}
