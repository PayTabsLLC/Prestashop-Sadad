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

*  @version  Release: $Revision: 15094 $

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)

*  International Registered Trademark & Property of PrestaShop SA

*/



/**

 * @since 1.5.0

 */

class SadadValidationModuleFrontController extends ModuleFrontController
{
	/**

	 * @see FrontController::postProcess()

	 */

	public function postProcess()
	{
		$cart = $this->context->cart;

		if ($cart->id_customer == 0 || $cart->id_address_delivery == 0 || $cart->id_address_invoice == 0 || !$this->module->active)
			Tools::redirect('index.php?controller=order&step=1');


		// Check that this payment option is still available in case the customer changed his address just before the end of the checkout process
		$authorized = false;
		foreach (Module::getPaymentModules() as $module)
			if ($module['name'] == 'sadad')
			{
				$authorized = true;
				break;
			}

		if (!$authorized)
			die($this->module->l('This payment method is not available.', 'validation'));

		$currency = $this->context->currency;
		$customer = new Customer($cart->id_customer);
		if (!Validate::isLoadedObject($customer))
			Tools::redirect('index.php?controller=order&step=1');
		
		
		//check payment status
		if($this->module->paytabs_password == 'test')
			$gateway_url = 'https://www.paytabs.com/';
		else
			$gateway_url = 'https://www.paytabs.com/';
		
		$request_param =array('secret_key'=>$this->module->paytabs_password,
		'merchant_email'=>$this->module->paytabs_id,
		 'payment_reference'=>$_POST['payment_reference']);

		$request_string = http_build_query($request_param);

		$response_data = $this->module->sendRequest($gateway_url . 'apiv2/verify_payment', $request_string);
		$object = json_decode($response_data);
		if($object->response_code == "100"){
			//success
			$total = (float)$cart->getOrderTotal(true, Cart::BOTH);
			$this->module->validateOrder($cart->id, Configuration::get('PS_OS_PAYMENT'), $total, $this->module->displayName, 'Transaction Reference: ' . $_POST['payment_reference'], array(), (int)$currency->id, false, $customer->secure_key);
			Tools::redirect('index.php?controller=order-confirmation&id_cart='.$cart->id.'&id_module='.$this->module->id.'&id_order='.$this->module->currentOrder.'&key='.$customer->secure_key);
			return;
		} else {
			//fail
			$this->error = $object->result;//$this->module->getErrorMessage($object->error_code);
			$total = (float)$cart->getOrderTotal(true, Cart::BOTH);	
			$this->module->validateOrder($cart->id, Configuration::get('PS_OS_ERROR'), $total, $this->module->displayName, $this->error, array(), (int)$currency->id, false, $customer->secure_key);
		}
	}
	
	public function initContent()
	{   
		global $cookie;

		parent::initContent();

		$this->context->smarty->assign(array(
				'error' => $this->error,
				'order_url' => 'index.php?controller=order&step=1'
		));
	
		$this->setTemplate('payment_error.tpl');
	}

}