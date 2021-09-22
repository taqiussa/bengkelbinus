<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('category', 'like', '%'.$query.'%');
    }
}
