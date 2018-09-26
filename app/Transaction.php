<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

    public $timestamps = false;

    protected $fillable = ['sum', 'trans_from', 'trans_to', 'trans_date', 'status'];

}