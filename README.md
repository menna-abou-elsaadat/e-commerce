API Endpoints:
---------------
1- create a user with role merchant or user

    URL: /api/user/create (method:post) 

    params: name, email, password, role(user|merchant)

    return: created user object


2- Merchant can create his store 

	URL: /api/store/create (method:post)

	params: name (store name), merchant_id, shipping_cost

	return: create store object


3- Add product to a store

	URL: /api/store/add_product (method:post)

	params: store_id, arabic_name, english_name, arabic_description, english_description, product_price, product_quantity, vat_calculation_method(percentage|value), vat_calculation_value

	NOTE: 
	if (vat_calculation_method == percentage) then 
		vat = (product_price*vat_calculation_value)/100 
	else if (vat_calculation_method == value)
         vat = vat_calculation_value
    else 
    	vat will be included in the price so system will consider vat = 0

    return: created product object


4- show store products

	URL: /api/store/show_store_products/{store_id} (method:get)
	return: 


5- show product details from a store
	
	URL: /api/store/show_store_product (method:post)

	params: store_id, product_id

	return: store product details

6- Add products to a cart

	URL: /api/user_purchase/create_user_purchase (method:post)

	params: store_id, user_id, purchased_products( array of products [[product_id,quantity],[product_id,quantity]])

	return: total