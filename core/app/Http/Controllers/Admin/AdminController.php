<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AdminContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use ReflectionClass;

class AdminController extends Controller
{
    use ResponseMessage;
    protected $adminContract;

    /**
     * __construct
     *
     * @param  mixed $adminContract
     * @return void
     */
    public function __construct(AdminContract $adminContract)
    {
        $this->adminContract = $adminContract;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $codeToAdd = "BaseContract::class => BaseRepository::class";

        // $appServiceProviderFile = app_path('Providers/RepositoryServiceProvider.php');

        // return $this->injectCodeToRegisterMethod($appServiceProviderFile, $codeToAdd);
        return view('admin.index');
    }
    // public function injectCodeToRegisterMethod($repositoryServiceProviderFile, $codeToAdd)
    // {
    //     $reflectionClass = new ReflectionClass(\App\Providers\RepositoryServiceProvider::class);
    //     $reflectionMethod = $reflectionClass->getProperty('repositories');

    //     $methodBody = file($repositoryServiceProviderFile);
    //     dd($reflectionMethod, $methodBody);

    //     $startLine = $reflectionMethod->getStartLine() - 1;
    //     $endLine = $reflectionMethod->getEndLine() - 1;

    //     array_splice($methodBody, $endLine, 0, $codeToAdd);
    //     $modifiedCode = implode('', $methodBody);

    //     file_put_contents($repositoryServiceProviderFile, $modifiedCode);
    // }

    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    // {
    //     // if ($request->ajax()) {
    //     // $params              = $request->except('_token');
    //     // $params['order']     = $request->input('order.0.column');
    //     // $params['direction'] = $request->input('order.0.dir');
    //     // $params['length']    = $request->input('length');
    //     // $params['start']     = $request->input('start');
    //     $_orderValue = $request->input('order.0.column');
    //     $_dirValue = $request->input('order.0.dir');
    //     $_lengthValue = $request->input('length');
    //     $_startValue = $request->input('start');
    //     $_searchString = $request->search_query;
    //     $list = $this->getList($_lengthValue, $_startValue, $_searchString);

    //     $data = array();
    //     $no = $_startValue;
    //     foreach ($list as $value) {
    //         $no++;
    //         $action = '';

    //         // $action .= "<button type='button' class='btn-sm btn-primary waves-effect waves-light editBtn' data-id='{$value->id}'><i class='mdi mdi-pencil d-block font-size-16'></i></button>";

    //         $action .= "<a href='javascript:void(0);' class='text-success editBtn' data-id='{$value->id}'><i class='mdi mdi-pencil font-size-18'></i></a>";

    //         // $action .= '&nbsp;&nbsp;&nbsp;';

    //         // $action .= "<button type='button' class='btn-sm btn-primary waves-effect waves-light deleteBtn' data-id='{$value->id}'><i class='mdi mdi-trash-can d-block font-size-16'></i></button>";

    //         $action .= "<a href='javascript:void(0);' class='text-danger deleteBtn' data-id='{$value->id}'><i class='mdi mdi-delete font-size-18'></i></a>";

    //         $action .= "<a href=" . route('admin.admins.show', $value->id) . " class='text-info' data-id='{$value->id}'><i class='mdi mdi-delete font-size-18'></i></a>";


    //         $btngroup = '<span style="overflow: visible; position: relative;">
    //                             <div class="dropdown">
    //                                 <a data-toggle="dropdown" class="btn  btn-clean btn-icon btn-icon-lg cursor-pointer"> <i class="flaticon-more-1 text-brand"></i> </a>
    //                                 <div class="dropdown-menu dropdown-menu-right">
    //                                     <ul class="kt-nav">
    //                                         ' . $action . '
    //                                     </ul>
    //                                 </div>
    //                             </div>
    //                         </span>';


    //         $checked = $value->status != 0 ? 'checked' : '';
    //         $status = $value->status != 0 ? 1 : 0;
    //         $profile = !empty($value->profile) ? url('assets/images/admin/profile/' . $value->profile) : url('assets/images/noImage.png');
    //         $row = array();

    //         $row[]  = "<input type='checkbox' name='did[]' value='{$value->id}' class='form-check-input select_data'>";
    //         $row[]  = $no;
    //         $row[]  = "<div><img class='rounded-circle avatar-xs' src='$profile' alt=''></div>";
    //         $row[]  = "<a href=" . route('admin.admins.show', $value->id) . ">$value->name</a>";
    //         $row[]  = $value->email;
    //         $row[]  = $value->username;
    //         $row[]  = "<span style='text-align:center;' class='form-check form-switch form-switch-md'><label class='form-check-label' for='$value->name'><input value='$status' class='change-status form-check-input' name='status' data-id='$value->id' type='checkbox' id='$value->name' $checked></label></span>";
    //         $row[]  = "<div class='d-flex gap-3'>$action</div>";
    //         $data[] = $row;
    //     }

    //     return ['draw' => $request->input('draw'), 'recordTotal' => $this->count_all(), "recordsFiltered" => $this->count_filtered(), "data" => $data];
    // }
    {
        $params['order'] = $request->input('order.0.column');
        $params['direction'] = $request->input('order.0.dir');
        $params['length'] = $request->input('length');
        $params['start']     = $request->input('start');
        $params['search_query'] = $request->search_query;
        $params['draw'] = $request->input('draw');

        // dd($this->moduleContract->roleList($params));
        return $this->adminContract->dataList($params, ['parent']);
    }

    private function _get_datatables_query()
    {
        $column_order = array('id', 'admin', '');
        $order = array('id' => 'desc'); //set column order by
        $query = \App\Models\Admin::latest();
        // $query = DB::table('admins')->whereNull('deleted_at');

        //Do Not Touch This Block Section
        /********************************/
        if (isset($_orderValue) && isset($_dirValue)) // here order processing
        {
            $query->orderBy($column_order[$_orderValue], $_dirValue);
        } else if (isset($order)) {

            $order = $order;
            $query->orderBy(key($order), $order[key($order)]);
        }
        /********************************/

        return $query;
    }

    public function getList($_lengthValue, $_startValue, $_searchString)
    {
        $query = $this->_get_datatables_query();
        if ($_lengthValue != -1) {
            $query->offset($_startValue)->limit($_lengthValue);
        }
        if (!empty($_searchString)) {
            $query->where('admins.name', 'like', "%{$_searchString}%")
                ->orWhere('admins.email', 'like', "%{$_searchString}%")
                ->orWhere('admins.username', 'like', "%{$_searchString}%");
        }
        return $query = $query->get();
    }

    public function count_filtered()
    {
        $query = $this->_get_datatables_query();
        $query = $query->get();
        return $query->count();
    }

    public function count_all()
    {
        $query = DB::table('admins')->get()->count();
        return $query;
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
    public function store(StoreAdminRequest $request)
    {
        try {
            $this->adminContract->create($request->merge(['password' => Hash::make($request->password)])->all());
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
    public function show($id = null)
    {
        $admin = $this->adminContract->findById($id);
        return view('admin.profile', compact('admin'));
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
                "admin" => $this->adminContract->findById($id),
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
            $this->adminContract->update($id, $request->all());
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
                $profile = fileUploader($request->profile, getFilePath('adminProfile'), getFileSize('adminProfile'), $request->profile);
                $this->adminContract->update($id, ['profile' => $profile]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Update successfully',
                    'code' => 201
                ], 201);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Image couldn\'t uploaded',
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
                $this->adminContract->deleteById($id);
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
            $this->adminContract->deleteMultiple($request->id);
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
                return $this->responseSuccess($this->adminContract->update($request->id, ['status' => $request->status]), 'Status change sucessfully');
            } else {
                return $this->responseError(null, 'Data not found', 400);
            }
        } catch (\Throwable $th) {
            return $this->responseError(null, $th->getMessage(), 400);
        }
    }
}
