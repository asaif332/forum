<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Reply extends Model
{
    protected $fillable = ['content' , 'user_id' , 'discussion_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function discussion()
    {
        return $this->belongsTo('App\Discussion');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function has_already_liked()
    {
        $id = Auth :: id();
        $likers = [];

        foreach($this->likes as $like){
            array_push($likers , $like->user_id);
        }

        if (in_array($id , $likers)) {
            return true;
        }

        return false;
    }
}
