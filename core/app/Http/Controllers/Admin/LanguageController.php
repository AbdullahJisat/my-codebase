<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\LanguageContract;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    use ResponseMessage;
    protected $languageContract;

    public function __construct(LanguageContract $languageContract)
    {
        $this->languageContract = $languageContract;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.language.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function list(Request $request)
    {
        $_orderValue = $request->input('order.0.column');
        $_dirValue = $request->input('order.0.dir');
        $_lengthValue = $request->input('length');
        $_startValue = $request->input('start');
        $_searchString = $request->search_query;
        $list = $this->getList($_lengthValue, $_startValue, $_searchString);

        $data = array();
        $no = $_startValue;
        foreach ($list as $value) {
            $no++;
            $action = "<div class='d-flex gap-3'>";

            $action .= "<a href=" . route('admin.languages.show', $value->id) . " 
            class='text-primary'><i class='mdi mdi-checkbox-multiple-blank font-size-18'></i></a>";

            $action .= "<a href='javascript:void(0);' class='text-success editBtn' data-id='{$value->id}'><i class='mdi mdi-pencil font-size-18'></i></a>";


            if ($value->id != 1) {
                $action .= "<a href='javascript:void(0);' class='text-danger deleteBtn' data-id='{$value->id}'><i class='mdi mdi-delete font-size-18'></i></a>";
            }

            $action .= "</div>";

            $badge = $value->is_default != 0 ? "<span class='badge bg-primary'>Default</span>" : "<span class='badge bg-danger'>No</span>";

            $row = array();
            $flag = getImage(imagePath()['flags']['path'] . '/' . $value->flag);

            $row[]  = "<input type='checkbox' name='did[]' value='{$value->id}' class='form-check-input select_data'>";
            $row[]  = $no;
            $row[]  = $value->name;
            $row[]  = $value->code;
            $row[]  = "<img src='{$flag}' alt='' class='me-1' height='12'>";
            $row[]  = $badge;
            $row[]  = $action;
            $data[] = $row;
        }

        return ['draw' => $request->input('draw'), 'recordTotal' => $this->count_all(), "recordsFiltered" => $this->count_filtered(), "data" => $data];
    }

    private function _get_datatables_query()
    {
        $column_order = array('id', 'language', '');
        $order = array('id' => 'desc'); //set column order by
        $query = \App\Models\Language::latest();
        // $query = DB::table('languages')->whereNull('deleted_at');

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
            $query->where('languages.name', 'like', "%{$_searchString}%")->orWhere('languages.code', 'like', "%{$_searchString}%");
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
        $query = \App\Models\Language::get()->count();
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
    public function store(StoreLanguageRequest $request)
    {
        try {
            if ($request->hasFile('flag')) {
                try {
                    $flag = fileUploader($request->flag, getFilePath('flags'), getFileSize('flags'));
                } catch (\Exception $exp) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Image couldn\'t upload',
                    ], 405);
                }
            }
            $data = $request->except('flag');
            $data['flag'] = $flag;
            $this->languageContract->store($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Save successfully',
                'code' => 201
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'errors' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lang = $this->languageContract->findById($id);
        $json = file_get_contents(base_path('lang/') . $lang->code . '.json');
        // $list_lang = Language::all();


        if (empty($json)) {
            return response()->json([
                "status" => true,
                "message" => "file not found.",
                "language" => $this->languageContract->findById($id),
            ], 200);
        }
        $json = json_decode($json);

        return view('pages.language.details', compact('json', 'lang'));
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
                "language" => $this->languageContract->findById($id),
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
    public function update(UpdateLanguageRequest $request, string $id)
    {
        try {
            if ($request->hasFile('flag')) {
                try {
                    $language = $this->languageContract->findById($id);
                    $flag = fileUploader($request->flag, getFilePath('flags'), null, $language->flag);
                } catch (\Exception $e) {
                    return response()->json([
                        'status'  => 'error',
                        'message' => 'Image couldn\'t upload' . $e->getMessage()(),
                    ], 405);
                }
            }
            $data = $request->except('flag');
            $data['flag'] = $flag;
            $this->languageContract->update($id, $data);
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
                $language = $this->languageContract->findById($id);
                deleteFile('assets/images/flags/' . @$language->flag);
                deleteFile(base_path('lang/') . $language->code . '.json');
                $this->languageContract->deleteById($id);
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
            $this->languageContract->deleteMultiple($request->id);
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
