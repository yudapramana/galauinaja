<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmpDocumentController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\PrintController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VervalLogController;
use App\Http\Controllers\API\DocumentLogController;
use App\Http\Controllers\API\WorkUnitController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\OauthController;
use App\Http\Controllers\PublicDocController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\User\DocumentController;
use App\Http\Controllers\User\EmployeeDocumentController;
use App\Http\Controllers\WhatsAppController;
use App\Models\DocType;
use App\Models\EmpDocument;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
use App\Http\Controllers\Auth\PasswordResetWhatsappController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/password/wa/request', [PasswordResetWhatsappController::class, 'showRequestForm'])->name('password.wa.request');
Route::get('/password/wa/reset',   [PasswordResetWhatsappController::class, 'showResetForm'])->name('password.wa.reset');
Route::post('/password/wa/reset',  [PasswordResetWhatsappController::class, 'resetPassword'])->name('password.wa.reset.submit');


Route::post('/wa/send', [WhatsAppController::class, 'send']);
Route::get('/wa/sendget', [WhatsAppController::class, 'sendGet']);

// Route::get('/verval-log-champion', function () {

//     // Query: hitung jumlah verval per user (verifikator)
//     $logs = DB::select("
//         SELECT 
//             u.id AS user_id,
//             u.name,
//             COUNT(v.id) AS total_vervals
//         FROM verval_logs v
//         JOIN users u ON u.id = v.verified_by
//         GROUP BY u.id, u.name
//         ORDER BY total_vervals DESC
//     ");

//     // Bangun HTML tampilan klasemen
//     $html = "
//     <html>
//     <head>
//         <title>Klasemen Verval Log Champion</title>
//         <style>
//             body {
//                 font-family: Arial, sans-serif;
//                 background: #f7f8fa;
//                 padding: 40px;
//             }
//             h2 {
//                 text-align: center;
//                 margin-bottom: 25px;
//                 color: #333;
//             }
//             table {
//                 border-collapse: collapse;
//                 margin: 0 auto;
//                 background: #fff;
//                 width: 80%;
//                 box-shadow: 0 2px 8px rgba(0,0,0,0.1);
//                 border-radius: 8px;
//                 overflow: hidden;
//             }
//             th, td {
//                 padding: 12px 16px;
//                 text-align: left;
//                 border-bottom: 1px solid #e0e0e0;
//             }
//             th {
//                 background-color: #007B5E;
//                 color: #fff;
//                 font-weight: bold;
//             }
//             tr:nth-child(even) {
//                 background-color: #f9f9f9;
//             }
//             tr:hover {
//                 background-color: #f1fff3;
//             }
//             .rank {
//                 text-align: center;
//                 font-weight: bold;
//             }
//             .champion {
//                 background-color: gold !important;
//                 font-weight: bold;
//                 color: #000;
//             }
//         </style>
//     </head>
//     <body>
//         <h2>🏆 Klasemen Verval Log Champion</h2>
//         <table>
//             <thead>
//                 <tr>
//                     <th>Peringkat</th>
//                     <th>Nama Verifikator</th>
//                     <th>Total Verval</th>
//                 </tr>
//             </thead>
//             <tbody>
//     ";

//     $rank = 1;
//     foreach ($logs as $row) {
//         $highlight = $rank === 1 ? 'class="champion"' : '';
//         $html .= "
//             <tr {$highlight}>
//                 <td class='rank'>{$rank}</td>
//                 <td>{$row->name}</td>
//                 <td>{$row->total_vervals}</td>
//             </tr>
//         ";
//         $rank++;
//     }

//     $html .= "
//             </tbody>
//         </table>
//     </body>
//     </html>
//     ";

//     return $html;
// });


Route::get('/show-verval-champion', function () {

    $counts = DB::select("
        SELECT 
            u.id AS user_id,
            u.name,
            COUNT(d.id) AS total_documents
        FROM emp_documents d
        JOIN users u ON u.id = d.assigned_to
        GROUP BY u.id, u.name
        ORDER BY total_documents DESC
    ");

    // Bangun HTML
    $html = "
    <html>
    <head>
        <title>Klasemen Verval Champion</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f9f9f9;
                padding: 40px;
            }
            h2 {
                text-align: center;
                margin-bottom: 20px;
                color: #333;
            }
            table {
                border-collapse: collapse;
                margin: 0 auto;
                background: #fff;
                box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                border-radius: 8px;
                overflow: hidden;
                width: 70%;
            }
            th, td {
                border-bottom: 1px solid #ddd;
                padding: 12px 16px;
                text-align: left;
            }
            th {
                background-color: #4CAF50;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #e6ffe6;
            }
            .rank {
                text-align: center;
                font-weight: bold;
            }
            .champion {
                background-color: gold !important;
                color: #000;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <h2>🏆 Klasemen Verval Champion</h2>
        <table>
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Nama</th>
                    <th>Total Dokumen</th>
                </tr>
            </thead>
            <tbody>
    ";

    $rank = 1;
    foreach ($counts as $row) {
        $highlight = $rank === 1 ? 'class="champion"' : '';
        $html .= "
            <tr {$highlight}>
                <td class='rank'>{$rank}</td>
                <td>{$row->name}</td>
                <td>{$row->total_documents}</td>
            </tr>
        ";
        $rank++;
    }

    $html .= "
            </tbody>
        </table>
    </body>
    </html>
    ";

    return $html;
});



Route::get('/show-pending-documents', function() {

    $rows = DB::table('work_units as wu')
        ->leftJoin('employees as e', function ($join) {
            $join->on('e.id_work_unit', '=', 'wu.id')
                ->whereNull('e.deleted_at');
        })
        ->leftJoin('emp_documents as d', function ($join) {
            $join->on('d.id_employee', '=', 'e.id')
                ->whereNull('d.deleted_at')
                ->where('d.status', '=', 'Pending');
        })
        ->whereNull('wu.deleted_at')
        ->groupBy('wu.id', 'wu.unit_code', 'wu.unit_name')
        ->orderBy('wu.unit_code') // atau unit_name
        ->select([
            'wu.id',
            'wu.unit_code',
            'wu.unit_name',
            DB::raw('COUNT(d.id) AS pending_count'),
        ])
        ->get();

    return $rows;
});


Route::get('oauth/google', [OauthController::class, 'redirectToProvider'])->name('oauth.google');  
Route::get('oauth/google/callback', [OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');

// Untuk redirect ke Google
Route::get('/login/google/redirect', [SocialiteController::class, 'redirect'])
    ->name('google.redirect');

// Untuk callback dari Google
Route::get('/login/google/callback', [SocialiteController::class, 'callback'])
    ->name('google.callback');

Route::middleware('auth')->group(function () {
    Route::get('/secure/documents/{nip}/{filename}', [PublicDocController::class, 'stream'])
        ->where(['nip' => '\d+', 'filename' => '[^/]+'])
        ->name('secure.docs.stream');
});

Route::get('/get-gdrive-file', function() {
    $path = '199407292022031002/AKYBS_199407292022031002.pdf';
    $data = Gdrive::get($path); // ->file (binary), ->ext (mime), ->name (opsional)

    // Pastikan mime-nya benar
    $mime = ($data->ext && str_contains($data->ext, '/'))
        ? $data->ext
        : 'application/pdf';

    return Response::make($data->file, 200, [
        'Content-Type'              => $mime,                 // penting: application/pdf
        'Content-Disposition'       => 'inline; filename="AKYBS_199407292022031002.pdf"',
        'Content-Transfer-Encoding' => 'binary',
        'Accept-Ranges'             => 'bytes',
        'Cache-Control'             => 'private, max-age=3600',
    ]);
});




Route::get('/show-duplicates', function(){
   
    
        // Ambil daftar file_name yang duplikat (belum soft-deleted)
        $dups = DB::table('emp_documents')
            ->select('file_name')
            ->whereNull('deleted_at')
            ->groupBy('file_name')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('file_name');

       return $dups;
});


Route::get('/delete-duplicates', function(){
   
    DB::transaction(function () {
        // Ambil daftar file_name yang duplikat (belum soft-deleted)
        $dups = DB::table('emp_documents')
            ->select('file_name')
            ->whereNull('deleted_at')
            ->groupBy('file_name')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('file_name');

        foreach ($dups as $name) {
            // Urutkan terbaru dulu (created_at desc), biarkan yang pertama tetap ada
            $rows = EmpDocument::where('file_name', $name)
                ->whereNull('deleted_at')
                ->orderByDesc('created_at')
                ->orderByDesc('id') // tie-breaker
                ->get();

            // Buang elemen pertama (terbaru) → sisanya di-soft delete
            $rows->skip(1)->each->delete();
        }
    });
});


Route::get('/delete-duplicates', function(){
   
    DB::transaction(function () {
        // Ambil daftar file_name yang duplikat (belum soft-deleted)
        $dups = DB::table('emp_documents')
            ->select('file_name')
            ->whereNull('deleted_at')
            ->groupBy('file_name')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('file_name');

        foreach ($dups as $name) {
            // Urutkan terbaru dulu (created_at desc), biarkan yang pertama tetap ada
            $rows = EmpDocument::where('file_name', $name)
                ->whereNull('deleted_at')
                ->orderByDesc('created_at')
                ->orderByDesc('id') // tie-breaker
                ->get();

            // Buang elemen pertama (terbaru) → sisanya di-soft delete
            $rows->skip(1)->each->delete();
        }
    });
});




Route::get('/checkfile', function(){
    $nip = '199407292022031002';
    $user = User::where('username', $nip)->with('employee')->first();
    $employee = $user->employee;


    $document = EmpDocument::where('id_employee', $employee->id)->first();
    $log = '';


     // Cek di disk yang benar
    if (!Storage::exists($document->file_path)) {
        // Log::warning("File not found for delete: {$document->file_path}");
        $log .= "File not found on local for delete: {$document->file_path}";
        $log .= "<br>";
    } else {
        $log .= "File FOUND on local for delete: {$document->file_path}";
        $log .= "<br>";

    }

    
    // Cek di disk yang benar
    if (!Storage::disk('public')->exists($document->file_path)) {
        // Log::warning("File not found for delete: {$document->file_path}");
        $log .= "File not found on public for delete: {$document->file_path}";
        $log .= "<br>";

    } else {
        $log .= "File FOUND on public for delete: {$document->file_path}";
        $log .= "<br>";

    }

    return $log;

   
});


Route::get('/getfiles', function(){
    $nip = '199407292022031002';
    $user = User::where('username', $nip)->with('employee')->first();
    $employee = $user->employee;


    $empDocs = EmpDocument::where('id_employee', $employee->id)->get();

    return $empDocs;
});


Route::get('/checkfiles', function () {

    $nip = '199407292022031002';
    $user = User::where('username', $nip)->with('employee')->first();
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
        $docTypeId = DocType::where('label', $label)->first()->id;
        
        EmpDocument::firstOrCreate([
            'id_employee' => $employee->id,
            'id_doc_type' => $docTypeId,
            'parameter' => $param,
            'file_path' => $directory . '/' . $fileName,
            'file_name' => $fileName,
            'status' => 'Approved',
        ]);
    }

    $user->update(['docs_update_state' => true]);

    return 'done';

});

Route::get('/set-admin', function() {

    // $nipadmin = '199407292022031002';
    // $user = User::where('username', $nipadmin)->first();

    // $user->update([
    //     'role' => App\Enums\RoleType::SUPERADMIN->value,
    //     'can_multiple_role' => true
    // ]);

    // $user->roles()->syncWithoutDetaching([
    //     Role::where('name', 'SUPERADMIN')->first()->id,
    //     Role::where('name', 'ADMIN')->first()->id,
    //     Role::where('name', 'REVIEWER')->first()->id,
    // ]);

    // return $user->fresh();

    $nipadmins = [
        '199407292022031002', // Yud
        '198005152005011007', // Jarmil
        '198810252023211021', // Fauzhi
        '197505152005012003', // Anna
        '198305042014111002', // Koko
        '199307222023211014', // Azka
        '198006222014112002', // Sri
        '198605052023212065', // Ija
        '197904092023212012', // Amak
        '199009152023211019', // Kiki
    ];

    $users = User::whereIn('username', $nipadmins)->get();

    foreach ($users as $key => $user) {
        if($user->username == '199407292022031002') {
            $user->update([
                'role' => App\Enums\RoleType::SUPERADMIN->value,
                'can_multiple_role' => true
            ]);
    
            $user->roles()->syncWithoutDetaching([
                Role::where('name', 'SUPERADMIN')->first()->id,
                Role::where('name', 'ADMIN')->first()->id,
                Role::where('name', 'REVIEWER')->first()->id,
            ]);
        } else {
            $user->update([
                'role' => App\Enums\RoleType::REVIEWER->value,
                'can_multiple_role' => true
            ]);
    
            $user->roles()->syncWithoutDetaching([
                Role::where('name', 'REVIEWER')->first()->id,
            ]);
        }
        
        
    }

    return 'done';
});

Route::get('/employee-to-user-faster', function () {
    ini_set('max_execution_time', '300');
    DB::connection()->disableQueryLog();

    // hash sekali saja → hemat CPU
    $defaultHashed = Hash::make('GantiPassword123!'); // TODO: paksa user ganti di login pertama

    $now = now();
    $total = 0;

    // Ambil kolom minimal, yang belum punya user
    \App\Models\Employee::doesntHave('user')
        ->select('id', 'full_name', 'email', 'nip')
        ->whereNotNull('email')   // opsional: hanya yang punya email
        ->chunkById(1000, function ($chunk) use (&$total, $defaultHashed, $now) {
            $rows = [];
            foreach ($chunk as $e) {
                $rows[] = [
                    'id_employee' => $e->id,
                    'name'        => $e->full_name,
                    'email'       => $e->email,
                    'username'    => $e->nip,
                    'password'    => $defaultHashed,
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ];
            }

            // upsert berdasarkan id_employee (unik)
            \App\Models\User::withoutEvents(function () use ($rows) {
                \App\Models\User::upsert(
                    $rows,
                    ['id_employee'],                                   // uniqueBy
                    ['name', 'email', 'username', 'password','updated_at'] // update columns
                );
            });

            $total += count($rows);
        });

    return response()->json(['status' => 'ok', 'affected' => $total]);
});

Route::get('/employee-to-user', function() {
    ini_set('max_execution_time', '300'); //300 seconds = 5 minutes

    $employees = Employee::doesntHave('user')->get();
        foreach ($employees as $key => $employee) {

            User::updateOrCreate(
                [
                    'email' =>  $employee->email,
                    'username' => $employee->nip
                ],
                [
                    'name' => $employee->full_name,
                    'password' => Hash::make($employee->nip),
                    'id_employee' => $employee->id
                ]
            );
        }

        return 'success';
});

Route::get('/print-lckb/{monthYear}', [PrintController::class, 'document']);
Route::get('/preview-lckb/{monthYear}/{user_id}', [PrintController::class, 'preview']);

Route::get('/logout_all', function () {
    \App\Models\User::each(function ($u) {
        Auth::login($u);
        Auth::logout();
    });

    return 'done';
});


Route::get('/terms-and-conditions', function () {
    return view('tnc');
});


Route::get('/terms-of-service', function () {
    return view('tos');
});

Route::get('/privacy-policy', function () {
    return view('privacy_policy');
});

Route::get('/landing', function () {
    return view('landing2');
});

Route::get('/', function () {
    return view('/landing');
});



Route::get('/get-password', function () {
    return 'apasih';
    // bcrypt('12345678');
});

Route::get('/all-users', function () {
    $users = \App\Models\User::all()->pluck('nip_name')->sort();
    // $users = $users->toArray();
    // return $users;

    $html = '';
    foreach ($users as $user) {

        $bod = substr($user, 0, 8);
        $dob = DateTime::createFromFormat('Ymd', $bod);
        // return $ymd;
        $today   = new DateTime('today');
        $year = $dob->diff($today)->y;
        $month = $dob->diff($today)->m;
        $day = $dob->diff($today)->d;

        $tgllahir = $year." tahun"." ".sprintf('%02d', $month)." bulan"." ".sprintf('%02d', $day)." hari";

        $html .= $tgllahir . '    -    ' .$user . '<br>';
    }

    return $html;
});

Route::middleware('auth')->group(function () {


    Route::get('api/preview/pdf', [EmpDocumentController::class, 'show'])
        ->name('pdf.preview');

    Route::get('/api/verval-logs', [VervalLogController::class, 'index']);


    Route::get('/api/master', [MasterController::class, 'index']);

    Route::get('/api/reports', [ReportController::class, 'index']);

    Route::get('/api/stats/all', [DashboardController::class, 'all']);

    Route::get('/api/stats/reports', [DashboardController::class, 'reports']);
    Route::get('/api/fusers', [UserController::class, 'fetch']);

    Route::get('/api/fetch-orgs', [OrganizationController::class, 'fetch']);
    Route::get('/api/orgs', [OrganizationController::class, 'index']);
    Route::post('api/orgs', [OrganizationController::class, 'store']);
    Route::put('api/orgs/{org}', [OrganizationController::class, 'update']);
    Route::delete('/api/orgs/{org}', [OrganizationController::class, 'destroy']);
    Route::delete('/api/orgs', [OrganizationController::class, 'bulkDelete']);


    Route::get('/api/users', [UserController::class, 'index']);
    Route::post('api/users', [UserController::class, 'store']);
    Route::put('api/users/{user}', [UserController::class, 'update']);
    Route::delete('/api/users/{user}', [UserController::class, 'destroy']);
    Route::patch('/api/users/{user}/change-role', [UserController::class, 'changeRole']);
    Route::delete('/api/users', [UserController::class, 'bulkDelete']);

    Route::get('/api/reports', [ReportController::class, 'index']);
    Route::post('/api/reports/create', [ReportController::class, 'store']);
    Route::get('/api/reports/{work}/edit', [ReportController::class, 'edit']);
    Route::put('/api/reports/{work}/edit', [ReportController::class, 'update']);
    Route::delete('/api/reports/{work}', [ReportController::class, 'destroy']);

    Route::delete('/api/parent-reports/{report}', [ReportController::class, 'destroyParent']);


    Route::get('/api/settings', [SettingController::class, 'index']);
    Route::post('/api/settings', [SettingController::class, 'update']);

    Route::get('/api/profile', [ProfileController::class, 'index']);
    Route::get('/api/docs-update-state', [ProfileController::class, 'docsUpdateState']);
    Route::put('/api/profile', [ProfileController::class, 'update']);
    Route::post('/api/upload-profile-image', [ProfileController::class, 'uploadImage']);
    Route::post('/api/change-user-password', [ProfileController::class, 'changePassword']);




    Route::get('/api/employee/documents', [EmployeeDocumentController::class, 'index']);
    Route::post('/api/employee/documents', [EmployeeDocumentController::class, 'store']);
    Route::patch('/employee/documents/{id}/status', [EmployeeDocumentController::class, 'updateStatus']);
    Route::delete('/employee/documents/{id}', [EmployeeDocumentController::class, 'destroy']);

    Route::get('/api/my-documents', [DocumentController::class, 'myDocuments']);
    Route::post('/api/upload-document', [DocumentController::class, 'uploadDocument']);
    Route::post('/api/reupload-document/{id}', [DocumentController::class, 'reupload']);
    Route::get('/api/user-documents/{userId}', [DocumentController::class, 'documentsByUserId']);
    Route::get('/api/sync-files', [DocumentController::class, 'syncFiles']);



    Route::prefix('/api/work-units')->group(function () {
        Route::get('{id}/employees', [WorkUnitController::class, 'fetchEmployee']);


        // Get tree data
        Route::get('/tree', [WorkUnitController::class, 'tree']);
        Route::get('/monitor', [WorkUnitController::class, 'monitor']);
        Route::get('/fetch', [WorkUnitController::class, 'fetch']);
    
        // CRUD Routes
        Route::get('/', [WorkUnitController::class, 'index']);           // Optional: List semua unit (flat)
        Route::post('/', [WorkUnitController::class, 'store']);          // Create new unit
        Route::get('/{id}', [WorkUnitController::class, 'show']);        // Optional: Get single unit
        Route::put('/{id}', [WorkUnitController::class, 'update']);      // Update unit
        Route::delete('/{id}', [WorkUnitController::class, 'destroy']);  // Delete unit
    });


    Route::get('/api/emp-documents', [EmpDocumentController::class, 'index']);
    Route::post('api/emp-documents/claim', [EmpDocumentController::class, 'claim']);
    Route::put('/api/emp-documents/{id}/verify', [EmpDocumentController::class, 'verify']);
    Route::post('api/emp-documents/{empDocument}/release', [EmpDocumentController::class, 'release']);
    Route::get('/api/document-log/{id}', [DocumentLogController::class, 'show']);
    Route::get('/api/emp-documents/remaining', [EmpDocumentController::class, 'remaining']);


});

Route::get('{view}', ApplicationController::class)->where('view', '(.*)')->middleware('auth');
