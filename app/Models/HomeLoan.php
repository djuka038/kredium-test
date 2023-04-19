<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeLoan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'home_loan_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'adviser_id',
        'property_value',
        'down_payment_amount'
    ];

    public $timestamps = true;
}
