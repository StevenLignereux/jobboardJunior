<?php

namespace App\Http\Controllers;

use App\Models\Tag;


use App\Models\Job;
use App\Models\Junior;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $topJobs = Job::where(function ($q) {
            $q->whereNotNull('end_month_at');
            $q->orWhereNotNull('end_week_at');
            $q->where('status', config('status.valid'));
        })->with('tags')->orderBy('validate_at', 'desc')->get();

        $jobs = Job::where(function ($q) {
            $q->whereNull('end_month_at');
            $q->whereNull('end_week_at');
            $q->where('status', config('status.valid'));
        })->with('tags')->orderBy('validate_at', 'desc')->get();

        $now = Carbon::now();
        $jCount = Junior::all()->count();
        $tags = Tag::all();

        return view('home.index', compact('topJobs', 'jobs', 'now', 'jCount', 'tags'));
    }

    /**
     * Subscribe to the news letter
     * @param Request $request
     */
    public function subscribe(Request $request)
    {
        $data = [
            'email' => $request->get('email'),
            'parrain' => $request->get('parrain') ?? null
        ];

        $rules = [
            'email' => 'unique:juniors,email'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect(route('home.get.index'))->with('error', 'Vous êtes déjà inscrit à notre newsletter !');
        }

        if (!empty($data['email'])) {
            $junior = new Junior();
            $junior->email = $data['email'];
            $junior->parrain = $data['parrain'];
            $junior->save();

            return redirect(route('home.get.index'))->with('success', 'Merci ! Vous recevrez très prochainement un e-mail de notre part :)');
        }
    }

    /**
     * @param Request $request
     * @param string $shortUrl
     */
    public function shortcut(Request $request, string $shortUrl)
    {
        if (empty($shortUrl)) {
            return redirect(route('home.get.index'))->with('error', "Offre d'emploi introuvable");
        }

        $infos = explode("-", $shortUrl);
        $jobId = $infos[0];

        $job = Job::where('id', $jobId)->first();
        if (empty($job) || empty($job->slug)) {
            return redirect(route('home.get.index'))->with('error', "Offre d'emploi introuvable");
        }

        $job->views++;
        $job->save();

        $now = Carbon::now();
        DB::table('jobs_views')->insert(
            ['job_id' => $job->id, 'ip' => FacadesRequest::ip(), 'user_agent' => FacadesRequest::userAgent(), 'created_at' => $now]
        );

        return redirect($job->link);
    }


    public function unsubscribe(Request $request, $token)
    {
        $junior = Junior::where('token', $token)->first();
        if (!empty($junior)) {
            $junior->has_cancelled = 1;
            $junior->save();
            return redirect(route('home.get.index'))->with('success', config('messages.success.unsuscribe'));
        }
        return redirect(route('home.get.index'))->with('error', config('messages.error.unsuscribe'));
    }

    public function email()
    {
        $jobs = Job::where('status', 'valid')->orderBy('city')->get();

        $jobsSorted = [];
        $city = "";
        foreach ($jobs as $job) {
            if ($city != $job->city) {
                $city = $job->city;
                if ($city == "null ") {
                    $city = "N/A";
                }
                $jobsSorted[$city][] = $job;
            }
        }
        $token = Junior::where('email', 'nicolasruiz.perso@gmail.com')->first()->token;
        return view('emails.newsletter', ['jobs'  => $jobsSorted, 'token' => $token]);
    }
}
