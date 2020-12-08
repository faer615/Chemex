<?php

namespace Tests\Feature;

use App\Support\Info;
use Tests\TestCase;

class InfoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInfoStaffIdToName()
    {
        $result = Info::staffIdToName(1);

    }
}
