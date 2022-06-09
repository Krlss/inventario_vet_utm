<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    public function addTypeModal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:types',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else {
            $category = Types::create([
                'name' => $request->name,
            ]);

            return response()->json($category);
        }
    }
}
