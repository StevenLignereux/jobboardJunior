<?php

namespace App\Http\Managers;

require '../vendor/autoload.php';

use App\Models\Job;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use \Mailjet\Resources;

class RecruiterManager
{
    /**
     * Create and send email with update link to recruiter
     *
     * @return void
     */
    public static function sendUpdateLink($job)
    {

        $tpl = "<h3>Merci d'avoir posté un job sur developpeurwebjunior.fr</h3>";
        $tpl .= "<p>Si vous souhaitez modifier votre annonce, il vous suffit de vous rendre sur <a href='https://developpeurwebjunior.fr/edit-job/" . $job->token . "'>https://developpeurwebjunior.fr/edit-job/" . $job->token . "</a></p>";

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => config('mailjet.mail'),
                        'Name' => $job->company_email
                    ],
                    'To' => [
                        [
                            'Email' => $job->company_email,
                            'Name' => config('site.name')
                        ]
                    ],
                    'Subject' => "Lien pour modification de votre annonce",
                    'HTMLPart' => $tpl
                ]
            ]
        ];

        try {
            // use mailjet to send email to recruiters with adress for future modifications of the job
            $mj = new \Mailjet\Client(config('mailjet.key'), config('mailjet.secret'), true, ['version' => 'v3.1']);
            $response = $mj->post(Resources::$Email, ['body' => $body]);

            if (!$response->success()) {
                Log::info("Email not sent " . $job->id  . json_encode($response->getBody()));
            }
        } catch (\Exception $e) {
            Log::error(json_encode($e->getMessage()));
            return redirect(route('home.get.index'))->with('error', 'Une erreur s\'est produite, veuillez me contacter à cette adresse : ' . config('site.contact'));
        }
    }

    /**
     * 
     * Calcul price with options
     * 
     * @param array|mixin $data
     * @return int $price
     * @param Job $job
     */
    public static function getPrice($data, Job $job)
    {
        //On initialise le prix du job sans option
        $price = config('site.prices.price');

        //Manage is highlight
        if (!empty($data['is_highlight']) && $data['is_highlight'] == 'on') {
            $job->is_highlight = true;
            $price += config('site.prices.highlight');
        }

        //Manage end_week_at
        if (!empty($data['end_week_at']) && $data['end_week_at'] == 'on') {
            $job->end_week_at = Carbon::now()->addWeek()->format('Y-m-d');
            $price += config('site.prices.week');
        }

        //Manage end_week_month
        if (!empty($data['end_month_at']) && $data['end_month_at'] == 'on') {
            $job->end_month_at =  Carbon::now()->addMonth()->format('Y-m-d');
            $price += config('site.prices.month');
        }

        //On set le prix final du job
        $price = $price + $price * 0.2;

        return $price;
    }
}
