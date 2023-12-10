<?php

namespace App\Http\Controllers;

use App\Models\IncomeAndExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function UserDashboard()
    {
        $user = Auth::user();
        $transaction = IncomeAndExpense::where('user_id', $user->id)->paginate(5);
//        //        $transaction = $user->transactions;
        $total_income = $user->transactions->where('type', 'income')->sum('amount');
        $total_expenses  = $user->transactions->where('type', 'expenses')->sum('amount');
        $total_balance = $total_income - $total_expenses;

        return view('UserDashboard', compact('user', 'transaction', 'total_income', 'total_expenses', 'total_balance'));
    }


    public function filter(Request $request)
    {
        $user = Auth::user();

        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $type = $request->input('type');

        $query = IncomeAndExpense::where('user_id', $user->id);

        if($fromDate){
            $query->where('date', '>=', $fromDate);
        }

        if($toDate){
            $query->where('date', '<=', $toDate);
        }

        if($type){
            $query->where('type', $type);
        }

        $transaction = $query->paginate(5);

        $total_income = $query->where('type', 'income')->sum('amount');
        $total_expenses = $query->where('type', 'expenses')->sum('amount');
        $total_balance = $total_income - $total_expenses;

        return view('UserDashboard', compact('user', 'transaction', 'total_income', 'total_expenses', 'total_balance'));
    }

}
