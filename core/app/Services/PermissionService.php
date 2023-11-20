<?php

namespace App\Services;

use App\Interfaces\IPermission;

class PermissionService extends BaseService
{
    protected $permission;

    public function __construct(IPermission $ipermission)
    {
        parent::__construct($ipermission);
        $this->permission = $ipermission;
    }

    public function store(array $payload)
    {
        $payload = collect($payload);
        $slug = str()->slug($payload['name']);
        $payload = $payload->merge(compact('slug'));
        return $this->interface->create($payload->all());
    }
}
