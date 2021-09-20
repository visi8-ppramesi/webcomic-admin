<?php
namespace App\Traits;

use App\Filters\Get;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Str;

trait Pipeable{
    protected $pipeableThrough = [
        Get::class
    ];

    public function pipeable(){
        return $this->pipeableThrough;
    }

    public static function pipe($pipeableObject = null, $queryParams = []){
        if(empty($pipeableObject)){
            $pipeableObject = self::query();
        }

        if(!empty($queryParams)){
            foreach($queryParams as $key => $value){
                $requestName = class_exists($key) ? Str::snake(class_basename($key)) : $key;
                request()->merge([$requestName => $value]);
            }
        }

        $self = new static;
        return app(Pipeline::class)
            ->send($pipeableObject)
            ->through($self->pipeable())
            ->thenReturn();
    }
}
