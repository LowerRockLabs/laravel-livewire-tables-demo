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

    /**
     * @group sorting
     */
    public function testSortViaClick(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/bootstrap-5');
            $browser->assertSee('Jayde Feil');
            
            $browser->click('div > div.table-responsive > table > thead > tr > th:nth-child(4) > div')->pause(1000);
            $browser->assertSee("Aditya D'Amore");

            $browser->click('div > div.table-responsive > table > thead > tr > th:nth-child(4) > div')->pause(1000);
            $browser->assertSee("Zachariah Kreiger");

        });
    }

    /**
     * @group sorting
     */
    public function testSortViaQueryString(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/bootstrap-5');
            $browser->assertSee('Jayde Feil');

            $browser->visit('/bootstrap-5?users2[sorts][name]=asc');
            $browser->assertSee("Aditya D'Amore");

            $browser->visit('/bootstrap-5?users2[sorts][name]=desc');
            $browser->assertSee("Zachariah Kreiger");

        });
    }

    /**
     * @group sorting
     */
    public function testSortingPillsDisplayViaClick(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/bootstrap-5');
            $browser->assertDontSee('Applied Sorting');

            $browser->click('div > div.table-responsive > table > thead > tr > th:nth-child(4) > div')->pause(1000);
            $browser->assertSee('Applied Sorting');
            $browser->assertSee('Name: A-Z');

            $browser->click('div > div.table-responsive > table > thead > tr > th:nth-child(4) > div')->pause(1000);
            $browser->assertSee('Applied Sorting');
            $browser->assertSee('Name: Z-A');
        });
    }

    /**
     * @group sorting
     */
    public function testSortingPillsDisplayViaQueryString(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/bootstrap-5');
            $browser->assertDontSee('Applied Sorting');

            $browser->visit('/bootstrap-5?users2[sorts][name]=asc');
            $browser->assertSee('Applied Sorting');
            $browser->assertSee('Name: A-Z');

            $browser->visit('/bootstrap-5?users2[sorts][name]=desc');
            $browser->assertSee('Applied Sorting');
            $browser->assertSee('Name: Z-A');
        });
    }

}
