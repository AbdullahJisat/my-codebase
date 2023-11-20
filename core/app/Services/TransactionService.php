<?php

namespace App\Services;

use App\Interfaces\ITransaction;

class TransactionService extends BaseService
{
    protected $transaction;

    public function __construct(ITransaction $itransaction)
    {
        parent::__construct($itransaction);
        $this->transaction = $itransaction;
    }

    public function depositTransaction($columns, $relations)
    {
        return $this->transaction->depositTransaction($columns, $relations);
    }

    public function withdrawTransaction($columns, $relations)
    {
        return $this->transaction->withdrawTransaction($columns, $relations);
    }
}
