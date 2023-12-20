<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Transaction;

class ViewTransactionsTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_display_all_transactions(): void
    {
        $transaction = Transaction::factory('App/Transaction')->create();
        $this->get('/transactions')->assertSee($transaction->title);
    }
}
