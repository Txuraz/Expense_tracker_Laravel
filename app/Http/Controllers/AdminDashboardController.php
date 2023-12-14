<?php

namespace App\Http\Controllers;

use App\Models\IncomeAndExpense;
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

    public function UserDetails($id)
    {

        $user = User::find($id);
        $incomeExpenses = $user->transactions()->paginate(4);
        $total_income = $user->transactions->where('type', 'income')->sum('amount');
        $total_expenses  = $user->transactions->where('type', 'expenses')->sum('amount');
        $total_balance = $total_income - $total_expenses;
        return view('UserDetails', compact('user', 'incomeExpenses', 'total_income', 'total_expenses', 'total_balance'));
    }

    public function DeleteUserDetails($id)
    {
        IncomeAndExpense::find($id)->delete();
        return redirect()->back();
    }

}
