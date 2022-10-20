<?php

namespace App\Services;

use App\Models\Store;

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
}
?>