<?php

namespace App\Repositories;

use App\Contracts\LanguageContract;
use App\Models\Language;
use File;

class LanguageRepository extends BaseRepository implements LanguageContract
{
    protected $model;

    /**
     * LanguageRepository constructor.
     *
     * @param Language $model
     */
    public function __construct(Language $model)
    {
        $this->model = $model;
    }

    public function store(array $payload)
    {
        $data = file_get_contents(base_path('lang/') . 'en.json');
        $json_file = strtolower($payload['code']) . '.json';
        $path = base_path('lang/') . $json_file;

        File::put($path, $data);

        // if ($payload['is_default']) {
        //     $lang = $this->model->where('is_default', 1)->first();
        //     if ($lang) {
        //         // $lang->is_default = Status::NO;
        //         $this->update($lang->id, ['is_default' => 0]);
        //     }
        // }
        $model = $this->model->create($payload);

        return $model->fresh();
    }
}
