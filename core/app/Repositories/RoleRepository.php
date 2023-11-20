<?php

namespace App\Repositories;

use App\Models\Role;
use App\Contracts\RoleContract;
use Illuminate\Support\Facades\DB;

class RoleRepository extends BaseRepository implements RoleContract
{
    protected $model;

    /**
     * RoleRepository constructor.
     *
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource on datatable.
     */
    public function dataList(array $columns = ['*'], array $relations = [])
    {
        $_orderValue = $columns['order'];
        $_dirValue = $columns['direction'];
        $_lengthValue = $columns['length'];
        $_startValue = $columns['start'];
        $_searchString = $columns['search_query'];
        $_draw = $columns['draw'];

        $totalData = $this->count();

        $totalFiltered = $totalData;

        $column_order = array('id', 'name');
        $order = array('id' => 'desc'); //set column order by
        $query = $this->model->whereNull('deleted_at');

        if ($_lengthValue != -1) {
            $query->offset($_startValue)->limit($_lengthValue);
        }
        if (!empty($_searchString)) {
            $query->where('name', 'like', "%{$_searchString}%");
            $totalFiltered = $query->count();
        }
        if (isset($_orderValue) && isset($_dirValue)) // here order processing
        {
            $query->orderBy($column_order[$_orderValue], $_dirValue);
        } else if (isset($order)) {
            $query->orderBy(key($order), $order[key($order)]);
        }
        $data = $this->getData($query->get());

        $result['draw'] = $_draw;
        $result['recordTotal'] = $totalData;
        $result['recordsFiltered'] = $totalFiltered;
        $result['data'] = $data;

        return $result;
    }
    public function getData($list)
    {
        foreach ($list as $key => $value) {

            $editData = actionButtons($value->id)['edit'];
            $deleteData = actionButtons($value->id)['delete'];
            $permissionData = actionButtons($value->id)['permission'];

            $row = array();

            $row[]  = actionButtons($value->id)['checkBox'];
            $row[]  = ++$key;
            $row[]  = $value->name;
            $row[]  = "<div class='d-flex gap-3'>{$editData} {$deleteData} {$permissionData}</div>";
            $data[] = $row;
        }
        return $data;
    }
}


// public function allPosts(Request $request)
//     {

//         $columns = array( 
//                             0 =>'id', 
//                             1 =>'title',
//                             2=> 'body',
//                             3=> 'created_at',
//                             4=> 'id',
//                         );

//         $totalData = Post::count();

//         $totalFiltered = $totalData; 

//         $limit = $request->input('length');
//         $start = $request->input('start');
//         $order = $columns[$request->input('order.0.column')];
//         $dir = $request->input('order.0.dir');

//         if(empty($request->input('search.value')))
//         {            
//             $posts = Post::offset($start)
//                          ->limit($limit)
//                          ->orderBy($order,$dir)
//                          ->get();
//         }
//         else {
//             $search = $request->input('search.value'); 

//             $posts =  Post::where('id','LIKE',"%{$search}%")
//                             ->orWhere('title', 'LIKE',"%{$search}%")
//                             ->offset($start)
//                             ->limit($limit)
//                             ->orderBy($order,$dir)
//                             ->get();

//             $totalFiltered = Post::where('id','LIKE',"%{$search}%")
//                              ->orWhere('title', 'LIKE',"%{$search}%")
//                              ->count();
//         }

//         $data = array();
//         if(!empty($posts))
//         {
//             foreach ($posts as $post)
//             {
//                 $show =  route('posts.show',$post->id);
//                 $edit =  route('posts.edit',$post->id);

//                 $nestedData['id'] = $post->id;
//                 $nestedData['title'] = $post->title;
//                 $nestedData['body'] = substr(strip_tags($post->body),0,50)."...";
//                 $nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
//                 $nestedData['options'] = "&emsp;<a href='{$show}' title='SHOW' ><span class='glyphicon glyphicon-list'></span></a>
//                                           &emsp;<a href='{$edit}' title='EDIT' ><span class='glyphicon glyphicon-edit'></span></a>";
//                 $data[] = $nestedData;

//             }
//         }

//         $json_data = array(
//                     "draw"            => intval($request->input('draw')),  
//                     "recordsTotal"    => intval($totalData),  
//                     "recordsFiltered" => intval($totalFiltered), 
//                     "data"            => $data   
//                     );

//         echo json_encode($json_data); 

//     }