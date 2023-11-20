<?php

namespace App\Repositories;

use App\Contracts\UserContract;
use App\Models\User;

class UserRepository extends BaseRepository implements UserContract
{
    protected $model;

    /**
     * UserRepositoryRepository constructor.
     *
     * @param UserRepository $model
     */
    public function __construct(User $model)
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
                ->orWhere('username', 'like', "%{$_searchString}%")
                ->orWhere('mobile', 'like', "%{$_searchString}%");
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

            if (auth()->user()->can('edit-user')) {
                $editData = actionButtons($value->id)['edit'];
            }
            if (auth()->user()->can('delete-user')) {
                $deleteData = actionButtons($value->id)['delete'];
            }
            if (auth()->user()->can('edit-user')) {
                $showData = actionButtons($value->id)['show'];
            }

            $checked = $value->status != 0 ? 'checked' : '';
            $status = $value->status != 0 ? 1 : 0;

            $switch = "<span style='text-align:center;' class='form-check form-switch form-switch-md'><label class='form-check-label' for='$value->username'><input value='$status' class='change-status form-check-input' name='status' data-id='$value->id' type='checkbox' id='$value->username' $checked></label></span>";

            $profile = !empty($value->profile) ? url('assets/images/user/profile/' . $value->profile) : url('assets/images/noImage.png');

            $profileRoute = route('admin.users.show', $value->id);

            $row = array();

            $row[]  = actionButtons($value->id)['checkBox'];
            $row[]  = ++$key;
            $row[]  = "<div><img class='rounded-circle avatar-xs' src='$profile' alt=''></div>";
            $row[]  = "<a href=" . $profileRoute . ">$value->name</a>";
            $row[]  = $value->email;
            $row[]  = $value->username;
            $row[]  = $value->mobile;
            $row[]  = $value->gender;
            $row[]  = $switch;
            $row[]  = "<div class='d-flex gap-3'>{$editData} {$deleteData} {$showData}</div>";
            $data[] = $row;
        }
        return $data;
    }
}
