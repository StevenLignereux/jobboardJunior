<?php

namespace Tests\Browser;

use App\Models\Job;
use Exception;
use Illuminate\Support\Facades\Log;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LinkJobTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        Log::info('start srapping url');
        $jobs = Job::where('status', 'valid')->whereNotNull('partner_id')->limit(1);
        foreach ($jobs->get() as $job) {
            $this->browse(function (Browser $browser) use ($job) {
                $ok = "https://neuvoo.fr/job.php?id=02163d512586&oapply=org_v2020-07&source=developpeurwebjunior_bulk&utm_source=partner&utm_medium=developpeurwebjunior_bulk&puid=gddg3deegddf3deagddd3aec3deb3defbdaedd9b4da8fdaaaea33deb3ee3ecdbgbdb8bdeced3fddfdddbbdd7";
                $ko = "https://neuvoo.fr/job.php?id=da01d1b2c9bb&oapply=org_v2020-06&source=developpeurwebjunior_bulk&utm_source=partner&utm_medium=developpeurwebjunior_bulk&puid=gadc3aefgddg3defgadc3def3aee3deebaaddd974aaefaaeaea33deb3ee3dcdbgbdbcbdeaed3dddfaddbedd7";
                $browser->visit($ko)
                    ->pause(5000);

                try {
                    $browser->assertTitle("test");
                } catch (Exception $e) {
                    dd($e->getMessage());
                    $job->status = "dead";
                    Log::info('job dead : id hahahaha ' . $job->id);
                    $job->save();
                }
            });
        }

        Log::info('end srapping url');
    }
}
