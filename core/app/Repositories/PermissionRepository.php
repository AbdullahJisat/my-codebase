<?php

namespace App\Repositories;

use App\Contracts\PermissionContract;
use App\Models\Permission;

class PermissionRepository extends BaseRepository implements PermissionContract
{
    protected $model;

    /**
     * PermissionRepository constructor.
     *
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function dataList(array $columns = ['*'], array $relations = [])
    {
        $_orderValue = $columns['order'];
        $_dirValue = $columns['direction'];
        $_lengthValue = $columns['length'];
        $_startValue = $columns['start'];
        $_searchString = $columns['search_name'];
        $_searchModule = $columns['search_module_id'];
        $_draw = $columns['draw'];

        $totalData = $this->model->with($relations)->count();

        $totalFiltered = $totalData;

        $query = $this->model->whereNull('deleted_at');

        if ($_lengthValue != -1) {
            $query->offset($_startValue)->limit($_lengthValue);
        }
        if (!empty($_searchString)) {
            $query->where('name', 'like', "%{$_searchString}%")
                ->orWhere('slug', 'like', "%{$_searchString}%");
            $totalFiltered = $query->count();
        }
        if (!empty($_searchModule)) {
            $query->whereModuleId($_searchModule);
            $totalFiltered = $query->count();
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

            $row = array();

            $row[]  = actionButtons($value->id)['checkBox'];
            $row[]  = ++$key;
            $row[]  = $value->module->name;
            $row[]  = $value->name;
            $row[]  = $value->slug;
            $row[]  = $value->route_name;
            $row[]  = $value->code;
            $row[]  = "<div class='d-flex gap-3'>{$editData} {$deleteData}</div>";
            $data[] = $row;
        }
        return $data;
    }
}
