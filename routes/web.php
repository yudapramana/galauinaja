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
use App\Http\Controllers\API\DocumentLogController;
use App\Http\Controllers\API\WorkUnitController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\User\DocumentController;
use App\Http\Controllers\User\EmployeeDocumentController;
use App\Models\DocType;
use App\Models\EmpDocument;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Storage;

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

Route::get('/landing', function () {
    return view('landing');
});

Route::get('/', function () {
    // return 'jancok';
    return redirect('/landing');
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
        // Get tree data
        Route::get('/tree', [WorkUnitController::class, 'tree']);
    
        // CRUD Routes
        Route::get('/', [WorkUnitController::class, 'index']);           // Optional: List semua unit (flat)
        Route::post('/', [WorkUnitController::class, 'store']);          // Create new unit
        Route::get('/{id}', [WorkUnitController::class, 'show']);        // Optional: Get single unit
        Route::put('/{id}', [WorkUnitController::class, 'update']);      // Update unit
        Route::delete('/{id}', [WorkUnitController::class, 'destroy']);  // Delete unit
    });


    Route::get('/api/emp-documents', [EmpDocumentController::class, 'index']);
    Route::put('/api/emp-documents/{id}/verify', [EmpDocumentController::class, 'verify']);


    Route::get('/api/document-log/{id}', [DocumentLogController::class, 'show']);


});

Route::get('{view}', ApplicationController::class)->where('view', '(.*)')->middleware('auth');
