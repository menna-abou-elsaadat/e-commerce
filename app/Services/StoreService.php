<?php

namespace App\Services;

use App\Models\Store;
use App\Models\Product;
use App\Models\StoreProduct;

class StoreService
{
	public static function create($name,$merchant_id,$shipping_cost)
	{
		$new_store = new Store();
		$new_store->name = $name;
		$new_store->user_id = $merchant_id;
		$new_store->shipping_cost = $shipping_cost;
		$new_store->save();

		return $new_store;
	}

	public static function addProductToStore($arabic_name,$english_name,$arabic_description,$english_description,$store_id,$product_price,$product_quantity,$vat_calculation_method,$vat_calculation_value)
	{
		$product = self::addProduct($arabic_name,$english_name,$arabic_description,$english_description);
		$store_product = self::addStoreProduct($store_id,$product->id,$product_price,$product_quantity,$vat_calculation_method,$vat_calculation_value);

		return $store_product;
	}

	public static function addProduct($arabic_name,$english_name,$arabic_description,$english_description)
	{
		$new_product = new Product();
		$new_product->arabic_name = $arabic_name;
		$new_product->english_name = $english_name;
		$new_product->arabic_description = $arabic_description;
		$new_product->english_description = $english_description;
		$new_product->save();

		return $new_product;
	}

	public static function addStoreProduct($store_id,$product_id,$product_price,$product_quantity,$vat_calculation_method,$vat_calculation_value)
	{
		$store_product = new StoreProduct();
		$store_product->store_id = $store_id;
		$store_product->product_id = $product_id;
		$store_product->product_price = $product_price;
		$store_product->product_quantity = $product_quantity;
		$store_product->vat_calculation_method = $vat_calculation_method;
		$store_product->vat_calculation_value = $vat_calculation_value;
		$store_product->save();

		return $store_product;
	}

	public static function editStoreProduct($data)
	{
		$store_product = storeProduct::where('store_id',$data['store_id'])->where('product_id',$data['product_id'])->first();

        if (isset($data['price'])) {
            $store_product->product_price = $data['price'];
        }
        if (isset($data['quantity'])) {
            $store_product->quantity = $data['quantity'];
        }
        if (isset($data['vat_calculation_method'])) {
            $store_product->vat_calculation_method = $data['vat_calculation_method'];
        }
        if (isset($data['vat_calculation_value'])) {
            $store_product->vat_calculation_value = $data['vat_calculation_value'];
        }

        $store_product->save();
        return $store_product;
	}
}
?>