<?php

namespace App\Repositories;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    abstract public function getModel();

    function all()
    {
        return $this->model->all();
    }
    function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    function create(array $data)
    {
        return $this->model->create($data);
    }
    function update(array $data, $id)
    {
        $object = $this->model->find($id);
        return $object->update($data);
    }
    function delete($id)
    {
        $object = $this->model->find($id);
        return $object->delete();
    }
    /**
     */

    public function searchAndPaginate($searchBy, $keyword, $perPage = 8){
        return $this->model
        ->where($searchBy,'like','%' . $keyword . '%')
        ->orderBy('id', 'desc')
        ->paginate($perPage)
        ->appends(['search' =>$keyword]);
    }
}
