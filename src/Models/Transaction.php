<?php
namespace Fshangala\Cws\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'wallet_id',
        'currency',
        'debit',
        'credit',
        'reference',
        'status'
    ];
}