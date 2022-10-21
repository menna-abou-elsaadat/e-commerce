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
	return: store products


5- show product details from a store
	
	URL: /api/store/show_store_product (method:post)

	params: store_id, product_id

	return: store product details

6- Add products to a cart

	URL: /api/user_purchase/create_user_purchase (method:post)

	params: store_id, user_id, purchased_products( array of products [[product_id,quantity],[product_id,quantity]])

	return: total

7- Show all merchant stores
	
	URL: /api/store/{merchant_id} (method:get)
	return: array of merchant stores
========================================================================================

Database Structure
-------------------

1- users table (id, name, email, password, role (user|merchant))

2- Stores table (id, name, user_id(whose role is merchant), shipping_cost)

3- Products table (id, arabic_name, english_name, arabic_description, english_description)

4- store_products (id, store_id, product_id, product_quantity, sold (number of products that was sold), product_price, vat_calculation_method(should be percentage or value), vat_calculation_value )

5- user_purchases table (id, user_id(whose role is user), store_id, shipping_cost(I added this column here because if store shipping cost was changed, user has shipping cost value that he paid) )

6- user_purchases_details table (id, user_purchase_id, price(product's price that user paid), quantity, vat)

========================================================================================

Adding products Cycle
----------------------
1- Create a merchant and user from create user url
2- Create store for the created merchant
3- Add product to the created store  
4- Use created user to add products to cart and create user purchase record
