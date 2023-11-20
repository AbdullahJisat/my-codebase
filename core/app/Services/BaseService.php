<?php

namespace App\Services;

class BaseService
{
    protected $interface;

    public function __construct($interface)
    {
        $this->interface = $interface;
    }

    public function all()
    {
        return $this->interface->all();
    }

    public function store(array $payload)
    {
        return $this->interface->create($payload);
    }

    public function edit($id)
    {
        return (!empty($id)) ? $this->interface->findById($id) : 'Not Found';
    }

    public function update(int $modelId, array $payload)
    {
        $this->interface->update($modelId, $payload);
    }

    public function destroy($id)
    {
        return (!empty($id)) ? $this->interface->deleteById($id) : 'Not Found';
    }

    public function listForDropDown($id = '')
    {
        $items =  $this->all();

        $option = "<option value=''>Select Please</option>";
        foreach ($items as $item) {
            if ($item->id == $id) {
                $option .= "<option value='$item->id' selected>$item->name</option>";
            } else {
                $option .= "<option value='$item->id'>$item->name</option>";
            }
        }
        return $option;
    }
}
