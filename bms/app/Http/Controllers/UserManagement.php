<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Google\Service\AndroidEnterprise\Resource\Users;
use Illuminate\Support\Facades\Hash;

class UserManagement extends Controller
{
    public function ShowUsers()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(5);
        return view('AdminSide.UserManagement', compact('users'));
    }
    public function AddAcc(Request $request)
    {
        $validatedData = $request->validate([
            'first_name'  => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name'   => 'required|string|max:255',
            'suffix'      => 'nullable|string|max:10',
            'address'     => 'nullable|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:6|confirmed',
            'role'        => 'required|string|in:Admin,Resident',
        ], [
            'first_name.required' => 'The first name is required.',
            'last_name.required'  => 'The last name is required.',
            'email.required'      => 'The email is required.',
            'email.unique'        => 'This email is already registered.',
            'password.required'   => 'The password is required.',
            'password.confirmed'  => 'The password confirmation does not match.',
            'role.required'       => 'The user role is required.',
        ]);

        $user = User::create([
            'first_name'  => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'] ?? null,
            'last_name'   => $validatedData['last_name'],
            'suffix'      => $validatedData['suffix'] ?? null,
            'address'     => $validatedData['address'] ?? null,
            'email'       => $validatedData['email'],
            'password'    => Hash::make($validatedData['password']),
            'role'        => $validatedData['role'],
            'status'      => 'Active',
        ]);

        return redirect()->back()->with('success', 'Account created successfully!');
    }

    public function UpdateAcc(Request $request)
    {
        $validatedData = $request->validate([
            'id'          => 'required|exists:users,id',
            'first_name'  => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name'   => 'required|string|max:255',
            'suffix'      => 'nullable|string|max:10',
            'address'     => 'nullable|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $request->id,
            'password'    => 'nullable|string|min:6|',
            'role'        => 'required|string|in:Admin,Resident,Super Admin',
            'status'      => 'required|string|in:Active,Inactive',
        ], [
            'id.required'        => 'User ID is required.',
            'id.exists'          => 'The selected user does not exist.',
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required'     => 'Email is required.',
            'email.email'        => 'Please enter a valid email address.',
            'email.unique'       => 'This email is already in use.',
            'password.min'       => 'Password must be at least 6 characters.',
            'role.required'      => 'User role is required.',
            'status.required'    => 'User status is required.',
        ]);

        $user = User::findOrFail($request->id);

        $user->first_name  = $validatedData['first_name'];
        $user->middle_name = $validatedData['middle_name'] ?? null;
        $user->last_name   = $validatedData['last_name'];
        $user->suffix      = $validatedData['suffix'] ?? null;
        $user->address     = $validatedData['address'] ?? null;
        $user->email       = $validatedData['email'];
        $user->role        = $validatedData['role'];
        $user->status      = $validatedData['status'];

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Account updated successfully!');
    }
    public function DeleteAcc($id)
    {
        $personnel = User::find($id);

        if (!$personnel) {
            return redirect()->back()->with('error', 'Account not found.');
        }

        $personnel->delete();

        return redirect()->route('UserManage')->with('success', 'Deleted Successfully.');
    }
}
