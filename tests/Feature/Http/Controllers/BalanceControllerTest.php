<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Balance;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BalanceController
 */
final class BalanceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $balances = Balance::factory()->count(3)->create();

        $response = $this->get(route('balances.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BalanceController::class,
            'store',
            \App\Http\Requests\BalanceControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $amount = fake()->randomFloat(/** float_attributes **/);
        $currency = fake()->word();
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create();

        $response = $this->post(route('balances.store'), [
            'amount' => $amount,
            'currency' => $currency,
            'user_id' => $user->id,
            'transaction_id' => $transaction->id,
        ]);

        $balances = Balance::query()
            ->where('amount', $amount)
            ->where('currency', $currency)
            ->where('user_id', $user->id)
            ->where('transaction_id', $transaction->id)
            ->get();
        $this->assertCount(1, $balances);
        $balance = $balances->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $balance = Balance::factory()->create();

        $response = $this->get(route('balances.show', $balance));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BalanceController::class,
            'update',
            \App\Http\Requests\BalanceControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $balance = Balance::factory()->create();
        $amount = fake()->randomFloat(/** float_attributes **/);
        $currency = fake()->word();
        $user = User::factory()->create();
        $transaction = Transaction::factory()->create();

        $response = $this->put(route('balances.update', $balance), [
            'amount' => $amount,
            'currency' => $currency,
            'user_id' => $user->id,
            'transaction_id' => $transaction->id,
        ]);

        $balance->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($amount, $balance->amount);
        $this->assertEquals($currency, $balance->currency);
        $this->assertEquals($user->id, $balance->user_id);
        $this->assertEquals($transaction->id, $balance->transaction_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $balance = Balance::factory()->create();

        $response = $this->delete(route('balances.destroy', $balance));

        $response->assertNoContent();

        $this->assertModelMissing($balance);
    }
}
