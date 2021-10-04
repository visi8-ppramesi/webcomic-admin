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

    public function tokenTransactions(){
        return $this->belongsToMany(TokenTransaction::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function getTotalTokensAttribute(){
    //     $myId = $this->id;
    //     $comics = $this->comics->pluck('id');
    //     return TokenTransaction::whereHasMorph('transactionable',
    //         [Chapter::class],
    //         function($q)use($comics){
    //             $q->whereIn('comic_id', $comics);
    //         }
    //     )->get()->reduce(function($carry, $item)use($myId){
    //         $descriptor = json_decode($item->descriptor, true);
    //         return $carry + ($item->token_amount * $descriptor['author_split'][$myId]);
    //     }, 0);
    // }

    protected static function boot(){
        parent::boot();
        parent::deleting(function($author){
            $author->comics()->detach();
        });
    }
}
