<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct()
    {
        $this->model = app()->make($this->getModel());
    }

    public function instance()
    {
        return $this->model;
    }

    public abstract function getModel();
}
