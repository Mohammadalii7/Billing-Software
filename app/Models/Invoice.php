<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public $timestamps = false;
    // protected $fillable = ['customer', 'item'];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id'); // Assuming 'invoice_id' is the foreign key
    }
}
