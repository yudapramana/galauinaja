<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\EmpDocument;
use App\Models\VervalLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpDocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = EmpDocument::where('status', 'Pending')->with(['employee', 'docType'])
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('employee', function ($q) use ($request) {
                    $q->where('full_name', 'like', '%' . $request->search . '%')
                      ->orWhere('nip', 'like', '%' . $request->search . '%');
                });
            })
            ->orderByDesc('created_at');
        $documents = $query->paginate(10);
        // $documents = EmpDocument::paginate(10);

        return response()->json($documents);
    }

    // public function verify(Request $request, $id)
    // {
    //     $request->validate([
    //         'status' => 'required|in:Approved,Rejected',
    //         'verif_notes' => 'nullable|string',
    //     ]);

    //     $doc = EmpDocument::findOrFail($id);
    //     $doc->status = $request->status;
    //     $doc->verif_notes = $request->verif_notes;
    //     $doc->save();

    //     $user = $doc->employee->user;
    //     $user->update(['docs_update_state' => true]);

    //     return response()->json([
    //         'message' => 'Dokumen berhasil diverifikasi.',
    //         'data' => $doc,
    //     ]);
    // }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'verif_notes' => 'nullable|string',
        ]);

        $doc = EmpDocument::findOrFail($id);
        $doc->status = $request->status;
        $doc->verif_notes = $request->verif_notes;
        $doc->save();

        // Simpan ke tabel verval_logs
        $vervalLog = new VervalLog();
        $vervalLog->id_document = $doc->id;
        $vervalLog->verval_status = $request->status;
        $vervalLog->verified_by = Auth::id(); // ID admin yang melakukan verifikasi
        $vervalLog->verif_notes = $request->verif_notes;
        $vervalLog->created_at = now();
        $vervalLog->save();

        // Update state user
        $user = $doc->employee->user;
        $user->update(['docs_update_state' => true]);

        return response()->json([
            'message' => 'Dokumen berhasil diverifikasi.',
            'data' => $doc,
        ]);
    }
}
