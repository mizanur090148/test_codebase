<?php


namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $orderBy
     * @param string $order
     * @return \Illuminate\Support\Collection
     */
    function all($orderBy = 'created_at', $order = 'desc')
    {
        return $this->model->orderBy($orderBy, $order)->get();
    }

    /**
     * @param int $perPage
     * @param string $orderBy
     * @param string $order
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    function paginate($perPage = 15, $orderBy = 'created_at', $order = 'desc')
    {
        return $this->model->orderBy($orderBy, $order)->paginate($perPage);
    }

    /**
     * @param $id
     * @return Model|mixed
     */
    function find($id)
    {
        $result = $this->model->find($id);
        if (empty($result)) {
            throw new NotFoundResourceException("No result found!");
        }
        return $result;
    }

    /**
     * @param array $data
     * @return Model
     */
    function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @return bool
     */
    function storeAll(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return Model|mixed
     */
    function update($id, array $data)
    {
        $result = $this->model->find($id);
        if (empty($result)) {
            throw new NotFoundHttpException("No result found!");
        }
        $result->update($data);
        return $this->find($id);
    }

    /**
     * @param $id
     * @return bool|null
     */
    function delete($id)
    {
        $result = $this->model->find($id);
        if (empty($result)) {
            throw new NotFoundResourceException("No result found!");
        }
        return $result->delete();
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }
}