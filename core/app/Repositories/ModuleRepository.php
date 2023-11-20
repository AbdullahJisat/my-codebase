<?php

namespace App\Repositories;

use App\Models\Module;
use App\Contracts\ModuleContract;

class ModuleRepository extends BaseRepository implements ModuleContract
{
    protected $model;

    /**
     * ModuleRepository constructor.
     *
     * @param Module $model
     */
    public function __construct(Module $model)
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

            $checked = $value->status != 0 ? 'checked' : '';
            $status = $value->status != 0 ? 1 : 0;

            $switch = "<span style='text-align:center;' class='form-check form-switch form-switch-md'><label class='form-check-label' for='$value->name'><input value='$status' class='change-status form-check-input' name='status' data-id='$value->id' type='checkbox' id='$value->name' $checked></label></span>";

            $badge = $value->parent_id != 0 ? "<span class='badge bg-primary'>{$value->parent?->name}</span>" : "<span class='badge bg-danger'>No parent</span>";


            $row = array();

            $row[]  = actionButtons($value->id)['checkBox'];
            $row[]  = ++$key;
            $row[]  = $value->name;
            $row[]  = $value->link;
            $row[]  = $value->route_name;
            $row[] = "<i class='{$value->icon}'></i>";
            $row[]  = $value->sequence;
            $row[]  = $badge;
            $row[]  = $switch;
            $row[]  = "<div class='d-flex gap-3'>{$editData} {$deleteData}</div>";
            $data[] = $row;
        }
        return $data;
    }
}
