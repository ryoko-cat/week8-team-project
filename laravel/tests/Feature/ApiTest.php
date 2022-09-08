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
    }

    public function test_items_id()
    {
        $response = $this->get('/api/items/1');
        $response->assertStatus(200);
    }

    public function test_rentalList()
    {
        $response = $this->get('/api/rentalList');
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
        ]);

        $response->assertStatus(201);
        $response->assertExactJson([
                    'message' => "Item record created",
                ]);
    }

    public function test_rentalList_id()
    {
        $response = $this->get('/api/rentalList/1');
        $response->assertStatus(200);
    }

    public function test_post_item_bad_category()
    {
        $response = $this->postJson('/api/items', [
                    'title'=> 'MsE',
                    'description'=> 'what is MsE',
                    'category_id'=> 30,
                    'period_id'=> 4,
        ]);
        $response->assertStatus(500);
        // $response->assertExactJson([
        //     'message' => 'no created',
        // ]);
    }

    public function test_post_item_bad_period()
    {
        $response = $this->postJson('/api/items', [
                    'title'=> 'MsE',
                    'description'=> 'what is MsE',
                    'category_id'=> 1,
                    'period_id'=> 30,
        ]);

        $response->assertStatus(500);
        // $response->assertExactJson([
        //     'message' => 'no created',
        // ]);
    }

    public function test_post_item_bad_title()
    {
        $response = $this->postJson('/api/items', [
                    'title'=> 1,
                    'description'=> 'what is MsE',
                    'category_id'=> 1,
                    'period_id'=> 4,
        ]);
        $response->assertStatus(200);
        // $response->assertExactJson([
        //     'message' => 'no created',
        // ]);
    }

    public function test_post_item_bad_description()
    {
        $response = $this->postJson('/api/items', [
                    'title'=> "MsE",
                    'description'=> 1234,
                    'category_id'=> 1,
                    'period_id'=> 4,
        ]);
        $response->assertStatus(200);
        // $response->assertExactJson([
        //     'message' => 'no created',
        // ]);
    }


    public function test_post_rentalList()
    {
        $response = $this->postJson('/api/rentalList', [
                    'item_id'=> 2,
                    'lending_date'=> '2022/09/07',
                    'member_id'=> 1,
        ]);

        $response->assertStatus(200);
        // $response2 = $this->get('/api/rentalList');
        // $response2 -> dump()[1];
        // $response->assertEquals($response2[$response2.length-1], 1);
        // $response->assertExactJson([
        //     'message' => 'Item status was changed. RentalList was uploaded'
        // ]);
    }

    public function test_post_rentalList_bad()
    {
        $response = $this->postJson('/api/rentalList', [
                    'item_id'=> 2,
                    'lending_date'=> '2022/09/07',
                    'member_id'=> 1,
        ]);

        $response->assertStatus(200);
        $response->assertExactJson([
            'message' => 'This is already lent',
        ]);
    }

    public function test_post_rental_back()
    {
        $response = $this->putJson('backItem/2', [
                    'back_date'=> '2022/09/08',
                    "status"=> false
        ]);
        $response->assertStatus(404);
        // $response->assertExactJson([
        //     'message' => 'Item status was changed. RentalList was uploaded',
        // ]);
    }

}
