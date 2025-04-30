<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::withAggregate('employee','id_work_unit')->with([
            'employee.workUnit'
        ])
        ->when($request->search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhereHas('employee', function ($q) use ($search) {
                    $q->where('full_name', 'like', "%{$search}%")
                        ->orWhere('nip', 'like', "%{$search}%")
                        ->orWhereHas('workUnit', function ($q) use ($search) {
                            $q->where('unit_name', 'like', "%{$search}%");
                        });
                });
            });
        })
        ->orderBy('employee_id_work_unit', 'asc')
        ->paginate(10);

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email|unique:employees,email',
            'nip' => 'required|unique:employees,nip',
            'password' => 'required|string|min:6',
        ]);

        $employee = Employee::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'nip' => $request->nip,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'job_title' => $request->job_title,
            'id_work_unit' => $request->id_work_unit,
            'employment_status' => $request->employment_status,
            'tmt_jabatan' => $request->tmt_jabatan,
            'tmt_pangkat' => $request->tmt_pangkat,
        ]);

        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'username' => $request->nip,
            'password' => Hash::make($request->password),
            'id_employee' => $employee->id,
        ]);

        return response()->json(['message' => 'User created', 'data' => $user], 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::with('employee')->findOrFail($id);

        $user->update([
            'name' => $request->full_name,
            'email' => $request->email,
            'username' => $request->nip,
        ]);

        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        $user->employee()->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'nip' => $request->nip,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'job_title' => $request->job_title,
            'id_work_unit' => $request->id_work_unit,
            'employment_status' => $request->employment_status,
            'tmt_jabatan' => $request->tmt_jabatan,
            'tmt_pangkat' => $request->tmt_pangkat,
        ]);

        return response()->json(['message' => 'User updated']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $employee = $user->employee;

        $user->delete();
        if ($employee) {
            $employee->delete();
        }

        return response()->json(['message' => 'User deleted']);
    }

    public function changeRole(User $user)
    {

        $user->update([
            'role' => request('role'),
        ]);

        return response()->json(['success' => true]);
    }

    public function bulkDelete()
    {
        User::whereIn('id', request('ids'))->delete();

        return response()->json(['message' => 'Users deleted successfully']);
    }

    public function fetch()
    {

        return auth()->user()->id;

    }

}
