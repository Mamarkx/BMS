<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use Illuminate\Http\Request;

class EmployeeManagement extends Controller
{
    public function AddEmp(Request $request)
    {
        $validated = $request->validate([
            'personnel_id' => 'required|unique:personnel,personnel_id|max:255',
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
            'status' => 'required|in:Active,Inactive,Resigned,Terminated',
            'emergency_contact' => 'nullable|max:100',
            'emergency_number' => 'nullable|max:15',
        ]);

        // Create new Personnel record
        EmployeeModel::create($validated);

        // Redirect or return a response
        return redirect()->route('ShowEmployee')->with('success', 'Added Successfully!');
    }
    public function ShowEmp(Request $request)
    {

        $personnel = EmployeeModel::paginate(5);
        $countEmp = EmployeeModel::all()->count();
        $countActive = EmployeeModel::where('status', 'active')->count();
        $countLeaveEmp = EmployeeModel::where("status", 'On leave')->count();
        return view('AdminSide.EmployeeManage', compact('personnel', 'countEmp', 'countActive', 'countLeaveEmp'));
    }
    public function ShowRes() {}
}
