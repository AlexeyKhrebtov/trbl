<?php

namespace Tests\Feature;

use App\Cabinet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CabinetTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function guest_cant_view_cabinets_list()
    {
        $response = $this->get(route('cabinets.index'));
        $response->assertStatus(302);
    }

    /**
     * @test
     */
    public function auth_user_can_read_all_cabinets()
    {
        $this->actingAs(factory('App\User')->create());
        $cabinet = factory(Cabinet::class)->create();

        $response = $this->get(route('cabinets.index'));

        $response->assertSee($cabinet->title);
    }
}
