<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;


class Discussion extends Model
{
    protected $fillable = ['title' , 'content' , 'user_id' , 'channel_id' , 'slug'];

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function watchers()
    {
        return $this->hasMany('App\Watcher');
    }

    public function is_being_watched_by_auth_user()
    {
        $id = Auth :: id();

        $watchers_arr = [];
        foreach($this->watchers as $w){
            array_push($watchers_arr , $w->user->id);
        }

        if (in_array($id , $watchers_arr)) {
            return true;
        }
        return false;
    }
    
}
