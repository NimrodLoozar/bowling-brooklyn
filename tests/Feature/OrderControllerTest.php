<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index page.
     */
    public function test_index_displays_orders(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $orders = Order::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->get(route('orders.index'));

        $response->assertStatus(200);
        $response->assertSee($orders->first()->product[0]); // Check if the first product is visible
    }

    /**
     * Test creating a new order.
     */
    public function test_store_creates_order(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'product' => ['Pizza', 'Hamburger'],
            'sub_product' => ['Cola', 'Fanta'],
            'status' => 'Nieuw',
            'totaalbedrag' => 50.00,
            'betaalmethode' => 'Creditcard',
            'betaalstatus' => 'Betaald',
            'aantal' => 2,
            'opmerking' => 'Test order',
        ];

        $response = $this->post(route('orders.store'), $data);

        $response->assertRedirect(route('orders.index'));
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'status' => 'Nieuw',
            'totaalbedrag' => 50.00,
        ]);
    }

    /**
     * Test editing an order.
     */
    public function test_update_edits_order(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $order = Order::factory()->create(['user_id' => $user->id]);

        $data = [
            'product' => ['Friet'],
            'sub_product' => ['Water'],
            'status' => 'Geannuleerd',
            'totaalbedrag' => 25.00,
            'betaalmethode' => 'PayPal',
            'betaalstatus' => 'Niet betaald',
            'aantal' => 1,
            'opmerking' => 'Updated order',
        ];

        $response = $this->put(route('orders.update', $order), $data);

        $response->assertRedirect(route('orders.index'));
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'Geannuleerd',
            'totaalbedrag' => 25.00,
        ]);
    }

    /**
     * Test deleting an order.
     */
    public function test_destroy_deletes_order(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $order = Order::factory()->create(['user_id' => $user->id, 'status' => 'Geannuleerd', 'betaalstatus' => 'Betaald']);

        $response = $this->delete(route('orders.destroy', $order));

        $response->assertRedirect(route('orders.index'));
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }
}
