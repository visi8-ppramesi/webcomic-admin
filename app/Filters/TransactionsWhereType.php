<?php

namespace App\Filters;

class TransactionsWhereType extends Filter{
    public $noParam = false;
    protected function applyFilter($builder){
        return $builder->whereJsonContains('descriptor->type', $this->getRequestFilterValue());
    }
}
