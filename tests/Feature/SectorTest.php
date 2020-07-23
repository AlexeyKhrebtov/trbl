<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class SectorTest
 * Тесты для Опорных пунктов
 * @package Tests\Feature
 */
class SectorTest extends TestCase
{
    /**
     * @test
     */
    public function guest_cant_view_sectors_list()
    {
        $response = $this->get(route('sectors.index'));
        $response->assertStatus(302);
    }

}
