<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use App\Models\Job;
use App\Models\Tag;
use Exception;
use Ramsey\Uuid\Uuid;
use SimpleXMLElement;
use GuzzleHttp\Client;

class FetchNeuvoo extends Command
{

    private $flux;
    private $fluxName;
    private $client;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:neuvoo {flux}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from Neuvoo.co';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->fluxName = "bulk";
        $this->client = new Client([
            'timeout'  => 120.0,
        ]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->fluxName = $this->argument('flux');
        switch ($this->fluxName) {
            case 'premium':
                $this->flux = config('partner.neuvoo.premium');
                break;
            case 'bulk':
                $this->flux = config('partner.neuvoo.bulk');
                break;
            default:
                $this->flux = config('partner.neuvoo.premium');
                break;
        }

        ini_set('memory_limit', '1024M');
        $countSaved = 0;
        $countUpdated = 0;
        try {
            $this->info('Fetching ' . $this->fluxName);
            $response = $this->client->get($this->flux);
            $xml_str = $response->getBody()->getContents();
            $jobs = simplexml_load_string(
                //"C:\Users\Nicolas\Desktop\sample.xml",
                $xml_str,
                "SimpleXMLElement",
                LIBXML_NOCDATA
            );
            $this->info('End fetch ' . $this->fluxName);

            $bar = $this->output->createProgressBar(count($jobs));
            $bar->start();

            $tags = Tag::all();
            foreach ($jobs as $el) {
                $jobExist = Job::where('partner_name', 'neuvoo_' . $this->fluxName)->where(function ($q) use ($el) {
                    $q->where('partner_id', (string) $el->jobid);
                    $q->orWhere('partner_id', (string) $el->{"job-code"});
                })->first();
                if (!empty($jobExist)) {
                    $jobExist->link = (string) $el->url;
                    $countUpdated++;
                    $jobExist->save();
                }
                if (!empty($jobExist) && empty($jobExist->cpc) && !empty($el)) {
                    $countUpdated++;
                    if (!empty((string) $el->cpc)) {
                        $cpc = (string) $el->cpc;
                    }
                    if (!empty((string) $el->ppc)) {
                        $cpc = (string) $el->ppc;
                    }
                    $jobExist->cpc = $cpc;
                    $jobExist->save();
                }

                if (empty($jobExist) && $this->hasJunior((string) $el->title, (string) $el->description)) {
                    $job = new Job();
                    $job->title = (string) $el->title;
                    $job->job_description = (string) $el->description;
                    $job->link = (string) $el->url;
                    $job->type =  getJobType((string) $el->jobtype);
                    $job->city = (string) $el->state . ' ' . (string) $el->city;
                    $job->company_name = (string) $el->company;
                    $job->company_email = "nicolas@developpeurjunior.fr";
                    $job->token = Uuid::uuid4();
                    $cpc = 0;
                    if (!empty((string) $el->cpc)) {
                        $cpc = (string) $el->cpc;
                    }
                    if (!empty((string) $el->ppc)) {
                        $cpc = (string) $el->ppc;
                    }
                    $job->cpc = $cpc;
                    $postedDate = "";
                    if (!empty((string) $el->{"posted-date"})) {
                        $postedDate = (string) $el->{"posted-date"};
                    }
                    if (!empty((string) $el->date)) {
                        $postedDate = (string) $el->date;
                    }
                    $job->posted_date = $postedDate;
                    $job->partner_name = "neuvoo_" . $this->fluxName;
                    $partnerId = "1337";
                    if (!empty((string) $el->jobid)) {
                        $partnerId = (string) $el->jobid;
                    }

                    if (!empty((string) $el->{"job-code"})) {
                        $partnerId = (string) $el->{"job-code"};
                    }
                    $job->partner_id =  $partnerId;

                    $job->currency = (string) $el->currency;
                    $job->status = config('status.waiting');

                    $job->save();
                    $countSaved++;
                    foreach ($tags as  $tag) {
                        $tagName = strtoupper($tag->name);
                        if (strpos(strtoupper($job->job_description), $tagName) !== false && $tagName !== "C") {
                            $job->tags()->attach($tag);
                            $job->save();
                        }
                    }
                }
                $bar->advance();
            }
            $bar->finish();

            $info = $countSaved . ": Offres indéxées depuis Neuvo " . $this->fluxName;
            $infoUpdated = $countUpdated . ": Offres updated depuis Neuvo " . $this->fluxName;
            $this->info($info);
            Log::info($info);

            $this->info($infoUpdated);
            Log::info($infoUpdated);
        } catch (Exception $e) {
            $this->info('Erroe happened, see logs : ' . $e->getMessage());
            Log::error("Error: " .  json_encode($e->getMessage()));
        }
    }

    /**
     * Check if title or descriptions contains at least one work : junior
     * @param string $title
     * @param string $description
     * 
     * @return bool
     */
    private function hasJunior($title, $description): bool
    {
        $junior = strtolower('junior');
        $description = strtolower($description);
        $title = strtolower($title);

        $titleNotAllowed = config('keywords.title');
        $descriptionNotAllowed = config('keywords.description');

        return
            //keyword not allowed in title
            !$this->contains($title, $titleNotAllowed)
            &&
            !$this->contains($description, $descriptionNotAllowed)

            //need to have
            && ($this->contains($title, [$junior]) || $this->contains($description, [$junior]));
    }



    private function contains($str, array $arr)
    {
        foreach ($arr as $a) {
            $a = strtolower($a);
            if (stripos($str, $a) !== false) return true;
        }
        return false;
    }
}
