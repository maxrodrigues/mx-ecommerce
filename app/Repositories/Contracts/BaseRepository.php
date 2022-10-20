<?php

namespace App\Repositories\Contracts;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var mixed
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param  mixed $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all models.
     *
     * @param  mixed $coluns
     * @param  mixed $relations
     * @return Collection
     */
    public function all(array $coluns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($coluns);
    }

    /**
     * Get all trashed models.
     *
     * @return Collection
     */
    public function allTrashed(): Collection
    {
        return $this->model->onlyTrashed()->get();
    }

    /**
     * Find Model by id.
     *
     * @param  mixed $modelId
     * @param  mixed $columns
     * @param  mixed $relations
     * @param  mixed $appends
     * @return Model
     */
    public function findById(int $modelId, array $columns = ['*'], array $relations = [], array $appends = []): ?Model
    {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId)->append($appends);
    }

    /**
     * Find trashed Model by id.
     *
     * @param  mixed $modelId
     * @return Model
     */
    public function findTrashedById(int $modelId): ?Model
    {
        return $this->model->withTrashed()->findOrFail($modelId);
    }

    /**
     * Find only trashed Model by id.
     *
     * @param  mixed $modelId
     * @return Model
     */
    public function findOnlyTrashedById(int $modelId): ?Model
    {
        return $this->model->onlyTrashed()->findOrFail($modelId);
    }

    /**
     * Create a new model.
     *
     * @param  mixed $payload
     * @return Model
     */
    public function create(array $payload): Model
    {
        $model = $this->model->create($payload);
        return $model;
    }

    /**
     * Update a model.
     *
     * @param  mixed $modelId
     * @param  mixed $payload
     * @return bool
     */
    public function update(int $modelId, array $payload): bool
    {
        $model = $this->findById($modelId);
        return $model->update($payload);
    }

    /**
     * Delete mode by id.
     *
     * @param  mixed $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool
    {
        return $this->findById($modelId)->delete();
    }

    /**
     * Restore model by id.
     *
     * @param  mixed $modelId
     * @return bool
     */
    public function restoreById(int $modelId): bool
    {
        return $this->findOnlyTrashedById($modelId)->restore();
    }

    /**
     * Permanently delete model by id.
     *
     * @param  mixed $modelId
     * @return bool
     */
    public function permanentlyDeleteById(int $modelId): bool
    {
        return $this->findTrashedById($modelId)->forceDelete();
    }
}
