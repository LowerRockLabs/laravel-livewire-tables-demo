<?php

namespace Tests\Browser\Web;

use Laravel\Dusk\Browser;
use Tests\Browser\DuskTestCase;

class Tailwind3Test extends DuskTestCase
{
    /**
     * All Filters Load
     */
    public function testCorrectThemeDisplays(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tailwind3');
            $browser->assertSee('Tailwind 3 Implementation');
            $browser->assertDontSee('Tailwind 2 Implementation');
            $browser->assertDontSee('Bootstrap 4 Implementation');
            $browser->assertDontSee('Bootstrap 5 Implementation');

        });
    }

    /**
     * Slide Down Doesn't Show Initially
     */
    public function testSlideDownFiltersNotVisibleInitially(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tailwind3-slidedown');
            $browser->assertSee('Tailwind 3 Implementation');
            $browser->screenshot('TW3-Before-Click');
            $browser->assertDontSee('Verified To');
            $browser->click('div.flex-col > div.md\:flex.md\:justify-between.mb-4.px-4.md\:p-0 > div.w-full.mb-4.md\:mb-0.md\:w-2\/4.md\:flex.space-y-4.md\:space-y-0.md\:space-x-2 > div.relative.block.md\:inline-block.text-left > div > button')->pause(1000);
            $browser->screenshot('TW3-After-Click');
            $browser->assertSee('Verified To');

        });
    }

}
