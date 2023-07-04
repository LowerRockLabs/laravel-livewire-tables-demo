<?php

namespace Tests\Browser\Web;

use Laravel\Dusk\Browser;
use Tests\Browser\DuskTestCase;

class Bootstrap5Test extends DuskTestCase
{
    /**
     * All Filters Load
     */
    public function testCorrectThemeDisplays(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/bootstrap-5');
            $browser->assertSee('Bootstrap 5 Implementation');
            $browser->assertDontSee('Tailwind 2 Implementation');
            $browser->assertDontSee('Tailwind 3 Implementation');
            $browser->assertDontSee('Bootstrap 4 Implementation');
        });
    }

    /**
     * Slide Down Doesn't Show Initially
     */
    public function testSlideDownFiltersNotVisibleInitially(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/bootstrap-5-slidedown');
            $browser->assertSee('Bootstrap 5 Implementation');
            $browser->screenshot('BS5-Before-Click');
            $browser->assertDontSee('Verified To');
            $browser->click('div.d-flex.flex-column > div.d-md-flex.justify-content-between.mb-3 > div:nth-child(1) > div.ms-0.ms-md-2.mb-3.mb-md-0 > div > div > button')->pause(1000);
            $browser->screenshot('BS5-After-Click');
            $browser->assertSee('Verified To');

        });
    }
}
