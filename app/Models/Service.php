<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::whereHas('customer', function ($q) use ($query) {
                $q->where('nama', 'like','%'.$query.'%')
                ->orWhere('nopol', 'like','%'.$query.'%');
            });
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
