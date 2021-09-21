<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use tizis\laraComments\Entity\Comment as laraComment;

class Comment extends laraComment
{
    public function canUserDelete(User $user){
        return true;
    }

    protected static function boot(){
        parent::boot();
        parent::deleting(function($comment){
            $comment->children->map(function($cmt){$cmt->delete();});
        });
    }
}
