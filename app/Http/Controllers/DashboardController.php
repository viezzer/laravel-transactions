<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userTransactions = Auth::user()->transactions()->latest()->get();
        $currentBalance = 0;
        $income = 0;
        $expense= 0;
        foreach($userTransactions as $t) {
            $currentBalance+= $t->amount;
            if($t->amount>0) {
                $income+= $t->amount;
            } else {
                $expense+= $t->amount;
            }
        }
        // dd($userTransactions);
        return view('dashboard', [
            'balance' => number_format($currentBalance, 2,),
            'income' => number_format($income, 2),
            'expense' => number_format(abs($expense), 2),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
