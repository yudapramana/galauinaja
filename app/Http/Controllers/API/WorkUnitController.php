<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkUnit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class WorkUnitController extends Controller
{
    // public function fetch()
    // {
    //     return response()->json(
    //         WorkUnit::query()
    //             ->select('id', 'unit_name', 'unit_code', 'parent_unit')
    //             ->orderBy('unit_name')
    //             ->get()
    //     );
    // }

    public function fetch()
    {
        // Ambil tree sampai 3 level anak, mulai dari akar (parent_unit = null)
        $units = WorkUnit::with('children.children.children')
            ->whereNull('parent_unit')
            ->get();

        // Flatten ke list datar (pre-order) dengan urutan berdasarkan unit_code
        $flat = collect();

        $walk = function ($nodes) use (&$walk, &$flat) {
            // Urutkan nodes saat ini berdasarkan unit_code (natural, case-insensitive)
            $sorted = collect($nodes)->sortBy(
                fn ($x) => (string)($x->unit_code ?? ''),
                SORT_NATURAL | SORT_FLAG_CASE
            )->values();

            foreach ($sorted as $n) {
                $flat->push([
                    'id'          => $n->id,
                    'unit_name'   => $n->unit_name,
                    'unit_code'   => $n->unit_code,
                    'parent_unit' => $n->parent_unit,
                ]);

                if ($n->relationLoaded('children') && $n->children->isNotEmpty()) {
                    // Urutkan anak berdasarkan unit_code lalu telusuri
                    $children = $n->children->sortBy(
                        fn ($c) => (string)($c->unit_code ?? ''),
                        SORT_NATURAL | SORT_FLAG_CASE
                    )->values();

                    $walk($children);
                }
            }
        };

        $walk($units);

        // Hilangkan potensi duplikasi (jaga-jaga)
        $flat = $flat->unique('id')->values();

        return response()->json($flat);
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
