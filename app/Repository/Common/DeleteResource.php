<?php

namespace App\Repository\Common;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class DeleteResource extends FormRequest
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
        return [

        ];
    }

    public function handle($model)
    {
        $modelClass = "App\\Models\\$model";
        $modelClass::where(['id' => $this->id])->delete();
        return true;
    }
}
