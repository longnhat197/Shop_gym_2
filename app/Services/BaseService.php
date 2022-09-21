<?php

namespace App\Services;

class BaseService implements ServiceInterface
{
    public $repository;

    function all()
    {
        return $this->repository->all();
    }

    function find($id)
    {
        return $this->repository->find($id);
    }

    function create(array $data)
    {
        return $this->repository->create($data);
    }
    function update(array $data, $id)
    {
        return $this->repository->update($data, $id);
    }
    function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function searchAndPaginate($searchBy, $keyword, $perPage = 8){
        return $this->repository->searchAndPaginate($searchBy, $keyword, $perPage);
    }
}
