<?php

namespace App\Services;

use App\Models\UserPurchase;
use App\Models\UserPurchaseDetail;
use App\Models\StoreProduct;
use App\Models\Store;

class UserPurchaseService
{
	public static function createNewUserPurchase($user_id,$store_id,$purchased_products)
	{
		$store = Store::find($store_id);
		$user_purchase = new UserPurchase();
		$user_purchase->user_id = $user_id;
		$user_purchase->store_id = $store_id;
		$user_purchase->shipping_cost = $store->shipping_cost;
		$user_purchase->save();
		$total = 0;
		foreach ($purchased_products as $key => $purchased_product) {

			$user_purchase_product = self::createUserPurchaseProduct($purchased_product['product_id'],$purchased_product['quantity'],$user_purchase->id,$store_id);
			if ($user_purchase_product) {
				$total += ($user_purchase_product->price + $user_purchase_product->vat)*$user_purchase_product->quantity;
			}
			
		}

		$user_purchase->total = $total + $store->shipping_cost;
		$user_purchase->save();

		return $user_purchase;

	}

	public static function createUserPurchaseProduct($product_id,$quantity,$user_purchase_id,$store_id)
	{
		$store_product = StoreProduct::where('store_id',$store_id)->where('product_id',$product_id)->where('product_quantity','>=',$quantity)->first();
		if ($store_product) {
			
			$user_purchase_product = new UserPurchaseDetail();
			$user_purchase_product->user_purchase_id = $user_purchase_id;
			$user_purchase_product->product_id = $product_id;
			$user_purchase_product->price = $store_product->product_price;
			$user_purchase_product->quantity = $quantity;
			$user_purchase_product->vat = $store_product->calculateVAT();
			$user_purchase_product->save();

			$store_product->product_quantity = $store_product->product_quantity - $quantity;
			$store_product->sold = $store_product->sold + $quantity;
			
			return $user_purchase_product;
		}

		return false;
	}

}
?>