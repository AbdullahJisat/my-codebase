<?php

namespace App\Contracts;

interface RoleContract extends BaseContract
{
    public function dataList(array $columns = ['*'], array $relations = []);
}
