<?php

use App\Lib\FileManager;

function moduleListForSidebar()
{
    return \App\Models\Module::with('child')->whereNull('deleted_at');
}

function moduleList()
{
    return \App\Models\Module::with('child')->whereNull('deleted_at')->get();
}

function languages()
{
    return \App\Models\Language::all();
}
function defaultLanguage()
{
    return \App\Models\Language::IsDefault();
}

function moduleChildList()
{
    return \App\Models\Module::all();
}

function fileUploader($file, $location, $size = null, $old = null, $thumb = null)
{

    $fileManager = new FileManager($file);
    $fileManager->path = $location;
    $fileManager->size = $size;
    $fileManager->old = $old;
    $fileManager->thumb = $thumb;
    $fileManager->upload();
    return $fileManager->filename;
}

function deleteFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}
function fileManager()
{
    return new FileManager();
}

function getFilePath($key)
{
    return fileManager()->$key()->path;
}

function getFileSize($key)
{
    return fileManager()->$key()->size;
}

function getFileExt($key)
{
    return fileManager()->$key()->extensions;
}

function getImage($image, $size = null)
{
    $clean = '';
    if (file_exists($image) && is_file($image)) {
        return asset($image) . $clean;
    }
    // if ($size) {
    //     return route('placeholder.image', $size);
    // }
    return asset('assets/images/noImage.png');
}

function imagePath()
{
    $data['userProfile'] = [
        'path'      => 'assets/images/user/profile',
        'size'      => '350x300',
    ];
    $data['adminProfile'] = [
        'path'      => 'assets/images/admin/profile',
        'size'      => '350x300',
    ];
    $data['status'] = [
        'path'      => 'assets/images/status',
        'size'      => '775x425',
    ];
    $data['logo'] = [
        'path'      => 'assets/images/logo',
        'size'      => '775x425',
    ];
    $data['flags'] = [
        'path'      => 'assets/images/flags',
    ];
    return $data;
}

function getSiteName()
{
    return \Cache::get('SiteName');
}

function actionButtons($value)
{
    $action['checkBox'] = "<input type='checkbox' name='did[]' value='{$value}' class='form-check-input select_data'>";

    $action['edit'] = "<button type='button' class='btn-sm btn-primary waves-effect waves-light editBtn' data-id='{$value}'><i class='mdi mdi-pencil d-block font-size-16'></i></button>";

    $action['delete'] = "<button type='button' class='btn-sm btn-danger waves-effect waves-light deleteBtn' data-id='{$value}'><i class='mdi mdi-trash-can d-block font-size-16'></i></button>";

    $action['show'] = "<button type='button' class='btn-sm btn-info waves-effect waves-light deleteBtn' data-id='{$value}'><i class='mdi mdi-eye d-block font-size-16'></i></button>";

    $action['permission'] = "<button type='button' class='btn-sm btn-info waves-effect waves-light permissionBtn' data-id='{$value}'><i class='mdi mdi-copy d-block font-size-16'></i></button>";

    return $action;
}
