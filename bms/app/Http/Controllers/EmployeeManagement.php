<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use Illuminate\Http\Request;

class EmployeeManagement extends Controller
{
    public function AddEmp(Request $request)
    {

        $latestPersonnel = EmployeeModel::orderByRaw('CAST(SUBSTRING(personnel_id, 6) AS UNSIGNED) DESC')->first();
        $nextNumber = $latestPersonnel ? ((int) str_replace('PERS-', '', $latestPersonnel->personnel_id) + 1) : 1;
        $personnelId = 'PERS-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $validated = $request->validate([
            'first_name' => 'required|max:100',
            'middle_name' => 'nullable|max:100',
            'last_name' => 'required|max:100',
            'gender' => 'required|in:Male,Female,Other',
            'birthdate' => 'required|date',
            'contact_number' => 'required|max:15',
            'email' => 'required|email|max:100',
            'address' => 'required|max:255',
            'position_title' => 'required|max:100',
            'department' => 'required|max:100',
            'hire_date' => 'required|date',
            'emergency_contact' => 'nullable|max:100',
            'emergency_number' => 'nullable|max:15',
        ]);
        $validated['personnel_id'] = $personnelId;
        EmployeeModel::create($validated);
        return redirect()->route('ShowEmployee')->with('success', 'Added Successfully!');
    }
    public function editemployee(Request $request)
    {


        $employee = EmployeeModel::where('id', $request->id)->firstOrFail();

        $employee->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'address' => $request->address,
            'position_title' => $request->position_title,
            'department' => $request->department,
            'hire_date' => $request->hire_date,
            'status' => $request->status,
            'emergency_contact' => $request->emergency_contact,
            'emergency_number' => $request->emergency_number,
        ]);

        return redirect()->back()->with('success', 'Employee updated successfully!');
    }

    public function ShowEmp(Request $request)
    {

        $personnel = EmployeeModel::paginate(5);
        $countEmp = EmployeeModel::all()->count();
        $countActive = EmployeeModel::where('status', 'active')->count();
        $countLeaveEmp = EmployeeModel::where("status", 'On leave')->count();
        return view('AdminSide.EmployeeManage', compact('personnel', 'countEmp', 'countActive', 'countLeaveEmp'));
    }

    public function DestroyEmployee($id)
    {
        $personnel = EmployeeModel::find($id);

        if (!$personnel) {
            return redirect()->back()->with('error', 'Employee not found.');
        }

        $personnel->delete();

        return redirect()->back()->with('success', 'Employee deleted successfully.');
    }
 
}
