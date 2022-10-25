<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:inventory.categories.index')->only('index');
        $this->middleware('can:inventory.categories.show')->only('show');
        $this->middleware('can:inventory.categories.create')->only('store');
        $this->middleware('can:inventory.categories.edit')->only('edit');
        $this->middleware('can:inventory.categories.edit')->only('update');
        $this->middleware('can:inventory.categories.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $categories = [];
        if ($request->ajax()) {

            $data = Categories::all();
            return datatables()->of($data)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d-m-Y H:i:s');
                })
                ->editColumn('updated_at', function ($data) {
                    return $data->updated_at->format('d-m-Y H:i:s');
                })
                ->addColumn('actions', function ($category) {
                    return view('dashboard.categories.partials.actions', compact('category'));
                })
                ->make();
        }
        return view('dashboard.categories.index', compact('categories'));
    }

    public function addCategoryModal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else {
            $category = Categories::create([
                'name' => $request->name,
            ]);

            return response()->json($category);
        }
    }

    public function destroy(Categories $category)
    {
        try {
            DB::beginTransaction();
            $category->delete();
            DB::commit();
            return redirect()->route('categories.index')->with('success', __('Category deleted successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', __('Error in delete a category') . ' ' . $e->getMessage());
        }
    }
}
