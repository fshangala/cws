<?php
namespace Fshangala\Cws\Models;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'status'
    ];
}