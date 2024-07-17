<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUserID;
use App\Helpers\UtilityHelper;

class Cause extends Model
{
    use HasUserID;

    protected $table = 'cause';
    public $timestamps = false;
    protected $guarded = ['id'];

    public static function rules($id = 0)
    {
        $title = ['required', 'string', 'max:250'];


        if ($id > 0) {
            $title[] = 'unique:cause,title,' . $id . ',id';
        } else {
            $title[] = 'unique:cause,title';
        }

        $rules = [
            'title' => $title,
        ];

        return $rules;
    }
}
