<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Reply;
use Auth;
use Notification;

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
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'channel_id' => 'required',
        ]);
    

        $discussion = Discussion :: create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'slug' => str_slug($request->title),
            'channel_id' => $request->input('channel_id'),
            'user_id' => Auth :: id(),
        ]);

        if ($discussion) {
            return redirect()->route('forum')->with('success','Discussion created successfully');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function replySave($id)
    {
        $request = request();
        $request->validate([
            'reply' => 'required',
        ]);

    
        $reply = Reply :: create([
            'content' => $request->reply,
            'user_id' => Auth :: id(),
            'discussion_id' => $id,
        ]);

        $discussion = Discussion :: find($id);

        $watchers = [];

        foreach($discussion->watchers as $watcher){
            array_push($watchers , $watcher->user);
        }

        Notification :: send($watchers , new \App\Notifications\NewReplyAdded($discussion));

        if ($reply) {
            return redirect()->back()->with('info' , 'You successfully replied');
        }
        return redirect()->back()->withInput();
    }

    public function display($slug)
    {
        return view('discussions.display' , ['discussion' => Discussion :: where('slug' , $slug)->first()]);
    }
}
