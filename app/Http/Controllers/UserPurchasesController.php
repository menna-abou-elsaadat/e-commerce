<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserPurchaseService;

class UserPurchasesController extends Controller
{
    public function createUserPurchase(Request $request)
    {
        $data = $request->input();
        $purchased_products = $data['purchased_products'];
        eval("\$purchased_products = $purchased_products;");
        $user_purchase = UserPurchaseService::createNewUserPurchase($data['user_id'],$data['store_id'],$purchased_products);

        return $user_purchase->total;
    }
}
