<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Managers\SocialManager;
use App\Models\Job;
use Illuminate\Http\Request;
use App\SearchProperty;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\ResponseMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $filter = $request->all();
        $filter['status'] = $filter['status'] ?? config('status.waiting');
        $filter['text'] = $filter['text'] ?? '';
        $filter['city'] = $filter['city'] ?? '';
        $filter['cpc'] = $filter['cpc'] ?? '';
        $filter['not_send'] = $filter['not_send'] ?? '';
        $jobs = Job::where('status', $filter['status'])->whereNotNull('partner_name')
            ->where(function ($q) use ($filter) {
                $q->where('title', 'LIKE', '%' . $filter['text'] . '%');
                $q->orWhere('id', 'LIKE', '%' . $filter['text'] . '%');
                $q->orWhere('job_description', 'LIKE', '%' . $filter['text'] . '%');
                $q->orWhere('company_name', 'LIKE', '%' . $filter['text'] . '%');
            })
            ->where('city', 'LIKE', '%' . $filter['city'] . '%');
        if (!empty($filter['cpc']) && $filter['cpc'] == 'on') {
            $jobs->orderBy('cpc', 'desc');
        } else {
            $jobs->orderBy('posted_date', 'desc');
        }
        if (!empty($filter['not_send']) && $filter['not_send'] == 'on') {
            $jobs->where('sent_by_newsletter', false);
        }

        $count = $jobs->count();
        $jobs = $jobs->paginate(100);
        return view('auth.dashboard.index', compact('jobs', 'filter', 'count'));
    }


    public function manageJob(Request $request)
    {
        $data = $request->all();
        $partnerId = $data['partner_id'];
        $partnerName = $data['partner_name'];
        $status = $data['status'];

        $job = Job::where('partner_id', $partnerId)->where('partner_name', $partnerName)->first();

        if (empty($job)) {
            return new JsonResponse(400, "Job not found");
        }
        $job->status = $status;
        $job->slug = getShortUrl($job);
        $job->save();

        if ($job->status == config('status.valid')) {
            $job->validate_at = Carbon::now();
            $job->save();
            SocialManager::socialRequest($job);
        }
        return new JsonResponse();
    }


    public function updateType(Request $request)
    {
        $data = $request->all();
        $partnerId = $data['partner_id'];
        $partnerName = $data['partner_name'];
        $type = $data['type'];

        $job = Job::where('partner_id', $partnerId)->where('partner_name', $partnerName)->first();

        if (empty($job)) {
            return new JsonResponse(400, "Job not found");
        }
        $job->type = $type;
        $job->save();

        return new JsonResponse();
    }
}
