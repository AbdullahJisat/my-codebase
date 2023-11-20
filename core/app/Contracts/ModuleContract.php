<?php

namespace App\Contracts;

interface ModuleContract extends BaseContract
{
  public function dataList(array $columns = ['*'], array $relations = []);
}
