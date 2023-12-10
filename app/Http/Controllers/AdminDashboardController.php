<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function AdminDashboardView()
    {

        $user = Auth::user();
        $userdata = User::paginate(5);
        $total = User::count();
        return view('AdminDashboard', compact('userdata', 'user', 'total'));
    }



    public function UpdateUser(Request $request, $id)
    {
        $userdata = User::findorfail($id);

        $userdata->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
            return redirect()->back()->with('message', 'Saved Successfullt');

    }



    public function DeleteUser($id)
    {
        $userdata = User::findorfail($id);
        $userdata->delete();

        return redirect()->back();
    }


}
