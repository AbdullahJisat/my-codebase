<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Interfaces\ITransaction;

class TransactionRepository extends BaseRepository implements ITransaction
{
    protected $model;

    /**
     * TransactionRepository constructor.
     *
     * @param Transaction $model
     */
    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    public function depositTransaction(array $columns = ['*'], array $relations = [])
    {
        return $this->model->deposit()->with($relations)->get($columns);
    }

    public function withdrawTransaction(array $columns = ['*'], array $relations = [])
    {
        return $this->model->withdraw()->with($relations)->get($columns);
    }
}
