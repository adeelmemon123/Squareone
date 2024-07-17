<?php

namespace App\Repository\Common;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use App\Helpers\UtilityHelper;
use Illuminate\Support\Str;

class UpdateResource extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //Bouncer::can('update-blog');
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
        $id = $this->route($modelid);    //Adeel code
        return $modelClass::rules($id);
    }

    public function handle($model, $resourceName)
    {
        $data = $this->except(['_token', '_method', $resourceName]);

        foreach ($this->all() as $key => $value) {

            if ($this->hasFile($key)) {

                $file = $this->file($key);
                $folder = Str::plural($key);

                if ($this->hasFile($key)) {
                    $data[$key] = url('/') . '/uploads/' . $this->file($key)->store($folder);
                }
            }
        }
        $modelClass = "App\\Models\\$model";
        $modelid = strtolower($model);   //Adeel code
        $id = $this->route($modelid);
        // dd($id);
        $modelClass::where(['id' => $this->id])->update($data);

        return true;
    }
}
