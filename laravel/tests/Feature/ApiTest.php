<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_category()
    {
        $response = $this->get('/api/category');

        $response->assertStatus(200);
    }

    public function test_items()
    {
        $response = $this->get('/api/items');

        $response->assertStatus(200);
        // $response ->assertJsonStructure([
        //     'data' => [
        //         '*' => [
        //             'id',
        //             'title',
        //             'description',
        //             'category_id',
        //             'period_id',
        //             'status'
        //         ]
        //     ]
        // ]);
    }

    public function test_items_id()
    {
        $response = $this->get('/api/items/2');

        $response->assertStatus(200);
    }

    public function test_rentalList()
    {
        $response = $this->get('/api/rentalList');

        $response->assertStatus(200);
    }

    public function test_rentalList_id()
    {
        $response = $this->get('/api/rentalList/2');

        $response->assertStatus(200);
    }

    public function test_period()
    {
        $response = $this->get('/api/period');

        $response->assertStatus(200);
    }

    public function test_post_item()
    {
        $response = $this->postJson('/api/items', [
                    'title'=> 'MsE',
                    'description'=> 'what is MsE',
                    'category_id'=> 5,
                    'period_id'=> 4,
                    'status'=> 0
        ]);

        $response->assertStatus(201)
                 ->assertExactJson([
                    'message' => "Item record created",
                ]);
    }

    public function test_post_item_bad()
    {
        $response = $this->postJson('/api/items', [
                    // 'title'=> 'MsE',
                    'description'=> 'what is MsE',
                    'category_id'=> 5,
                    'period_id'=> 4,
                    'status'=> 0
        ]);

        $response->assertStatus(201)
                 ->assertExactJson([
                    'message' => "Item record created",
                ]);
    }

}
