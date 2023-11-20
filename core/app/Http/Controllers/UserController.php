<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use ResponseMessage;
    protected $userContract;

    /**
     * __construct
     *
     * @param  mixed $userContract
     * @return void
     */
    public function __construct(UserContract $userContract)
    {
        $this->userContract = $userContract;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->can('view-user')) {
            return view('user.index');
        } else {
            abort(401);
        }
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
        $params['search_query'] = $request->search_query;
        $params['draw'] = $request->input('draw');

        return $this->userContract->dataList($params, []);
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
        if (auth()->user()->can('create-user')) {
            try {
                $this->userContract->create($request->all());
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
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
                'code' => 401
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id = null)
    {
        $user = $this->userContract->findById($id);
        return view('user.profile', compact('user'));
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
                "user" => $this->userContract->findById($id),
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
    public function update(Request $request, string $id)
    {
        try {
            $this->userContract->update($id, $request->all());
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
    public function updateProfile(Request $request, int $id)
    {
        if ($request->hasFile('profile')) {
            try {
                $profile = fileUploader($request->profile, getFilePath('userProfile'), getFileSize('userProfile'), $request->profile);
                // dd($profile);
                $this->userContract->update($id, ['profile' => $profile]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Update successfully',
                    'code' => 201
                ], 201);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Image cannot uploaded',
                    'errors' => $e->getMessage(),
                ], 422);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if (!empty($id)) {
                $this->userContract->deleteById($id);
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

    /**
     * bulkDelete
     *
     * @param  mixed $request
     * @return void
     */
    public function bulkDelete(Request $request)
    {
        try {
            $this->userContract->deleteMultiple($request->id);
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

    /**
     * changeStatus
     *
     * @param  mixed $id
     * @param  mixed $status
     * @return void
     */
    public function changeStatus(Request $request)
    {
        try {
            if ($request->id) {
                return $this->responseSuccess($this->userContract->update($request->id, ['status' => $request->status]), 'Status change sucessfully');
            } else {
                return $this->responseError(null, 'Data not found', 400);
            }
        } catch (\Throwable $th) {
            return $this->responseError(null, $th->getMessage(), 400);
        }
    }
}
