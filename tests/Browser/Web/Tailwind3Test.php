<?php

namespace Tests\Browser\Web;

use Laravel\Dusk\Browser;
use Tests\Browser\DuskTestCase;

class Tailwind3Test extends DuskTestCase
{
    /**
     * All Filters Load
     */
    public function testFilterMenuOpensAll(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tailwind3');
            $browser->assertSee('Tailwind 3 Implementation');
            $browser->assertDontSee('Tailwind 2 Implementation');
            $browser->assertDontSee('Bootstrap 4 Implementation');
            $browser->assertDontSee('Bootstrap 5 Implementation');

        });
    }
}
