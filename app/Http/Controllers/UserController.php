<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Load all users
    public function loadAllUsers()
    {
        $all_users = User::all();
        return view('users', compact('all_users')); // Make sure view file is 'users.blade.php'
    }

    // Load form to add user
    public function loadAddUserForm()
    {
        return view('add-user');
    }

    // Handle add user form submission
    public function AddUser(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required',
            'password' => 'required|confirmed|min:4|max:8',
        ]);

        try {
            $new_user = new User;
            $new_user->name = $request->full_name;
            $new_user->email = $request->email;
            $new_user->phone_number = $request->phone_number;
            $new_user->password = Hash::make($request->password);
            $new_user->save();

            return redirect('/users')->with('success', 'User Added Successfully');
        } catch (\Exception $e) {
            return redirect('/add/user')->with('fail', $e->getMessage());
        }
    }

    // Load form to edit a user
    public function loadEditForm($id)
    {
        $user = User::findOrFail($id);
        return view('edit-user', compact('user'));
    }

    // Handle update user form
    public function EditUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $request->user_id,
            'phone_number' => 'required',
        ]);

        try {
            User::where('id', $request->user_id)->update([
                'name' => $request->full_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);

            return redirect('/users')->with('success', 'User Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('fail', $e->getMessage());
        }
    }

    // Delete a user
    public function deleteUser($id)
    {
        try {
            User::destroy($id);
            return redirect('/users')->with('success', 'User Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect('/users')->with('fail', $e->getMessage());
        }
    }
}
