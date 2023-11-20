<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends BaseModel
{
    protected $fillable = ['name', 'link', 'icon', 'sequence', 'parent_id', 'status'];

    public function parent()
    {
        return $this->belongsTo(Module::class);
    }

    public function child()
    {
        return $this->hasMany(Module::class, 'parent_id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'module_id', 'id');
    }
}
