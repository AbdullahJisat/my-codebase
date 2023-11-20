<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Contracts\ModuleContract;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    use ResponseMessage;
    protected $moduleContract;

    public function __construct(ModuleContract $moduleContract)
    {
        $this->moduleContract = $moduleContract;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.module.index');
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
        $params['search_name'] = $request->search_name;
        $params['draw'] = $request->input('draw');

        return $this->moduleContract->dataList($params, ['parent']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function load()
    {
        try {
            dd(moduleList());
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage(),
            ]);
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
    public function store(StoreModuleRequest $request)
    {
        try {
            $this->moduleContract->create($request->all());
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
                "status" => 'success',
                "message" => "Product retrieved successfully.",
                "module" => $this->moduleContract->findById($id),
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
    public function update(UpdateModuleRequest $request, string $id)
    {
        try {
            $this->moduleContract->update($id, $request->all());
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
                $this->moduleContract->deleteById($id);
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
            $this->moduleContract->deleteMultiple($request->id);
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

    public function changeStatus(Request $request)
    {
        try {
            if ($request->id) {
                return $this->responseSuccess($this->moduleContract->update($request->id, ['status' => $request->status]), 'Status change sucessfully');
            } else {
                return $this->responseError(null, 'Data not found', 400);
            }
        } catch (\Throwable $th) {
            return $this->responseError(null, $th->getMessage(), 400);
        }
    }
}
