<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ModuleContract;
use App\Contracts\AdminContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    protected $moduleContract;
    protected $adminContract;

    /**
     * __construct
     *
     * @param  mixed $moduleContract
     * @return void
     */
    public function __construct(ModuleContract $moduleContract, AdminContract $adminContract)
    {
        $this->moduleContract = $moduleContract;
        $this->adminContract = $adminContract;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getPermissions(Request $request)
    {
        if ($request->ajax() && !empty($request->adminId)) {
            $admin = $this->adminContract->findById($request->adminId, ['*'], ['modules', 'permissions']);
            // dd($admin->modules);
            $module = '';
            $modules = $this->moduleContract->all(['*'], ['permissions']);
            if (!empty($modules)) {
                // dd($modules);
                foreach ($modules as $value) {
                    $checked = ($admin->modules()->where('module_id', $value->id)->exists()) ? 'checked' : '';
                    $checkRelation = ($value->permissions()->exists()) ? "<i class='indicator fas fa-plus-square'></i>" : "";
                    $module .= "<li class='branch'>{$checkRelation}<input type='checkbox' name='module_id[]' value='{$value->id}' {$checked}> {$value->name}
                <ul>";
                    if ($value->permissions()->exists()) {
                        foreach ($value->permissions as $key => $permission) {
                            $checked = ($admin->permissions()->where('permission_id', $permission->id)->exists()) ? 'checked' : '';
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
            $admin = $this->adminContract->findById($request->adminId);
            $admin->modules()->detach();
            $admin->permissions()->detach();
            $admin->modules()->attach($request->module_id);
            $admin->permissions()->attach($request->permission_id);
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
