<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\Discussion;

class ChannelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('channels.index' , ['channels' => Channel :: all()]);
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
        $request->validate([
            'title' => 'required|unique:channels',
        ]);
        
        $channel = Channel :: create([
            'title' => $request->input('title'),
            'slug' => str_slug($request->title),
        ]);

        if ($channel) {
            return redirect()->route('channels.index')->with('sucess' , 'Channel added successfully');
        }

        return redirect()->back();
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
        return view('channels.edit' , ['channel' => Channel :: where('id' , $id)->first()]);
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
        $request->validate([
            'title' => 'required|unique:channels',
        ]);

        $channel = Channel :: where('id' , $id)->update([
            'title' => $request->input('title'),
            'slug' => $request->title,
        ]);

        if ($channel) {
            return redirect()->route('channels.index')->with('success' , 'Channel updated successfully');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Channel :: destroy($id)) {
            return redirect()->back()->with('success' , 'Channel deleted successfully');
        }
        return redirect()->back();
    }


    public function display($slug)
    {
        $channel = Channel :: where('slug' , $slug)->first();

        $discussions = Discussion :: where('channel_id' , $channel->id)->paginate(5);
        return view('channels.display' , ['discussions' => $discussions , 'channel' => $channel->title]);
    }
}
