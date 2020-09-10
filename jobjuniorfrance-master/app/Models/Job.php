<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $company_name
 * @property string $company_email
 * @property string $job_description
 * @property string $how_to_apply
 * @property string $invoice_address
 * @property string $receipt_url
 * @property bool $payment_success
 * @property string $payment_message
 * @property string $additional_note
 * @property string $link
 * @property string $slug
 * @property int $type
 * @property string $city
 * @property bool $is_highlight
 * @property date $end_week_at
 * @property date $end_month_at
 * @property int $price
 * @property string $token
 * @property date $created_at
 * @property date $updated_at
 * @property int $views
 * @property bool $sent_by_newsletter
 * @property string $partner_id
 * @property string $partner_name
 * @property string $cpc
 * @property string $currency
 * @property string $status
 * @property DateTime $posted_date
 * @property DateTime $validate_at
 */
class Job extends Model
{

    protected $fillable =
    [
        'id',
        'title',
        'company_name',
        'company_email',
        'job_description',
        'how_to_apply',
        'invoice_address',
        'receipt_url',
        'payment_success',
        'payment_message',
        'additional_note',
        'link',
        'slug',
        'type',
        'city',
        'is_highlight',
        'end_week_at',
        'end_month_at',
        'price',
        'token',
        'created_at',
        'updated_at',
        'views',
        'sent_by_newsletter',
        'partner_id',
        'partner_name',
        'cpc',
        'currency',
        'status',
        'posted_date',
        'validate_at'
    ];

    protected $hidden = [
        'invoice_address',
        'receipt_url',
        'payment_success',
        'payment_message',
        'price',
        'token',
        'views',
        'sent_by_newsletter',
        'partner_id',
        'partner_name',
        'cpc',
        'currency',
        'status',
        'views',
        'company_email',
        'additional_note',
        'is_highlight',
        'end_week_at',
        'end_month_at',
    ];

    /**
     * The tags associated with the job.
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    /**
     * Check if title or descriptions contains at least one work : junior
     * @param string $title
     * @param string $description
     * 
     * @return bool
     */
    public function hasJunior($title, $description): bool
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
