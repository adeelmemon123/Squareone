<?php

namespace App\Repository\Common;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckOwnership;

//use Bouncer;

class GetResource extends FormRequest
{
    // protected $redirectRoute = 'achievements.index';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //Bouncer::can('view-Education');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // return CheckOwnership::existsForUser('achievements', 'achievements');
        return [];
    }

    public function handle($model)
    {
        $modelClass = "App\\Models\\$model";
        return $modelClass::findOrNew($this->id);
    }
}
