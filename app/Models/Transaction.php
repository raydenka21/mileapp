<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    protected $connection = 'mongodb';
    use SoftDeletes;

    protected $collection = 'transaction';
    protected $fillable = [
        "transaction_id",
        "customer_name",
        "customer_code",
        "transaction_amount",
        "transaction_discount",
        "transaction_additional_field",
        "transaction_payment_type",
        "transaction_state",
        "transaction_code",
        "transaction_order",
        "location_id",
        "connote",
        "organization_id",
        "transaction_payment_type_name",
        "transaction_cash_amount",
        "transaction_cash_change",
        "cannote_id",
        "customer_attribute",
        "origin_data",
        "destination_data",
        "koli_data",
        "custom_field",
        "currentLocation",
    ];
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
