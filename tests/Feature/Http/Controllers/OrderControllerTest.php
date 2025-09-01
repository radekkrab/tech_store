<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrderController
 */
final class OrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $orders = Order::factory()->count(3)->create();

        $response = $this->get(route('orders.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'store',
            \App\Http\Requests\OrderControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $status = fake()->randomElement(/** enum_attributes **/);
        $total_amount = fake()->randomFloat(/** float_attributes **/);
        $payment_method = fake()->randomElement(/** enum_attributes **/);
        $payment_id = fake()->word();
        $user = User::factory()->create();

        $response = $this->post(route('orders.store'), [
            'status' => $status,
            'total_amount' => $total_amount,
            'payment_method' => $payment_method,
            'payment_id' => $payment_id,
            'user_id' => $user->id,
        ]);

        $orders = Order::query()
            ->where('status', $status)
            ->where('total_amount', $total_amount)
            ->where('payment_method', $payment_method)
            ->where('payment_id', $payment_id)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $orders);
        $order = $orders->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('orders.show', $order));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'update',
            \App\Http\Requests\OrderControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $order = Order::factory()->create();
        $status = fake()->randomElement(/** enum_attributes **/);
        $total_amount = fake()->randomFloat(/** float_attributes **/);
        $payment_method = fake()->randomElement(/** enum_attributes **/);
        $payment_id = fake()->word();
        $user = User::factory()->create();

        $response = $this->put(route('orders.update', $order), [
            'status' => $status,
            'total_amount' => $total_amount,
            'payment_method' => $payment_method,
            'payment_id' => $payment_id,
            'user_id' => $user->id,
        ]);

        $order->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($status, $order->status);
        $this->assertEquals($total_amount, $order->total_amount);
        $this->assertEquals($payment_method, $order->payment_method);
        $this->assertEquals($payment_id, $order->payment_id);
        $this->assertEquals($user->id, $order->user_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $order = Order::factory()->create();

        $response = $this->delete(route('orders.destroy', $order));

        $response->assertNoContent();

        $this->assertModelMissing($order);
    }
}
