<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\UtilityHelper;
use Illuminate\Support\Str;
use App\Helpers\CustomStrHelper;

use App\Repository\Common\GetResource;
use App\Repository\Common\CreateResource;
use App\Repository\Common\UpdateResource;
use App\Repository\Common\DeleteResource;
use App\Repository\Common\GetAllResources;


use App\Helpers\ResponseHelper;

class MainController extends Controller
{
    public function index(GetAllResources $request)
    {
        $model = UtilityHelper::getModel();
        $singularKey = Str::lower($model);
        $key = Str::plural($singularKey);

        $response = $request->handle($model, [], true);

        $data = [
            $key => $response
        ];

        $view = Str::replaceFirst('{resource}', $singularKey, '{resource}.index');
        return ResponseHelper::handle($view, $data);
    }

    public function create(GetResource $request)
    {
        $model = UtilityHelper::getModel();
        $singularKey = Str::lower($model);
        $key = Str::plural($singularKey);

        $request->id = 0;
        $response = $request->handle($model);

        $routeString = Str::replaceFirst('{resource}', $key, '{resource}.store');



        $data = [
            $singularKey => $response,
            'route' => route($routeString),
            'edit' => false,
        ];

        $view = Str::replaceFirst('{resource}', $singularKey, '{resource}.form');
        return ResponseHelper::handle($view, $data);
    }

    public function store(CreateResource $request)
    {
        $model = UtilityHelper::getModel();
        $singularKey = Str::lower($model);
        $key = Str::plural($singularKey);

        $request->handle($model);

        $message = Str::replaceFirst('{resource}', $model, '{resource} has been added successfully.');
        session()->flash('status', $message);

        $routeString = Str::replaceFirst('{resource}', $key, '{resource}.index');
        return redirect()->route($routeString);
    }

    public function edit($id, GetResource $request)
    {
        $model = UtilityHelper::getModel();
        $singularKey = Str::lower($model);
        $key = Str::plural($singularKey);

        $request->id = $id;
        $response = $request->handle($model);

        $routeString = Str::replaceFirst('{resource}', $key, '{resource}.update');

        $data = [
            $singularKey => $response,
            'route' => route($routeString, [$singularKey => $request->id]),
            'edit' => true,
        ];

        $view = Str::replaceFirst('{resource}', $singularKey, '{resource}.form');
        return ResponseHelper::handle($view, $data);
    }

    public function update(UpdateResource $request, $id)
    {


        $model = UtilityHelper::getModel();


        $singularKey = Str::lower($model);
        $key = Str::plural($singularKey);

        $request->id = $id;
        $request->handle($model, $singularKey);

        $message = Str::replaceFirst('{resource}', $model, '{resource} has been updated successfully.');
        session()->flash('status', $message);

        $routeString = Str::replaceFirst('{resource}', $key, '{resource}.index');
        return redirect()->route($routeString);
    }

    public function destroy($id, DeleteResource $request)
    {
        $model = UtilityHelper::getModel();
        $singularKey = Str::lower($model);
        $key = Str::plural($singularKey);

        $request->id = $id;
        $request->handle($model);

        $message = Str::replaceFirst('{resource}', $model, '{resource} has been deleted successfully.');
        session()->flash('status', $message);

        $routeString = Str::replaceFirst('{resource}', $key, '{resource}.index');
        return redirect()->route($routeString);
    }
}