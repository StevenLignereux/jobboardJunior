<?php

namespace App\Http\Managers;

use App\Models\Job;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PaymentManager
{

    /**
     * 
     * Make a Stripe Payment
     * 
     * @param array|mixin $data 
     * @param Job $job
     * 
     * @return array $response
     */
    public static function makePayment($data, Job $job)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $stripeToken = $data['stripeToken'];
        $description = "Facture : Mise en ligne sur d'un emploi " . config('site.name');
        $description .= " - " . $job->title . " le " . Carbon::now()->format('Y-m-d');
        $description .= " par" . $job->companny_email;

        try {
            $charge =  \Stripe\Charge::create([
                "amount" => $job->price,
                "currency" => "eur",
                "source" => $stripeToken,
                "description" => $description
            ]);

            $response['success'] = true;
            $response['charge'] = $charge;
            $response['message'] = "";
        } catch (\Exception $e) {
            $response['success'] = false;
            $response['charge'] = "";
            $response['message'] = json_encode($e->getMessage());

            Log::error('MakePayment : ' . json_encode($e->getMessage()));
        }

        return $response;
    }
}
