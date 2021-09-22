<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Item;
use App\Models\Service;
use App\Models\Customer;
class BengkelController extends Controller
{
    public function customer()
    {
        return view('pages.bengkel.customer-data', [
            'customer' => Customer::class
        ]);
    }
    public function category()
    {
        return view('pages.bengkel.category-data', [
            'category' => Category::class
        ]);
    }
    public function item()
    {
        return view('pages.bengkel.item-data', [
            'item' => Item::class
        ]);
    }
    public function serviceregistration()
    {
        return view('pages.bengkel.serviceregistration-data', [
            'service' => Service::class
        ]);
    }
    public function serviceprocess()
    {
        return view('pages.bengkel.serviceprocess-data', [
            'service' => Service::class
        ]);
    }
    public function servicedone()
    {
        return view('pages.bengkel.servicedone-data', [
            'service' => Service::class
        ]);
    }
    public function servicepaid()
    {
        return view('pages.bengkel.servicepaid-data', [
            'service' => Service::class
        ]);
    }
}
