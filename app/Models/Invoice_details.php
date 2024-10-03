<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_details extends Model
{
    use HasFactory;
        protected $guarded = [];


    // public function invoice()
    // {
    //     return $this->belongsTo(invoices::class, 'invoice_id', 'id');
    // }

    public function invoices(){
        $this->belongsTo(invoices::class);
    }
}
