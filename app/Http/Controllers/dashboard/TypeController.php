<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:inventory.types.index')->only('index');
        $this->middleware('can:inventory.types.show')->only('show');
        $this->middleware('can:inventory.types.create')->only('store');
        $this->middleware('can:inventory.types.edit')->only('edit');
        $this->middleware('can:inventory.types.edit')->only('update');
        $this->middleware('can:inventory.types.destroy')->only('destroy');
    }


    public function index(Request $request)
    {
        $types = [];
        if ($request->ajax()) {

            $data = Types::all();
            return datatables()->of($data)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d-m-Y H:i:s');
                })
                ->editColumn('updated_at', function ($data) {
                    return $data->updated_at->format('d-m-Y H:i:s');
                })
                ->addColumn('actions', function ($type) {
                    return view('dashboard.types.partials.actions', compact('type'));
                })
                ->make();
        }
        return view('dashboard.types.index', compact('types'));
    }

    public function addTypeModal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:types',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else {
            $type = Types::create([
                'name' => $request->name,
            ]);

            return response()->json($type);
        }
    }

    public function destroy(Types $type)
    {
        try {
            DB::beginTransaction();
            $type->delete();
            DB::commit();
            return redirect()->route('types.index')->with('success', __('Type deleted successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', __('Error in delete a type') . ' ' . $e->getMessage());
        }
    }
}
