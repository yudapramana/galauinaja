<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DocType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;
use App\Models\EmpDocument;
use App\Models\User;
use App\Models\VervalLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Log;

class DocumentController extends Controller
{

    public function documentsByUserId($userId)
    {
        $user = User::find($userId);
        $id_employee = $user->id_employee;
        $documents = EmpDocument::where('id_employee', $id_employee)->with('doctype')->get()->map(function ($doc) {
            return [
                'id' => $doc->id,
                'id_doc_type' => $doc->id_doc_type,
                'doc_number' => $doc->doc_number,
                'doc_date' => $doc->doc_date,
                'parameter' => $doc->parameter,
                'file_url' => url('storage/' . $doc->file_path),
                'file_name' => $doc->file_name,
                'status' => $doc->status,
                'verif_notes' => $doc->verif_notes
            ];
            // 'file_url' => url('storage/documents/' . $doc->file_path),
        });

        return response()->json([
            'data' => $documents,
            'user' => $user
        ]);
    }


    /**
     * List documents uploaded by the logged-in user
     */
    public function myDocuments()
    {
        $user = auth()->user();
        $id_employee = $user->id_employee;
        $documents = EmpDocument::where('id_employee', $id_employee)->with('doctype')->get()->map(function ($doc) {
            return [
                'id' => $doc->id,
                'id_doc_type' => $doc->id_doc_type,
                'doc_number' => $doc->doc_number,
                'doc_date' => $doc->doc_date,
                'parameter' => $doc->parameter,
                'file_url' => url('storage/' . $doc->file_path),
                'file_name' => $doc->file_name,
                'status' => $doc->status,
                'verif_notes' => $doc->verif_notes
            ];
            // 'file_url' => url('storage/documents/' . $doc->file_path),
        });

        $user = User::find($user->id);
        $user->update(['docs_update_state' => false]);

        return response()->json([
            'data' => $documents
        ]);
    }

    /**
     * Upload new document
     */
    public function uploadDocument(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_doc_type' => 'required|exists:doc_types,id',
            'doc_number' => 'nullable|string|max:255',
            'doc_date' => 'nullable|date',
            'parameter' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Upload file
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        if (isset($request->user_id)) {
            $user = User::find($request->user_id);
            $employee = $user->employee;
        } else {
            $employee = Auth::user()->employee;
        }

        $employeeId = $employee->id;
        $docType = DocType::find($request->id_doc_type);

        $fileName = $docType->label . ($request->parameter ? ('_' . $request->parameter) : '') . '_' . $employee->nip . '.' . $extension;

        // Cek apakah file_name sudah ada di database
        $fileNameExists = EmpDocument::where('file_name', $fileName)->exists();
        if ($fileNameExists) {
            return response()->json([
                'errors' => [
                    'file_name' => ['File sudah diupload. Hapus dan tambahkan kembali jika ingin upload ulang.']
                ]
            ], 422);
        }

        $filePath = $file->storeAs(
            'documents/' . $employee->nip,
            $fileName,
            'public'
        );

        // Simpan ke database dokumen
        $document = new EmpDocument();
        $document->id_employee = $employeeId;
        $document->id_doc_type = $request->id_doc_type;
        $document->doc_number = $request->doc_number;
        $document->file_name = $fileName;
        $document->doc_date = $request->doc_date;
        $document->parameter = $request->parameter;
        $document->file_path = $filePath;
        if (isset($request->user_id)) {
            $document->status = 'Approved';
        }
        $document->save();

        // Simpan ke verval_logs
        $vervalLog = new VervalLog();
        $vervalLog->id_document = $document->id;
        $vervalLog->verval_status = isset($request->user_id) ? 'Uploaded by Admin' : 'Uploaded';
        $vervalLog->verified_by = Auth::id(); // Admin yang melakukan upload atau user itu sendiri
        $vervalLog->verif_notes = null; // Tidak ada catatan saat upload
        $vervalLog->save();

        // Update state jika oleh admin
        if (isset($request->user_id)) {
            $user->docs_update_state = true;
            $user->save();
            $employee->update(['docs_progress_state' => true]);
        }

        return response()->json([
            'message' => 'Dokumen berhasil diupload.'
        ]);
    }


    // public function uploadDocument(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'id_doc_type' => 'required|exists:doc_types,id',
    //         'doc_number' => 'required|string|max:255',
    //         'doc_date' => 'required|date',
    //         'parameter' => 'nullable|string|max:255',
    //         'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // 2MB max
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }


    //     // Upload file
    //     $file = $request->file('file');
    //     // $filename = time() . '_' . $file->getClientOriginalName();
    //     // $path = $file->storeAs('documents', $filename, 'public');
    //     $extension = $file->getClientOriginalExtension();

    //     // return 'USERID: ' . $request->user_id;

    //     if(isset($request->user_id)) {
    //         $user = User::find($request->user_id);
    //         $employee = $user->employee;
    //     } else {
    //         $employee = Auth::user()->employee;
    //     }

    //     $employeeId = $employee->id;
    //     $docType = DocType::find($request->id_doc_type);

    //     // Buat nama file
    //     $fileName = $docType->label . ($request->parameter ?? '') . '_' . $employee->nip . '.' . $extension;
    //     // $fileName = $docType->label . $request->parameter . '_' .$employee->nip . '.'. $extension;

    //     // Cek apakah file_name sudah ada di database
    //     $fileNameExists = EmpDocument::where('file_name', $fileName)->exists();
    //     if ($fileNameExists) {
    //         return response()->json([
    //             'errors' => [
    //                 'file_name' => ['File sudah diupload. Hapus dan tambahkan kembali jika ingin upload ulang.']
    //             ]
    //         ], 422);
    //     }

    //     $filePath = $file->storeAs(
    //         'documents/'.$employee->nip,
    //         $fileName,
    //         'public'
    //     );

    //     // Simpan ke database
    //     $document = new EmpDocument();
    //     $document->id_employee = $employeeId;
    //     $document->id_doc_type = $request->id_doc_type;
    //     $document->doc_number = $request->doc_number;
    //     $document->file_name = $fileName;
    //     $document->doc_date = $request->doc_date;
    //     $document->parameter = $request->parameter;
    //     $document->file_path = $filePath;
    //     if(isset($request->user_id)) {
    //         $document->status = 'Approved';
    //     }
    //     $document->save();

    //     if(isset($request->user_id)) {
    //         $user->docs_update_state = true;
    //         $user->save();
    //     }

    //     return response()->json([
    //         'message' => 'Dokumen berhasil diupload.'
    //     ]);
    // }

    public function reupload(Request $request, $id)
    {
        $document = EmpDocument::findOrFail($id);
        $employee = $document->employee;
        $validator = Validator::make($request->all(), [
            'doc_number' => 'nullable|string|max:255',
            'doc_date' => 'nullable|date',
            'parameter'  => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        // Cek di disk yang benar
        // if (!Storage::exists($document->file_path)) {
        //     Log::warning("File Local not found for delete: {$document->file_path}");
        // } else {
        //    Log::warning("File Local FOUND for delete: {$document->file_path}"); 
        // }

        // if (!Storage::disk('public')->exists($document->file_path)) {
        //     Log::warning("File Public not found for delete: {$document->file_path}");
        // } else {
        //    Log::warning("File Public FOUND for delete: {$document->file_path}"); 
        // }

        // if (!Storage::disk('public')->exists($document->file_path)) {
        // // Log::warning("File not found for delete: {$document->file_path}");
        //     return "File not found on public for delete: {$document->file_path}";
        // } else {
        //     return "File FOUND on public for delete: {$document->file_path}";
        // }

        // Ganti file jika ada file baru
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($document->file_path && Storage::exists($document->file_path)) {
                Storage::delete($document->file_path);
                if (Storage::disk('public')->exists($document->file_path)) {
                    Storage::disk('public')->delete($document->file_path);
                }
            }

            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
                Storage::delete($document->file_path);
            }

            $file = $request->file('file');
            $filePath = $file->storeAs(
                'documents/'.$employee->nip,
                $document->file_name,
                'public'
            );
        }

        // Update metadata
        $document->doc_number = $request->doc_number;
        $document->doc_date   = $request->doc_date;
        $document->parameter  = $request->parameter;
        $document->file_path  = $filePath;
        // Reset status dan catatan verifikasi karena ini reupload
        // $document->status = 'Pending';
        $document->status = isset($request->user_id) ? 'Approved' : 'Pending';
        $document->verif_notes = null;

        $document->save();

         // Simpan ke verval_logs
         $vervalLog = new VervalLog();
         $vervalLog->id_document = $document->id;
         $vervalLog->verval_status = isset($request->user_id) ? 'Reuploaded by Admin' : 'Reuploaded';
         $vervalLog->verified_by = Auth::id(); // Admin yang melakukan upload atau user itu sendiri
         $vervalLog->verif_notes = null; // Tidak ada catatan saat upload
         $vervalLog->save();


         // Update state jika oleh admin
        if (isset($request->user_id)) {
            $employee->update(['docs_progress_state' => true]);
            $user = $employee->user;
            $user->docs_update_state = true;
            $user->save();
        }

        return response()->json([
            'message' => 'Reupload berhasil.',
            'data'    => $document
        ]);
    }

    public function syncFiles()
    {
        $userlogin = Auth::user();
        $user = User::find($userlogin ->id);
        $employee = $user->employee;

        $directory = 'documents/' . $employee->nip;
        $files = Storage::disk('public')->allFiles($directory);

        // Remove the directory prefix from each file path
        $filesWithoutPrefix = array_map(function ($file) use ($directory) {
            return str_replace($directory . '/', '', $file);
        }, $files);

        foreach ($filesWithoutPrefix as $key => $fileName) {
            $exploded = explode('_', $fileName);
            $length = count($exploded);

            $label = $exploded[0];
            $param = ($length == 3) ? $exploded[1] : null;
            $docType = DocType::where('label', $label)->first();
            if($docType) {
                $docTypeId = $docType->id;
            } else {
                continue;
                return 'apasih';
            }
            
            EmpDocument::firstOrCreate([
                'id_employee' => $employee->id,
                'id_doc_type' => $docTypeId,
                'parameter' => $param,
                'file_path' => $directory . '/' . $fileName,
                'file_name' => $fileName,
                'status' => 'Approved',
            ]);
        }

        $user->update([
            'docs_update_state' => true,
        ]);
        $employee = $user->employee;
        $employee->update(['docs_progress_state' => true]);

        return response()->json(['success' => true]);
    }

}
