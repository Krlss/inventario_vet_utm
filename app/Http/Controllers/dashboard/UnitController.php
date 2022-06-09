<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function addUnitModal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:units',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else {
            $unit = Unit::create([
                'name' => $request->name,
            ]);

            return response()->json($unit);
        }
    }
}
