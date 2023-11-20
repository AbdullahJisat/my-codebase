<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\PermissionContract;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    protected $permissionContract;

    public function __construct(PermissionContract $permissionContract)
    {
        $this->permissionContract = $permissionContract;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.permission.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        $params['order'] = $request->input('order.0.column');
        $params['direction'] = $request->input('order.0.dir');
        $params['length'] = $request->input('length');
        $params['start']     = $request->input('start');
        $params['search_name'] = $request->search_query;
        $params['search_module_id'] = $request->search_module_id;
        $params['draw'] = $request->input('draw');

        return $this->permissionContract->dataList($params, ['module']);
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
    public function store(StorePermissionRequest $request)
    {
        try {
            $this->permissionContract->create($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Save successfully',
                'code' => 201
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'errors' => $e->getMessage(),
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
        try {
            if (empty($id)) {
                return $this->sendError('Product not found.');
            }
            return response()->json([
                "status" => true,
                "message" => "Product retrieved successfully.",
                "permission" => $this->permissionContract->findById($id),
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 400
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, string $id)
    {
        try {
            $this->permissionContract->update($id, $request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Update successfully',
                'code' => 201
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'errors' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if (!empty($id)) {
                $this->permissionContract->deleteById($id);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Delete successfully',
                    'code' => 200
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unable to delete data.',
                    'code' => 400
                ]);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 400
            ]);
        }
    }
    public function bulkDelete(Request $request)
    {
        try {
            $this->permissionContract->deleteMultiple($request->id);
            return response()->json([
                'status' => 'success',
                'message' => 'Delete successfully',
                'code' => 200
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 400
            ]);
        }
    }
}
