<?php

namespace App\Repository\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

// use Bouncer;

class GetAllUsers extends FormRequest
{
    // protected $redirectRoute = 'users.index';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return auth()->user()->is_admin;//Bouncer::can('view-blogs');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function handle()
    {
        return User::latest('id')->paginate(10);
    }
}
