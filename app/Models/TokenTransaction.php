<?php

namespace App\Models;

use App\Filters\Get;
use App\Filters\Limit;
use App\Filters\Search;
use App\Filters\SortByAsc;
use App\Filters\SortByDesc;
use App\Filters\TransactionsWhereChapter;
use App\Filters\TransactionsWhereType;
use App\Filters\WhereCreatedAfter;
use App\Filters\WhereCreatedBefore;
use App\Filters\WhereUserId;
use App\Filters\With;
use App\Traits\Pipeable;
use Illuminate\Database\Eloquent\Model;

class TokenTransaction extends Model
{
    use Pipeable;
    protected $guarded = [];

    public function pipeable(){
        return [
            Get::class,
            TransactionsWhereChapter::class,
            TransactionsWhereType::class,
            WhereCreatedAfter::class,
            WhereCreatedBefore::class,
            WhereUserId::class,
            SortByAsc::class,
            SortByDesc::class,
            With::class,
            Limit::class,
            Search::class,
        ];
    }

    public function transactionable(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
