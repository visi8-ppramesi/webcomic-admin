<?php

namespace App\Services;

class Service{
    protected $fields, $data, $model;
    public $record;

    public function __construct(){

    }

    public function setRecord($model){
        $this->record = gettype($model) === 'integer' ? $this->model::find($model) : $model;
    }

    public function getRecord(){
        return $this->record;
    }

    public function setData($data){
        foreach($this->fields as $field){
            if(!empty($data[$field])){
                $this->data[$field] = $data[$field];
            }
        }
    }

    public function getData(){
        return $this->data;
    }

    public function create(){
        $this->record = $this->model::create($this->data);
    }

    public function update(){
        $this->record = tap($this->model::where('id', $this->record->id))->update($this->data)->first();
    }
}
