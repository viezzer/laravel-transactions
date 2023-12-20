<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IncomeExpense extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $income,
        public string $expense,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.income-expense');
    }
}
