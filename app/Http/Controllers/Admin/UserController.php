<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('adminDashboard.ecom-customers', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8',
        ]);
    
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
    
        $user->save();
    
        return redirect()->route('admin.customers.index')->with('success', 'User added successfully.');
    }
    
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.customers.index')->with('success', 'User deleted successfully.');
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('adminDashboard.edit-user', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'password' => 'nullable|string|min:8',
        ]);
    
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
    
        $user->save();
    
        return redirect()->route('admin.customers.index')->with('success', 'User updated successfully.');
    }
    
    
    public function massDelete(Request $request)
    {
        $userIds = $request->input('ids');

        if ($userIds) {
            User::whereIn('id', $userIds)->delete();
            return redirect()->route('admin.customers.index')->with('success', 'Selected users were deleted successfully.');
        }

        return back()->with('error', 'No users selected for deletion.');
    }
    public function massUpdate(Request $request)
    {
        $usersData = $request->get('users', []);
        $updateCount = 0;
        
        foreach ($usersData as $userId => $userData) {
            if (isset($userData['checked'])) { 
                try {
                    $user = User::findOrFail($userId);
                    $user->name = $userData['name'];
                    $user->email = $userData['email'];
                    if (!empty($userData['password'])) {
                        $user->password = Hash::make($userData['password']);
                    }
                    $user->save();
                    $updateCount++;
                } catch (\Exception $e) {
                    return back()->with('error', 'Failed to update some users. Error: ' . $e->getMessage());
                }
            }
        }
        
        return redirect()->route('admin.customers.index')->with('success', $updateCount . ' users updated successfully.');
    }
    

}
