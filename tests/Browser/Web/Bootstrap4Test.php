<?php

namespace Tests\Browser\Web;

use Laravel\Dusk\Browser;
use Tests\Browser\DuskTestCase;

class Bootstrap4Test extends DuskTestCase
{
    /**
     * All Filters Load
     */
    public function testCorrectThemeDisplays(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/bootstrap-4');
            $browser->assertSee('Bootstrap 4 Implementation');
            $browser->assertDontSee('Tailwind 2 Implementation');
            $browser->assertDontSee('Tailwind 3 Implementation');
            $browser->assertDontSee('Bootstrap 5 Implementation');
            
        });
    }
}
