<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Watcher;
use Auth;

class WatchersController extends Controller
{
    public function watch($id)
    {
        $watch = Watcher :: create([
            'user_id' => Auth :: id(),
            'discussion_id' => $id,
        ]);

        if ($watch) {
            return redirect()->back()->with('info' , 'You are watching this discussion');
        }

        return redirect()->back();
    }

    public function unwatch($id)
    {
        $unwatch = Watcher :: where('user_id' , Auth :: id())->where('discussion_id' , $id)->first();

        if ($unwatch->delete()) {
            return redirect()->back()->with('info' , 'You are not watching this discussion');
        }

        return redirect()->back();
    }
}
