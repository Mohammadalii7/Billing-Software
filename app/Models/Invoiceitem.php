<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoiceitem extends Model
{
    use HasFactory;
    
    protected $fillable = ['item_name', 'description','quantity','price','totalprice','invoice_id'];

    public $timestamps = false;
}
