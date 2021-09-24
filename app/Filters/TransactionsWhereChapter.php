<?php

namespace App\Filters;

use App\Models\Chapter;

class TransactionsWhereChapter extends Filter{
    public $noParam = false;
    protected function applyFilter($builder){
        return $builder
            ->where('transactionable_type', Chapter::class)
            ->where('transactionable_id', $this->getRequestFilterValue());
    }
}
