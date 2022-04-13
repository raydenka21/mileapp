<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Connote extends Model
{
    protected $connection = 'mongodb';
    use SoftDeletes;
    protected $collection = 'connote';
    protected $fillable = ['connote_id'];
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
