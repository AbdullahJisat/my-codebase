<?php

namespace App\Contracts;

interface PermissionContract extends BaseContract
{
  public function dataList(array $columns = ['*'], array $relations = []);
}
