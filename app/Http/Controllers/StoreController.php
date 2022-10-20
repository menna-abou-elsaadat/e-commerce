<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Http\Resources\StoreResource;
use App\Services\StoreService;

class StoreController extends Controller
{
    public function index($merchant_id)
    {
        return new StoreResource(Store::where('user_id',$merchant_id)->get());
    }

    public function create(Request $request)
    {
        $data = $request->input();
        $store  = StoreService::create($data['name'],$data['merchant_id'],$data['shipping_cost']);
        return new StoreResource(Store::find($store->id));
    }
}
