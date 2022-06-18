<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Types;
use App\Models\Unit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function postdata(Request $request)
    {
        try {
            $modal_class = $request->modal_class;
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:' . $modal_class,
            ]);

            $success_output = '';
            $modal_title = '';

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            } else {

                DB::beginTransaction();
                switch ($request->button_action) {
                    case 'insert':
                        if ($request->modal_class == 'categories') {
                            Categories::create([
                                'name' => $request->name,
                            ]);
                            $success_output = "<div class='alert alert-success'>" . __('Category created successfully') . "</div>";
                            $modal_title = __('Creating a new category');
                        } else if ($request->modal_class == 'types') {
                            Types::create([
                                'name' => $request->name,
                            ]);
                            $success_output = "<div class='alert alert-success'>" . __('Type created successfully') . "</div>";
                            $modal_title = __('Creating a new type');
                        } else if ($request->modal_class == 'units') {
                            Unit::create([
                                'name' => $request->name,
                            ]);
                            $success_output = "<div class='alert alert-success'>" . __('Unit created successfully') . "</div>";
                            $modal_title = __('Creating a new unit');
                        }
                        break;
                    case 'update':
                        if ($request->modal_class == 'categories') {
                            Categories::where('id', $request->modal_id)->update([
                                'name' => $request->name,
                            ]);
                            $success_output = "<div class='alert alert-success'>" . __('Category updated successfully') . "</div>";
                            $modal_title = __('Updating a category');
                        } else if ($request->modal_class == 'types') {
                            Types::where('id', $request->modal_id)->update([
                                'name' => $request->name,
                            ]);
                            $success_output = "<div class='alert alert-success'>" . __('Type updated successfully') . "</div>";
                            $modal_title = __('Updating a type');
                        } else if ($request->modal_class == 'units') {
                            Unit::where('id', $request->modal_id)->update([
                                'name' => $request->name,
                            ]);
                            $success_output = "<div class='alert alert-success'>" . __('Unit updated successfully') . "</div>";
                            $modal_title = __('Updating a unit');
                        }
                        break;
                }
                DB::commit();
            }


            $output = array(
                'success'   =>  $success_output,
                'button_action'    =>  $request->button_action,
                'modal_title' =>  $modal_title
            );
            echo json_encode($output);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
