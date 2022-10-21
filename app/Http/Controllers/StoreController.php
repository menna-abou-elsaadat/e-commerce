<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\StoreProduct;
use App\Http\Resources\StoreResource;
use App\Http\Resources\StoreProductsResource;
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

    public function addProductToStore(Request $request)
    {
        $data = $request->input();
        $store_product = StoreService::addProductToStore($data['arabic_name'],$data['english_name'],$data['arabic_description'],$data['english_description'],$data['store_id'],$data['product_price'],$data['product_quantity'],$data['vat_calculation_method'],$data['vat_calculation_value']);

         return StoreProductsResource::collection(StoreProduct::where('store_id',$data['store_id'])->get());
    }

    public function showStoreProducts($store_id)
    {
        dd('ssss');
        dd(StoreProduct::where('store_id',$store_id)->get());
        return StoreProductsResource::collection(StoreProduct::where('store_id',$store_id)->get());
    }

    public function showStoreProduct(Request $request)
    {
        $data = $request->input();
        return new StoreProductsResource(StoreProduct::where('store_id',$data['store_id'])->where('product_id',$data['product_id'])->first());

    }

    public function editStoreProduct(Request $request)
    {
        $data = $request->input();
        $store_product = StoreService::editStoreProduct($data);
        return new StoreProductsResource(StoreProduct::find($store_product->id));
    }
}
