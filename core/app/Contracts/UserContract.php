<?php

namespace App\Contracts;

interface UserContract extends BaseContract
{
  public function dataList(array $columns = ['*'], array $relations = []);
}
