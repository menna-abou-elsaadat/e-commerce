<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id');
    }

    public function calculateVAT()
    {

        if ($this->vat_calculation_method == 'percentage') {
                
            return ($this->product_price * $this->vat_calculation_value) / 100;
        }

        if ($this->vat_calculation_method == 'value') {
            
            return $this->vat_calculation_value;
        }

        return 0;
    }
}
