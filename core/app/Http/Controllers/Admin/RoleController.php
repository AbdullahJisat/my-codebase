<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\RoleContract;
use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;

class RoleController extends Controller
{
    protected $roleContract;

    public function __construct(RoleContract $roleContract)
    {
        $this->roleContract = $roleContract;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->guard('admin')->user()) {
            return view('pages.role.index');
        } else if (auth()->user()->can('view-role')) {
            return view('user.role.index');
        } else {
            abort(401);
        }
    }

    /**
     * Display a listing of the resource on datatable.
     */
    public function list(Request $request)
    {
        $params['order'] = $request->input('order.0.column');
        $params['direction'] = $request->input('order.0.dir');
        $params['length'] = $request->input('length');
        $params['start']     = $request->input('start');
        $params['search_query'] = $request->search_query;
        $params['draw'] = $request->input('draw');

        return $this->roleContract->dataList($params, ['parent']);
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
    public function store(StoreRoleRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 405);
        }
        try {
            $this->roleContract->create($request->all());
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
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            if (empty($id)) {
                return $this->sendError('Product not found.');
            }
            return response()->json([
                "status" => true,
                "message" => "Product retrieved successfully.",
                "role" => $this->roleContract->findById($id),
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
    public function update(UpdateRoleRequest $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }
        try {
            $this->roleContract->update($id, $request->all());
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
    public function destroy($id)
    {
        try {
            if (!empty($id)) {
                $this->roleContract->deleteById($id);
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
            $this->roleContract->deleteMultiple($request->id);
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
