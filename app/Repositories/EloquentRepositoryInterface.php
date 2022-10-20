<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    /**
     * Get all models.
     *
     * @param  mixed $columns
     * @param  mixed $relations
     * @return Colletion
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Get all trashed models.
     *
     * @return Collection
     */
    public function allTrashed(): Collection;

    /**
     * Find model by id.
     *
     * @param  mixed $modelId
     * @param  mixed $columns
     * @param  mixed $relations
     * @param  mixed $appends
     * @return Model
     */
    public function findById(int $modelId, array $columns = ['*'], array $relations = [], array $appends = []): ?Model;

    /**
     * Find trashed model by id.
     *
     * @param  mixed $modelId
     * @return Model
     */
    public function findTrashedById(int $modelId): ?Model;

    /**
     * Find only trashed model by id.
     *
     * @param  mixed $modelId
     * @return Model
     */
    public function findOnlyTrashedById(int $modelId): ?Model;

    /**
     * Create a model
     *
     * @param  mixed $payload
     * @return Model
     */
    public function create(array $payload): Model;

    /**
     * Update a model
     *
     * @param  mixed $modelId
     * @param  mixed $payload
     * @return Model
     */
    public function update(int $modelId, array $payload): bool;


    /**
     * Delete model by id
     *
     * @param  mixed $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool;

    /**
     * Restore model by id.
     *
     * @param  mixed $modelId
     * @return bool
     */
    public function restoreById(int $modelId): bool;

    /**
     * Permanently delete model by id.
     *
     * @param  mixed $modelId
     * @return bool
     */
    public function permanentlyDeleteById(int $modelId): bool;
}
