<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Contracts\LanguageContract;
use App\Contracts\LanguageDetailsContract;
use App\Http\Requests\StoreLanguageDetailsRequest;
use App\Http\Requests\UpdateLanguageDetailsRequest;
use App\Traits\ResponseMessage;
use Illuminate\Http\Request;

class LanguageDetailsController extends Controller
{
    use ResponseMessage;

    public function list(Request $request)
    {
        // if ($request->ajax()) {
        // $params              = $request->except('_token');
        // $params['order']     = $request->input('order.0.column');
        // $params['direction'] = $request->input('order.0.dir');
        // $params['length']    = $request->input('length');
        // $params['start']     = $request->input('start');
        $_orderValue = $request->input('order.0.column');
        $_dirValue = $request->input('order.0.dir');
        $_lengthValue = $request->input('length');
        $_startValue = $request->input('start');
        $_searchString = $request->search_name;
        $list = $this->getList($_lengthValue, $_startValue, $_searchString, $request - id);

        $data = array();
        $no = $_startValue;
        foreach ($list as $value) {
            $no++;
            $action = '';

            $action .= "<a href=" . route('admin.languages.show', $value->id) . " 
            class='text-primary'><i class='mdi mdi-pencil font-size-18'></i></a>";

            $action .= "<a href='javascript:void(0);' class='text-success editBtn' data-id='{$value->id}'><i class='mdi mdi-pencil font-size-18'></i></a>";

            if ($value->id != 1) {
                $action .= "<a href='javascript:void(0);' class='text-danger deleteBtn' data-id='{$value->id}'><i class='mdi mdi-delete font-size-18'></i></a>";
            }


            $btngroup = '<span style="overflow: visible; position: relative;">
                                <div class="dropdown">
                                    <a data-toggle="dropdown" class="btn  btn-clean btn-icon btn-icon-lg cursor-pointer"> <i class="flaticon-more-1 text-brand"></i> </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="kt-nav">
                                            ' . $action . '
                                        </ul>
                                    </div>
                                </div>
                            </span>';

            $badge = $value->is_default != 0 ? "<span class='badge bg-primary'>Default</span>" : "<span class='badge bg-danger'>No parent</span>";

            $row = array();

            $row[]  = "<input type='checkbox' name='did[]' value='{$value->id}' class='form-check-input select_data'>";
            $row[]  = $no;
            $row[]  = $value->name;
            $row[]  = $value->code;
            $row[]  = $badge;
            $row[]  = "<div class='d-flex gap-3'>$action</div>";
            $data[] = $row;
        }

        return ['draw' => $request->input('draw'), 'recordTotal' => $this->count_all(), "recordsFiltered" => $this->count_filtered(), "data" => $data];
    }

    private function _get_datatables_query($id)
    {
        $column_order = array('id', 'language', '');
        $order = array('id' => 'desc'); //set column order by
        $lang = \App\Models\Language::findOrFail($id);
        $json = file_get_contents(base_path('lang/') . $lang->code . '.json');
        // $query = DB::table('languages')->whereNull('deleted_at');

        //Do Not Touch This Block Section
        /********************************/
        // if (isset($_orderValue) && isset($_dirValue)) // here order processing
        // {
        //     $query->orderBy($column_order[$_orderValue], $_dirValue);
        // } else if (isset($order)) {
        //     $order = $order;
        //     $query->orderBy(key($order), $order[key($order)]);
        // }
        /********************************/

        return json_decode($json);
    }

    public function getList($_lengthValue, $_startValue, $_searchString, $id)
    {
        $query = $this->_get_datatables_query($id);
        if ($_lengthValue != -1) {
            $query->offset($_startValue)->limit($_lengthValue);
        }
        // if (!empty($_searchString)) {
        //     $query->where('languages.name', 'like', "%{$_searchString}%");
        // }
        return $query;
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
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     try {
    //         $this->store($request->all());
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Save successfully',
    //             'code' => 201
    //         ], 201);
    //     } catch (\Throwable $e) {
    //         return response()->json([
    //             'errors' => $e->getMessage(),
    //         ]);
    //     }
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     $this->validate($request, [
    //         'key' => 'required',
    //         'value' => 'required'
    //     ]);

    //     $key = trim($request->key);
    //     $reqValue = $request->value;
    //     $lang = Language::find($id);

    //     $data = file_get_contents(base_path('lang/') . $lang->code . '.json');

    //     $json_arr = json_decode($data, true);

    //     $json_arr[$key] = $reqValue;

    //     file_put_contents(base_path('lang/') . $lang->code . '.json', json_encode($json_arr));

    //     $notify[] = ['success', 'Language key updated successfully'];
    //     return back()->withNotify($notify);
    //     try {
    //         $this->languageDetailsContract->update($id, $request->all());
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Update successfully',
    //             'code' => 201
    //         ], 201);
    //     } catch (\Throwable $e) {
    //         return response()->json([
    //             'errors' => $e->getMessage(),
    //         ]);
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, string $key)
    {
        try {
            $lang = \App\Models\Language::find($id);
            $data = file_get_contents(base_path('lang/') . $lang->code . '.json');

            $json_arr = json_decode($data, true);
            unset($json_arr[$key]);

            file_put_contents(base_path('lang/') . $lang->code . '.json', json_encode($json_arr));
            return response()->json([
                'status' => 'success',
                'message' => 'Delete successfully',
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
                'code' => 400
            ]);
        }
    }
}
