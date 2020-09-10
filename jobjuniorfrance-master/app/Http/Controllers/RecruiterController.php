<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Job;
use App\Models\Junior;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Http\Managers\RecruiterManager;
use App\Http\Managers\PaymentManager;
use App\Http\Managers\SocialManager;
use Carbon\Carbon;

class RecruiterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index($adminToken = null)
    {
        //SET FREE
        $adminToken = "9efb8052-61b6-4c6e-bff1-c3eb22ea4677";
        //END SET FREE
        $contracts = config('contracts');
        $jCount = Junior::all()->count();
        $tags = Tag::all();
        return view('recruiter.index', compact('contracts', 'jCount', 'adminToken', 'tags'));
    }

    public function postJob(Request $request)
    {
        $data = $request->all();

        // if tags are missing, redirect back
        if (is_null($data['tags'])) {
            $message = config('messages.error.missing.tag') .  config('site.contact');
            return redirect()->back()->withInput()->with('error', $message);
        }

        // If has a token
        $tokenRequest = "";
        if (!empty($data['admin_token'])) {
            $tokenRequest = $data['admin_token'];
        }

        //On créé le job
        $job = new Job();
        $job->title = $data['title'];
        $job->job_description = $data['job_description'] ?? null;
        $job->how_to_apply = $data['how_to_apply'] ?? null;
        $job->link = $data['link'] ?? null;
        $job->type = $data['type'];
        $job->city = $data['city'];
        $job->company_name = $data['company_name'];
        $job->company_email = $data['company_email'] ?? "";
        $job->token = Uuid::uuid4();
        $job->validate_at = Carbon::now();

        $job->status = config('status.valid');

        //On regarde s'il y a des options payantes.
        $job->price = RecruiterManager::getPrice($data, $job);

        //Si l'admin post un job
        if ($tokenRequest == config('site.admin_token')) {
            $job->price = 0;
            $job->save();
            if (!empty($job->link)) {
                $job->slug = getShortUrl($job);
                $job->save();
            }

            $this->updateJobTags($data, $job);
            RecruiterManager::sendUpdateLink($job);
            SocialManager::socialRequest($job);

            return redirect(route('home.get.index'))->with('success', config('messages.success.postJob.admin'));
        }

        //If not admin that posting job
        //Call stripe
        $responsePayment = PaymentManager::makePayment($data, $job);

        //If error during stripePayment
        if (empty($responsePayment['charge']) || $responsePayment['charge']->status != "succeeded") {
            return redirect(route('home.get.index'))->with('error', 'Une erreur est sruvenue durant le paiement, veuillez me contacter à cette adresse  : ' . config('site.contact'));
        }

        //If payment is ok
        $job->payment_success = $responsePayment['success'];
        $job->payment_message =  json_encode(!empty($responsePayment['message']) ? $responsePayment['message'] : 'No Message');
        $job->receipt_url = $responsePayment['charge']->receipt_url;
        $job->invoice_address = $data['invoice_address'];
        $job->save();

        $this->updateJobTags($data, $job);


        //If all is ok , send email to society to edit post.
        RecruiterManager::sendUpdateLink($job);
        SocialManager::socialRequest($job);
        return redirect(route('home.get.index'))->with('success', config('messages.success.postJob.recruiter'));
    }

    public function showJob(Request $request, $token)
    {
        $contracts = config('contracts');
        $jCount = Junior::all()->count();
        $job = Job::where('token', $token)->first();
        $tags = Tag::all();


        return view('recruiter.edit', compact('job', 'contracts', 'jCount', 'tags'));
    }

    public function updateJob(Request $request, $token)
    {

        $currentJob = Job::where('token', $token)->first();
        $data = $request->all();
        if (is_null($data['tags'])) {
            $message = config('messages.error.missing.tag') .  config('site.contact');
            return redirect()->back()->withInput()->with('error', $message);
        }
        $currentJob->title = $data['title'];
        $currentJob->type = $data['contract'];
        $currentJob->company_name = $data['company_name'];
        $currentJob->city = $data['city'];
        $currentJob->job_description = $data['job_description'];
        $currentJob->how_to_apply = $data['how_to_apply'];
        $currentJob->company_email = $data['company_email'];
        $currentJob->link = $data['link'];
        $currentJob->slug = getShortUrl($currentJob);

        $currentJob->tags()->detach();
        $currentJob->save();
        $this->updateJobTags($data, $currentJob);
        return redirect(route('home.get.index'))->with('success', 'Votre annonce est bien été mise à jour');
        // }

        // return redirect(route('home.get.index'))->with('danger', 'Une erreur s\'est produite, veuillez contacter Nicolas :)');
    }

    /**
     *
     * Process update tags
     * @param array $data
     * @param Job $ job
     *
     */
    private function updateJobTags($data, Job $job)
    {
        $tags = $data['tags'];
        $tags = explode(',', $tags);
        $job->tags()->attach($tags);
        $job->save();
    }

    /**
     * Init creation of a Job
     *
     * @param array $data
     * @return Job $job
     */
    private function createJob($data)
    {
        $job = new Job();
        $job->title = $data['title'];
        $job->job_description = $data['job_description'] ?? null;
        $job->how_to_apply = $data['how_to_apply'] ?? null;
        $job->link = $data['link'] ?? null;
        $job->type = $data['type'];
        $job->city = $data['city'];
        $job->company_name = $data['company_name'];
        $job->company_email = $data['company_email'] ?? "";
        $job->token = Uuid::uuid4();

        return $job;
    }
}
