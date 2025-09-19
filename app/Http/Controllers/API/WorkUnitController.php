<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkUnit;
use Illuminate\Support\Facades\Validator;

class WorkUnitController extends Controller
{
    public function fetch()
    {
        return response()->json(
            WorkUnit::query()
                ->select('id', 'unit_name', 'unit_code', 'parent_unit')
                ->orderBy('unit_name')
                ->get()
        );
    }
    
    public function index(Request $request)
    {
        $query = WorkUnit::query();

        if ($request->has('search_query')) {
            $search = $request->search_query;
            $query->where('unit_name', 'like', "%$search%")
                  ->orWhere('unit_code', 'like', "%$search%");
        }

        return $query->paginate(10);
    }

   

    public function show($id)
    {
        $unit = WorkUnit::findOrFail($id);
        return response()->json($unit);
    }

    

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        WorkUnit::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'Selected units deleted']);
    }

    // GET
    public function tree()
    {
        $units = WorkUnit::with('children.children.children')->whereNull('parent_unit')->get();
        return response()->json($units);
    }

    // PUT
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'unit_name' => 'required|string',
            'unit_code' => 'required|string',
            'parent_unit' => 'nullable|exists:work_units,id',
        ]);

        $unit = WorkUnit::findOrFail($id);
        $unit->update($data);

        return response()->json(['message' => 'Updated']);
    }

    // POST
    public function store(Request $request)
    {
        $data = $request->validate([
            'unit_name' => 'required|string',
            'unit_code' => 'required|string',
            'parent_unit' => 'nullable|exists:work_units,id',
        ]);

        WorkUnit::create($data);
        return response()->json(['message' => 'Created']);
    }

    // DELETE
    public function destroy($id)
    {
        $unit = WorkUnit::findOrFail($id);
        $unit->delete();
        return response()->json(['message' => 'Deleted']);
    }


}
