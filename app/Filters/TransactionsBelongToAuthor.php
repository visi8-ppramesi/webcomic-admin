<?php

namespace App\Filters;

class TransactionsBelongToAuthor extends Filter{
    public $noParam = false;
    protected $onlyModels = [
        TokenTransaction::class,
    ];
    protected function applyFilter($builder){
        $qv = $this->getRequestFilterValue();
        return $builder->whereHas('authors', function($q)use($qv){
            $q->where('authors.id', $qv);
        });
    }
}
