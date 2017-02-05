	<?php

/*

* 2007-2012 PrestaShop

*

* NOTICE OF LICENSE

*

* This source file is subject to the Academic Free License (AFL 3.0)

* that is bundled with this package in the file LICENSE.txt.

* It is also available through the world-wide-web at this URL:

* http://opensource.org/licenses/afl-3.0.php

* If you did not receive a copy of the license and are unable to

* obtain it through the world-wide-web, please send an email

* to license@prestashop.com so we can send you a copy immediately.

*

* DISCLAIMER

*

* Do not edit or add to this file if you wish to upgrade PrestaShop to newer

* versions in the future. If you wish to customize PrestaShop for your

* needs please refer to http://www.prestashop.com for more information.

*

*  @author PrestaShop SA <contact@prestashop.com>

*  @copyright  2007-2012 PrestaShop SA

*  @version  Release: $Revision: 17805 $

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)

*  International Registered Trademark & Property of PrestaShop SA

*/



/**

 * @since 1.5.0

 */

class SadadPaymentModuleFrontController extends ModuleFrontController
{
	public $ssl = true;

	/**

	 * @see FrontController::initContent()

	 */

	public function initContent()
	{   
		global $cookie;

		parent::initContent();

		$cart = $this->context->cart;
               

		if($this->module->paytabs_password == 'test')
			$gateway_url = 'https://www.paytabs.com';
		else
			$gateway_url = 'https://www.paytabs.com';

		$currency = new Currency((int)($cart->id_currency));
		$customer = new Customer(intval($cart->id_customer));

		$address = new Address(intval($cart->id_address_invoice));
		$shipping = new Address(intval($cart->id_address_delivery));
              
		$invoice_country = new Country($address->id_country);
		$invoice_country1 = new Country($shipping->id_country);
		
		$shippingState = NULL;
                $shippingMethod = new CarrierCore($cart->id_carrier);
                
		if ($address->id_state)
			$invoice_state = new State((int)($address->id_state));

		$amount = number_format($cart->getOrderTotal(true, Cart::BOTH), 2, '.', '');


		$products = $cart->getProducts();
		
           //  print_r($shipping);die;
		
		$order_description = '';
        $categories = "";
        $product_title = "";
        $quantity = "";
        $per_price = "";
        $per_title = "";
        $total = "";
        $i = 0;

		//die;
		$total_product_ammout = 0;
		foreach ($products AS $product){


		

			$dd=$amount-$product['total'];
			$total_product_ammout += $product['total'];

			if ($i >= 1 ){
				$order_description .= ', '. $product['name'];
                $categories .= ', ' . $product['category'] ;
                $product_title .= ', '. $product['name'] ;
                $quantity .= ' || '. $product['cart_quantity'];
                $per_price .= ' || '. number_format($product['price_wt'],3) ;
                $per_title .= ' || '. $product['name'] ;
			}
			else {
				$total .= $product['total'];
				$order_description .= $product['name'];
                $categories .= $product['category'] ;
                $product_title .= $product['name'] ;
                $quantity  .= $product['cart_quantity'];
                $per_price .= number_format($product['price_wt'],3) ;
                $per_title .= $product['name'] ;

			}
			$i++;
                    
		}
		$discount = $total_product_ammout + $cart->getOrderTotal(true, Cart::ONLY_SHIPPING) - $amount;


		if ($_SERVER['SERVER_PORT']==443) {
			$protocol='https://';
		}else{
			$protocol='http://';
		}
	
		$lang_ = "English";
       	if ($this->context->language->iso_code == "ar"){
       		$lang_  = "Arabic";
       	}

       	$language_label=$this->context->language->iso_code;
		//$this->context->smarty->assign('language' => $language_label);

	$request_param = array(
					'merchant_email' => $this->module->paytabs_id,
			        'secret_key'     => $this->module->paytabs_password,
				    'cc_first_name' => $address->firstname,
	                'cc_last_name' => $address->lastname,
	                'phone_number' => $address->phone,
	                'cc_phone_number' => $address->phone,
	                'billing_address' => $address->address1.' '.$address->address2,
	                'city' => $address->city,
	                'state' => $address->id_state ? $invoice_state->name : '',
	                'postal_code' => $address->postcode,
	                'country' => $this->module->getCountryIsoCode($invoice_country->iso_code),
	                'email'  => $customer->email,
	                'amount' =>$total_product_ammout + $cart->getOrderTotal(true, Cart::ONLY_SHIPPING),
	                'currency' => strtoupper($currency->iso_code),
	                'title'   =>  $address->firstname.'  '. $address->lastname,
	                'quantity' => $quantity,
	                "discount"  =>  $discount,
	                'other_charges'    => $cart->getOrderTotal(true, Cart::ONLY_SHIPPING) ,
			        "unit_price" => $per_price,
	                "products_per_title"=>$per_title,
	                'address_shipping' => $shipping->address1.' '.$shipping->address2,
	                'city_shipping' => $shipping->city,
	                'state_shipping' => $shipping->id_state ? $invoice_state->name : $shipping->city,
	                'postal_code_shipping' => $shipping->postcode,
	                'country_shipping' => $this->module->getCountryIsoCode($invoice_country1->iso_code),
	                'ip_customer' => $_SERVER['REMOTE_ADDR'],
	                'ip_merchant' => $_SERVER['SERVER_ADDR'],
	                'ProductCategory' => $categories,
	                'ProductName' => $product_title,
	                'ShippingMethod' => $shippingMethod->name,
	                'DeliveryType' => $shippingMethod->delay[1],
	                "msg_lang" => $lang_,
	                'cms_with_version'   =>'Prestashop 1.6.1',
			        'reference_no'   => $cart->id,
			        'msg_lang'      => $lang_,
			        'CustomerId'     =>$cart->id,
			        'CustomerId'     =>$cart->id,
			        'olp_id'     =>$_POST['sadad'],
			        'site_url'      => $protocol.$_SERVER['HTTP_HOST'],
	                'CustomerId' => $customer->id,
	                'return_url' => Context::getContext()->link->getModuleLink('sadad', 'validation')
	            );

		$request_string = http_build_query($request_param);
		
		$response_data = $this->module->sendRequest($gateway_url . '/apiv2/create_sadad_payment', $request_string);
		$object = json_decode($response_data);

		PrestaShopLogger::addLog($object->result, 3, $object->response_code, 'Cart', (int)$id_cart, false);

		if(isset($object->payment_url) && $object->payment_url != ''){
			$payment_url = $object->payment_url;
			
			$this->context->smarty->assign(array(
				'payment_url' => $payment_url
			));
	
			$this->setTemplate('payment_execution.tpl');
		}else{
			$error = $object->result;
			$this->context->smarty->assign(array(
				'error' => $error,
				'order_url' => 'index.php?controller=order&step=1'
			));
	
			$this->setTemplate('payment_error.tpl');
		}
	}
}