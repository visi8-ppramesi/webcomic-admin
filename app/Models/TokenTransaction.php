<?php

namespace App\Models;

use App\Traits\Pipeable;
use Illuminate\Database\Eloquent\Model;

class TokenTransaction extends Model
{
    use Pipeable;
    protected $guarded = [];

    public function transactionable(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
