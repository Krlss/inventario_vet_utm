<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:inventory.units.index')->only('index');
        $this->middleware('can:inventory.units.show')->only('show');
        $this->middleware('can:inventory.units.create')->only('store');
        $this->middleware('can:inventory.units.edit')->only('edit');
        $this->middleware('can:inventory.units.edit')->only('update');
        $this->middleware('can:inventory.units.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $units = [];
        if ($request->ajax()) {

            $data = Unit::all();
            return datatables()->of($data)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d-m-Y H:i:s');
                })
                ->editColumn('updated_at', function ($data) {
                    return $data->updated_at->format('d-m-Y H:i:s');
                })
                ->addColumn('actions', function ($unit) {
                    return view('dashboard.units.partials.actions', compact('unit'));
                })
                ->make();
        }
        return view('dashboard.units.index', compact('units'));
    }

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

    public function destroy(Unit $unit)
    {
        try {
            DB::beginTransaction();
            $unit->delete();
            DB::commit();
            return redirect()->route('units.index')->with('success', __('Unit deleted successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', __('Error in delete a unit') . ' ' . $e->getMessage());
        }
    }
}
