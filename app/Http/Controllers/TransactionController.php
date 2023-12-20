<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateInterval;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $currentDate = new DateTime();
        $endDate = $currentDate->format('Y-m-d').' 23:59:59';
        $startDate = $currentDate->sub(new DateInterval('P7D'))->format('Y-m-d');
        $userTransactions = Auth::user()->transactions()->whereBetween('created_at', [$startDate, $endDate])->paginate(8);
        $currentBalance = 0;

        foreach($userTransactions as $t) {
            $currentBalance+= $t->amount;
        }
        
        // dd($userTransactions);
        return view('transactions.index', [
            'transactions' => $userTransactions,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currentBalance' => $currentBalance,
        ]);
    }

    public function filtered(Request $request)
    {
        $startDate = $request['startDate'];
        $endDate = $request['endDate'].' 23:59:59';

        $userTransactions = Auth::user()->transactions()->whereBetween('created_at', [$startDate, $endDate])->paginate(8);

        return view('transactions.index', [
            'transactions' => $userTransactions,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:33',
            'amount' => 'required|numeric|gt:0',
        ]);
        if($request->type === 'expense') {
            $validated["amount"] = -$validated["amount"];
        } 
        $request->user()->transactions()->create($validated);
 
        return redirect(route('transactions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', [
            'transaction' => $transaction, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:33',
            'amount' => 'required|numeric|gt:0',
        ]);
    
        if ($request->type === 'expense') {
            $validated['amount'] = -$validated['amount'];
        }
    
        $transaction->update($validated);
    
        return redirect(route('transactions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
 
        return redirect(route('transactions.index'));
    }
}
