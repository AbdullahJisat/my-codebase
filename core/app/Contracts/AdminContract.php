<?php

namespace App\Contracts;

interface AdminContract extends BaseContract
{
  public function dataList(array $columns = ['*'], array $relations = []);
}
