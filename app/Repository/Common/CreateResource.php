<?php

namespace App\Repository\Common;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Helpers\UtilityHelper;

class CreateResource extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $model = UtilityHelper::getModel();
        $modelClass = "App\\Models\\$model";
        $modelid = strtolower($model);   //Adeel code
        $id = $this->route($modelid);
        return $modelClass::rules($id);
    }

    public function messages()
    {
        $model = UtilityHelper::getModel();
        $modelClass = "App\\Models\\$model";

        if (method_exists($modelClass, 'messages')) {
            return $modelClass::messages();
        }

        return [];
    }


    public function handle($model)
    {
        $data = $this->except(['_token', '_method']);

        foreach ($this->all() as $key => $value) {

            if ($this->hasFile($key)) {

                $file = $this->file($key);
                $folder = Str::plural($key);

                if ($this->hasFile('image')) {
                    $data[$key] = url('/') . '/uploads/' . $this->file($key)->store($folder);
                }
            }

        }

        $modelClass = "App\\Models\\$model";

        // dd($data);
        $modelClass::create($data);
        return true;
    }
}