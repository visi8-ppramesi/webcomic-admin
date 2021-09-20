<?php

namespace App\Models;

use App\Traits\Pipeable;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use Pipeable;
    protected $guarded = [];
    public function comics(){
        return $this->belongsToMany(Comic::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
