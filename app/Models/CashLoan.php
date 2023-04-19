<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashLoan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cash_loan_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'adviser_id',
        'loan_amount',
    ];

    public $timestamps = true;
}
