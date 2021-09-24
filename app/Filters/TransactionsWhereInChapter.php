<?php

namespace App\Filters;

class TransactionsWhereInChapter extends Filter{
    public $noParam = false;
    protected function applyFilter($builder){
        $chapters = $this->getRequestFilterValue();
        $chapters = gettype($chapters) == 'string' ? json_decode($chapters) : $chapters;
        return $builder->whereIn('transactionable_id', $chapters);
    }
}
