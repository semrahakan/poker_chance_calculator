<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnalyseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $test_word = ['char' => 'laravel'];
        $response_first = $this->call( 'ANY', '/phrase_analyser',$test_word);
        $response_after = $this->get('/phrase_analyser');
       
        $this->assertTrue(true);
    }
}
