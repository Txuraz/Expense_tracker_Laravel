<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNewEntryFormRequest;
use App\Models\IncomeAndExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeExpensesController extends Controller
{
    public function AddIncomeExpenses(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'category' => 'required',
        ]);

        $inome_expens = [
            'user_id' => Auth::user()->id,
            'amount' => $request->amount,
            'category' => $request->category,
            'type' => $request->type,
            'date' => $request->date,
        ];

        IncomeAndExpense::create($inome_expens);
        return redirect()->back()->with('message', 'Added Successfully !');
    }
}
