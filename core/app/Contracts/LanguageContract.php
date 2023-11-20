<?php

namespace App\Contracts;

interface LanguageContract extends BaseContract
{
  public function store(array $payload);
}
