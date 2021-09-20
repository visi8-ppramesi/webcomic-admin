<?php

namespace App\Models;

use App\Filters\Get;
use App\Filters\Limit;
use App\Filters\Search;
use App\Filters\With;
use App\Traits\Pipeable;
use Illuminate\Database\Eloquent\Model;
use tizis\laraComments\Contracts\ICommentable;
use tizis\laraComments\Traits\Commentable;

class Comic extends Model implements ICommentable
{
    use Commentable;
    use Pipeable;
    protected $guarded = [];

    public function pipeable(){
        return [
            Get::class,
            With::class,
            Limit::class,
            Search::class,
        ];
    }

    public function authors(){
        return $this->belongsToMany(Author::class);
    }

    public function pages(){
        return $this->hasMany(Page::class);
    }

    public function chapters(){
        return $this->hasMany(Chapter::class);
    }

    public function purchasedBy(){
        $whereName = implode('->', ['purchase_history', $this->id, 'id']);
        return User::where($whereName, $this->id)->get();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function favorited(){
        return $this->belongsToMany(User::class);
    }
}
