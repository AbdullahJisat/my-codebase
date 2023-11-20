<?php

namespace App\Repositories;

use App\Contracts\AdminContract;
use App\Models\Admin;

class AdminRepository extends BaseRepository implements AdminContract
{
    protected $model;

    /**
     * AdminRepositoryRepository constructor.
     *
     * @param AdminRepository $model
     */
    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

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
        $query = $this->model;

        if ($_lengthValue != -1) {
            $query->offset($_startValue)->limit($_lengthValue);
        }
        if (!empty($_searchString)) {
            $query->where('name', 'like', "%{$_searchString}%")
                ->orWhere('email', 'like', "%{$_searchString}%")
                ->orWhere('username', 'like', "%{$_searchString}%");
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

            $profile = !empty($value->profile) ? url('assets/images/admin/profile/' . $value->profile) : url('assets/images/noImage.png');
            $row = array();

            $avatar = "<div><img class='rounded-circle avatar-xs' src='$profile' alt=''></div>";

            $switch = "<span style='text-align:center;' class='form-check form-switch form-switch-md'><label class='form-check-label' for='$value->name'><input value='$status' class='change-status form-check-input' name='status' data-id='$value->id' type='checkbox' id='$value->name' $checked></label></span>";

            $badge = $value->parent_id != 0 ? "<span class='badge bg-primary'>{$value->parent?->name}</span>" : "<span class='badge bg-danger'>No parent</span>";


            $row = array();

            $row[]  = actionButtons($value->id)['checkBox'];
            $row[]  = ++$key;
            $row[]  = $avatar;
            $row[]  = "<a href=" . route('admin.admins.show', $value->id) . ">$value->name</a>";
            $row[]  = $value->email;
            $row[]  = $value->username;
            $row[]  = $switch;
            $row[]  = "<div class='d-flex gap-3'>{$editData} {$deleteData}</div>";
            $data[] = $row;
        }
        return $data;
    }
}
