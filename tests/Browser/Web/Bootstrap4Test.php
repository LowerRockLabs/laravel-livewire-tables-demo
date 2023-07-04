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

    /**
     * Slide Down Doesn't Show Initially
     */
    public function testSlideDownFiltersNotVisibleInitially(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/bootstrap-4-slidedown');
            $browser->assertSee('Bootstrap 4 Implementation');
            $browser->screenshot('BS4-Before-Click');
            $browser->assertDontSee('Verified To');
            $browser->click('div.d-flex.flex-column > div.d-md-flex.justify-content-between.mb-3 > div:nth-child(1) > div.ml-0.ml-md-2.mb-3.mb-md-0 > div > div > button')->pause(1000);
            $browser->screenshot('BS4-After-Click');
            $browser->assertSee('Verified To');

        });
    }
}
