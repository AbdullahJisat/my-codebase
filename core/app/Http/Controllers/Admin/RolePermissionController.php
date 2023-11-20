<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\ModuleContract;
use App\Contracts\RoleContract;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    protected $moduleContract;
    protected $roleContract;

    /**
     * __construct
     *
     * @param  mixed $moduleContract
     * @return void
     */
    public function __construct(ModuleContract $moduleContract, RoleContract $roleContract)
    {
        $this->moduleContract = $moduleContract;
        $this->roleContract = $roleContract;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd('dad');
        return view('pages.role.permissions');
    }

    public function getPermissions(Request $request)
    {
        if ($request->ajax() && !empty($request->roleId)) {
            $role = $this->roleContract->findById($request->roleId, ['*'], ['modules', 'permissions']);
            // dd($role->modules);
            $module = '';
            $modules = $this->moduleContract->all(['*'], ['permissions']);
            if (!empty($modules)) {
                // dd($modules);
                foreach ($modules as $value) {
                    $checked = ($role->modules()->where('module_id', $value->id)->exists()) ? 'checked' : '';
                    $checkRelation = ($value->permissions()->exists()) ? "<i class='indicator fas fa-plus-square'></i>" : "";
                    $module .= "<li class='branch'>{$checkRelation}<input type='checkbox' name='module_id[]' value='{$value->id}' {$checked}> {$value->name}
                <ul>";
                    if ($value->permissions()->exists()) {
                        foreach ($value->permissions as $key => $permission) {
                            $checked = ($role->permissions()->where('permission_id', $permission->id)->exists()) ? 'checked' : '';
                            $module .= "
                            <li><input type='checkbox' name='permission_id[]' value='{$permission->id}' {$checked}>{$permission->name}</li>";
                        }
                    }
                    $module .= "</ul></li>";
                }
                return $module;
            }
            return $module;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $role = $this->roleContract->findById($request->roleId);
            $role->modules()->detach();
            $role->permissions()->detach();
            $role->modules()->attach($request->module_id);
            $role->permissions()->attach($request->permission_id);
            return response()->json([
                'status' => true,
                'message' => 'Change successfully'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
