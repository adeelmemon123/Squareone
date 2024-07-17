<?php

namespace App\Repository\User;

use App\Models\User;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Validator;

class UpdateUser extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255|unique:users,id,' . $this->id . ',id',
            'domain' => ['required', 'string', 'regex:/^(https?|https):\/\/[a-zA-Z0-9-_]+\.[a-zA-Z]{2,11}$/'],
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            // 'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|numeric',
            'currency' => 'required',
            'about' => 'required|string'


        ];

        if ($this->hasFile('avatar')) {
            $rules['avatar'] = 'image|mimes:jpg,png,jpeg,gif,bmp|max:2048';
        }

        return $rules;
    }

    public function handle($user_id)
    {
        $params = $this->all();

        $user = User::find($user_id);

        if (isset($params['verified'])) {
            $user->verified = $params['verified'];
        }

        if (isset($params['name'])) {
            $user->name = $params['name'];
        }


        if (isset($params['address_line1'])) {
            $user->address_line1 = $params['address_line1'];
        }

        if (isset($params['address_line2'])) {
            $user->address_line2 = $params['address_line2'];
        }

        if (isset($params['state'])) {
            $user->state = $params['state'];
        }

        if (isset($params['country'])) {
            $user->country = $params['country'];
        }

        if (isset($params['city'])) {
            $user->city = $params['city'];
        }

        if (isset($params['zipcode'])) {
            $user->zipcode = $params['zipcode'];
        }

        if (isset($params['currency'])) {
            $user->currency = $params['currency'];
        }
        if (isset($params['phonenumber'])) {
            $user->phonenumber = $params['phonenumber'];
        }

        if (isset($params['about'])) {
            $user->about = $params['about'];
        }
        if (isset($params['meta_title'])) {
            $user->meta_title = $params['meta_title'];
        }
        if (isset($params['meta_description'])) {
            $user->meta_description = $params['meta_description'];
        }
        if (isset($params['latitude'])) {
            $user->latitude = $params['latitude'];
        }
        if (isset($params['longitude'])) {
            $user->longitude = $params['longitude'];
        }
        if (isset($params['month'])) {
            $user->month = $params['month'];
        }
        if (isset($params['day'])) {
            $user->day = $params['day'];
        }        

        if (isset($params['domain'])) {
            $user->domain = $params['domain'];
        }

        if ($this->hasFile('avatar')) {
            $user->avatar = url('/') . '/uploads/' . $this->file('avatar')->store('avatars');
        }

        $user->save();
        return true;
    }



}
