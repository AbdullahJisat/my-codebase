<?php

namespace App\Services;

use App\Interfaces\IRole;

class RoleService extends BaseService
{
    protected $role;

    public function __construct(IRole $irole)
    {
        parent::__construct($irole);
        $this->role = $irole;
    }

    public function store(array $payload)
    {
        $payload = collect($payload);
        $slug = str()->slug($payload['name']);
        $payload = $payload->merge(compact('slug'));
        return $this->interface->create($payload->all());
    }
}
