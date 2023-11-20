<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends BaseModel
{
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_permissions');
    }
}
