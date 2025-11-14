<?php

namespace App\Services;

abstract class BaseService implements ServiceInterface
{
    protected $repo;

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    abstract public function repo();

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->makeRepo();
    }

    public function makeRepo()
    {
        $repo = app()->make($this->repo());

        // if (! $repo instanceof Model) {
        //     throw new GeneralException("Class {$this->model()} must be an instance of ".Model::class);
        // }

        return $this->repo = $repo;
    }

    /**
     * @return fixed
     */
    public function create(array $data = [])
    {
        return $this->repo->create($data);
    }

    /**
     * @param  int  $limit
     * @param  string  $pageName
     * @param  null  $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($limit = 25, array $columns = ['*'], $pageName = 'page', $page = null)
    {
        return $this->repo->paginate($limit, $columns, $pageName, $page);
    }

    /**
     * Get all the model records in the database.
     *
     *
     * @return Collection|static[]
     */
    public function getAll(array $columns = ['*'])
    {
        return $this->repo->all($columns);
    }

    public function getData($request, array $columns = ['*'])
    {
        $limit = $request->limit;
        $sortBy = $request->sort;
        $sortDirection = $request->direction;
        $query = $this->repo;
        $query = $this->repo->search($query, $request);

        if ($sortBy) {
            $query = $query->orderBy($sortBy, $sortDirection ?? 'asc');
        }

        if ($limit) {
            $query = $query->limit($limit);
        }
        $data = $query->get();

        if ($request->check) {
            return count($data);
        }

        return $data;
    }

    /**
     * Get all the model records in the database.
     *
     *
     * @return Collection|static[]
     */
    public function search($request, array $columns = ['*'])
    {
        $attribute = 'name';
        $value = 'name';
        // return $this->repo->where($attribute, $value)
        // $query = $this->repo->query();

        // foreach ($request->all() as $key => $value) {
        //     switch ($key) {
        //         case 'name':
        //         case 'category':
        //             $query->where($key, 'like', "%$value%");
        //             break;
        //         case 'color':
        //             $query->where($key, $value);
        //             break;
        //         // Add more cases for other fields
        //     }
        // }

        // return $query->get();

    }

    /**
     * Get the specified model record from the database.
     *
     *
     * @return Collection|Model
     */
    public function getById($id, array $columns = ['*'])
    {
        return $this->repo->getById($id, $columns);
    }

    /**
     * Update the specified model record in the database.
     *
     *
     * @return Collection|Model
     */
    public function updateById($id, array $data, array $options = [])
    {
        return $this->repo->updateById($id, $data, $options);
    }

    /**
     * Delete the specified model record from the database.
     *
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function deleteById($id): bool
    {
        return $this->repo->deleteById($id);
    }
}
