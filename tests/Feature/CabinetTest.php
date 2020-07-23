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
}
