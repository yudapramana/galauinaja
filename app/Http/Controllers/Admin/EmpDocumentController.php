<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\EmpDocument;
use App\Models\VervalLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;

class EmpDocumentController extends Controller
{
    public function index(Request $request)
    {
        // $query = EmpDocument::where('status', 'Pending')->with(['employee', 'docType'])
        //     ->when($request->search, function ($q) use ($request) {
        //         $q->whereHas('employee', function ($q) use ($request) {
        //             $q->where('full_name', 'like', '%' . $request->search . '%')
        //               ->orWhere('nip', 'like', '%' . $request->search . '%');
        //         });
        //     })
        //     ->orderByDesc('created_at');
        // $documents = $query->paginate(setting('pagination_limit'));

        // return response()->json($documents);


        $userId = auth()->id();

        $query = EmpDocument::with(['employee', 'docType'])
            ->where('status', 'Pending')
            // hanya dokumen milik user ini (assigned ke dia)
            ->where(function ($q) use ($userId) {
                $q->where('assigned_to', $userId);
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->whereHas('employee', function ($qq) use ($request) {
                    $qq->where('full_name', 'like', '%' . $request->search . '%')
                       ->orWhere('nip', 'like', '%' . $request->search . '%');
                });
            })
            ->orderByDesc('assigned_at'); // yang baru diambil muncul duluan

        $documents = $query->paginate(setting('pagination_limit'));

        return response()->json($documents);
    }

    public function claim(Request $request)
    {
        $validated = $request->validate([
            'count' => 'sometimes|integer|min:1|max:50',
        ]);
        $take = (int)($validated['count'] ?? 5);

        $userId = auth()->id();
        $lockTtlMinutes = 30;

        return DB::transaction(function () use ($userId, $lockTtlMinutes, $take) {
            // Ambil N dokumen Pending yang belum di-assign atau lock expired (FIFO)
            $docs = EmpDocument::where('status', 'Pending')
                ->where(function ($q) {
                    $q->whereNull('assigned_to')
                    ->orWhere('lock_expires_at', '<', now());
                })
                ->orderBy('created_at')
                ->lockForUpdate()
                ->limit($take)
                ->get();

            if ($docs->isEmpty()) {
                return response()->json(['message' => 'Tidak ada dokumen yang tersedia untuk di-claim'], 404);
            }

            $expiresAt = Carbon::now()->addMinutes($lockTtlMinutes);

            foreach ($docs as $doc) {
                $doc->assigned_to = $userId;
                $doc->assigned_at = now();
                $doc->lock_expires_at = $expiresAt;
                $doc->save();
            }

            // kembalikan dengan relasi yang diperlukan
            $docs->load(['employee', 'docType']);

            return response()->json([
                'success' => true,
                'claimed' => $docs->count(),
                'data'    => $docs,
            ]);
        });
    }

    public function release(EmpDocument $empDocument)
    {
        $userId = auth()->id();

        if ($empDocument->assigned_to !== $userId) {
            return response()->json(['message' => 'Anda tidak memiliki dokumen ini'], 403);
        }

        $empDocument->update([
            'assigned_to' => null,
            'assigned_at' => null,
            'lock_expires_at' => null,
        ]);

        return response()->json(['success' => true]);
    }

    public function remaining()
    {
        $count = EmpDocument::where('status', 'Pending')
            ->where(function ($q) {
                $q->whereNull('assigned_to')
                ->orWhere('lock_expires_at', '<', now());
            })
            ->count();

        return response()->json(['remaining' => $count]);
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

    //     // Simpan ke tabel verval_logs
    //     $vervalLog = new VervalLog();
    //     $vervalLog->id_document = $doc->id;
    //     $vervalLog->verval_status = $request->status;
    //     $vervalLog->verified_by = Auth::id(); // ID admin yang melakukan verifikasi
    //     $vervalLog->verif_notes = $request->verif_notes;
    //     $vervalLog->created_at = now();
    //     $vervalLog->save();

    //     // Update state user
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


        $userId = auth()->id();
        $doc = EmpDocument::findOrFail($id);

       // Cek apakah dokumen sudah diverifikasi sebelumnya
        if (in_array($doc->status, ['Approved', 'Rejected'])) {
            return response()->json([
                'message' => 'Dokumen sudah diverifikasi sebelumnya dan tidak dapat diverifikasi ulang.',
                'code' => 'DOCUMENT_ALREADY_VERIFIED'
            ], 409); // 409 Conflict
        }



        DB::transaction(function () use ($doc, $request, $userId) {
            $doc->status = $request->status;
            $doc->verif_notes = $request->verif_notes;
            $doc->save();

            // Simpan ke tabel verval_logs
            VervalLog::create([
                'id_document' => $doc->id,
                'verval_status' => $request->status,
                'verified_by' => $userId,
                'verif_notes' => $request->verif_notes,
                'created_at' => now(),
            ]);

            // Update state user
            $employee = $doc->employee;
            if($request->status == 'Approved') {
                $employee->update(['docs_progress_state' => true]);
            }
            $user = $employee->user;
            $user->update(['docs_update_state' => true]);
        });
        
        

        return response()->json([
            'message' => 'Dokumen berhasil diverifikasi.',
            'data' => $doc,
        ]);
    }
}
