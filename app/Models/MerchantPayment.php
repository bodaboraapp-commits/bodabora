<?php

namespace App\Models;

use App\Models\Backend\Bank;
use App\Models\Backend\Merchant;
use App\Models\Backend\MobileBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MerchantPayment extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = [

        'merchant_id',
        'payment_method',
        'bank_name',
        'holder_name',
        'account_no',
        'branch_name',
        'routing_no',
        'mobile_company',
        'mobile_no',
        'account_type',

    ];

    public function getActivitylogOptions(): LogOptions
    {

        $logAttributes = [
            'merchant.business_name',
            'payment_method',
            'bank_name',
            'holder_name',
            'account_no',
            'branch_name',
            'routing_no',
            'mobile_company',
            'mobile_no',
            'account_type',
        ];

        return LogOptions::defaults()
        ->useLogName('MerchantPayment')
        ->logOnly($logAttributes)
        ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}");
    }
    // Merchant details
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    // Relationship to Bank
    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_name');
    }

    // Relationship to MobileBank
    public function mobileBank()
    {
        return $this->belongsTo(MobileBank::class, 'mobile_company');
    }

}
