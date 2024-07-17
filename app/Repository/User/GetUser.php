<?php

namespace App\Repository\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

//use Bouncer;

class GetUser extends FormRequest
{

    // protected $redirectRoute = 'users.index';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //Bouncer::can('view-User');
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

    public function handle($user_id = 0, $customers = false)
    {

        if ($user_id) {
            $user = User::findOrNew($user_id);
        } else {
            // Otherwise, retrieve the authenticated user
            $user = Auth::user();
        }

        if (is_null($user->latitude)) {
            $user->latitude = 0;
        }

        if (is_null($user->longitude)) {
            $user->longitude = 0;
        }

        if ($customers) {
            $user->load('children');
        }

        return $user;
    }

}
