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

	
	public function getccPhone($code){
        $countries = array(
          "AFG" => '+93',//array("AFGHANISTAN", "AF", "AFG", "004"),
          "ALB" => '+355',//array("ALBANIA", "AL", "ALB", "008"),
          "DZA" => '+213',//array("ALGERIA", "DZ", "DZA", "012"),
          "ASM" => '+376',//array("AMERICAN SAMOA", "AS", "ASM", "016"),
          "AND" => '+376',//array("ANDORRA", "AD", "AND", "020"),
          "AGO" => '+244',//array("ANGOLA", "AO", "AGO", "024"),
          "ATG" => '+1-268',//array("ANTIGUA AND BARBUDA", "AG", "ATG", "028"),
          "ARG" => '+54',//array("ARGENTINA", "AR", "ARG", "032"),
          "ARM" => '+374',//array("ARMENIA", "AM", "ARM", "051"),
          "AUT" => '+61',//array("AUSTRALIA", "AU", "AUS", "036"),
          "AUT" => '+43',//array("AUSTRIA", "AT", "AUT", "040"),
          "AZE" => '+994',//array("AZERBAIJAN", "AZ", "AZE", "031"),
          "BHR" => '+1-242',//array("BAHAMAS", "BS", "BHS", "044"),
          "BGD" => '+973',//array("BAHRAIN", "BH", "BHR", "048"),
          "BGD" => '+880',//array("BANGLADESH", "BD", "BGD", "050"),
          "BRB" => '1-246',//array("BARBADOS", "BB", "BRB", "052"),
          "BLR" => '+375',//array("BELARUS", "BY", "BLR", "112"),
          "BEL" => '+32',//array("BELGIUM", "BE", "BEL", "056"),
          "BLZ" => '+501',//array("BELIZE", "BZ", "BLZ", "084"),
          "BEN" =>'+229',// array("BENIN", "BJ", "BEN", "204"),
          "BTN" => '+975',//array("BHUTAN", "BT", "BTN", "064"),
          "BOL" => '+591',//array("BOLIVIA", "BO", "BOL", "068"),
          "BIH" => '+387',//array("BOSNIA AND HERZEGOVINA", "BA", "BIH", "070"),
          "BWA" => '+267',//array("BOTSWANA", "BW", "BWA", "072"),
          "BRA" => '+55',//array("BRAZIL", "BR", "BRA", "076"),
          "BRN" => '+673',//array("BRUNEI DARUSSALAM", "BN", "BRN", "096"),
          "BGR" => '+359',//array("BULGARIA", "BG", "BGR", "100"),
          "BFA" => '+226',//array("BURKINA FASO", "BF", "BFA", "854"),
          "BDI" => '+257',//array("BURUNDI", "BI", "BDI", "108"),
          "KHM" => '+855',//array("CAMBODIA", "KH", "KHM", "116"),
          "CAN" => '+1',//array("CANADA", "CA", "CAN", "124"),
          "CPV" => '+238',//array("CAPE VERDE", "CV", "CPV", "132"),
          "CAF" => '+236',//array("CENTRAL AFRICAN REPUBLIC", "CF", "CAF", "140"),
          "CAF" => '+237',//array("CENTRAL AFRICAN REPUBLIC", "CF", "CAF", "140"),
          "TCD" => '+235',//array("CHAD", "TD", "TCD", "148"),
          "CHL" => '+56',//array("CHILE", "CL", "CHL", "152"),
          "CHN" => '+86',//array("CHINA", "CN", "CHN", "156"),
          "COL" => '+57',//array("COLOMBIA", "CO", "COL", "170"),
          "COM" => '+269',//array("COMOROS", "KM", "COM", "174"),
          "COG" => '+242',//array("CONGO", "CG", "COG", "178"),
          "CRI" => '+506',//array("COSTA RICA", "CR", "CRI", "188"),
          "CIV" => '+225',//array("COTE D'IVOIRE", "CI", "CIV", "384"),
          "HRV" => '+385',//array("CROATIA (local name: Hrvatska)", "HR", "HRV", "191"),
          "CUB" => '+53',//array("CUBA", "CU", "CUB", "192"),
          "CYP" => '+357',//array("CYPRUS", "CY", "CYP", "196"),
          "CZE" => '+420',//array("CZECH REPUBLIC", "CZ", "CZE", "203"),
          "DNK" => '+45',//array("DENMARK", "DK", "DNK", "208"),
          "DJI" => '+253',//array("DJIBOUTI", "DJ", "DJI", "262"),
          "DMA" => '+1-767',//array("DOMINICA", "DM", "DMA", "212"),
          "DOM" => '+1-809',//array("DOMINICAN REPUBLIC", "DO", "DOM", "214"),
          "ECU" => '+593',//array("ECUADOR", "EC", "ECU", "218"),
          "EGY" => '+20',//array("EGYPT", "EG", "EGY", "818"),
          "SLV" => '+503',//array("EL SALVADOR", "SV", "SLV", "222"),
          "GNQ" => '+240',//array("EQUATORIAL GUINEA", "GQ", "GNQ", "226"),
          "ERI" => '+291',//array("ERITREA", "ER", "ERI", "232"),
          "EST" => '+372',//array("ESTONIA", "EE", "EST", "233"),
          "ETH" => '+251',//array("ETHIOPIA", "ET", "ETH", "210"),
          "FJI" => '+679',//array("FIJI", "FJ", "FJI", "242"),
          "FIN" => '+358',//array("FINLAND", "FI", "FIN", "246"),
          "FRA" => '+33',//array("FRANCE", "FR", "FRA", "250"),
          "GAB" => '+241',//array("GABON", "GA", "GAB", "266"),
          "GMB" => '+220',//array("GAMBIA", "GM", "GMB", "270"),
          "GEO" => '+995',//array("GEORGIA", "GE", "GEO", "268"),
          "DEU" => '+49',//array("GERMANY", "DE", "DEU", "276"),
          "GHA" => '+233',//array("GHANA", "GH", "GHA", "288"),
          "GRC" => '+30',//array("GREECE", "GR", "GRC", "300"),
          "GRD" => '+1-473',//array("GRENADA", "GD", "GRD", "308"),
          "GTM" => '+502',//array("GUATEMALA", "GT", "GTM", "320"),
          "GIN" => '+224',//array("GUINEA", "GN", "GIN", "324"),
          "GNB" => '+245',//array("GUINEA-BISSAU", "GW", "GNB", "624"),
          "GUY" => '+592',//array("GUYANA", "GY", "GUY", "328"),
          "HTI" => '+509',//array("HAITI", "HT", "HTI", "332"),
          "HND" => '+504',//array("HONDURAS", "HN", "HND", "340"),
          "HKG" => '+852',//array("HONG KONG", "HK", "HKG", "344"),
          "HUN" => '+36',//array("HUNGARY", "HU", "HUN", "348"),
          "ISL" => '+354',//array("ICELAND", "IS", "ISL", "352"),
          "IND" => '+91',//array("INDIA", "IN", "IND", "356"),
          "IDN" => '+62',//array("INDONESIA", "ID", "IDN", "360"),
          "IRN" => '+98',//array("IRAN, ISLAMIC REPUBLIC OF", "IR", "IRN", "364"),
          "IRQ" => '+964',//array("IRAQ", "IQ", "IRQ", "368"),
          "IRL" => '+353',//array("IRELAND", "IE", "IRL", "372"),
          "ISR" => '+972',//array("ISRAEL", "IL", "ISR", "376"),
          "ITA" => '+39',//array("ITALY", "IT", "ITA", "380"),
          "JAM" => '+1-876',//array("JAMAICA", "JM", "JAM", "388"),
          "JPN" => '+81',//array("JAPAN", "JP", "JPN", "392"),
          "JOR" => '+962',//array("JORDAN", "JO", "JOR", "400"),
          "KAZ" => '+7',//array("KAZAKHSTAN", "KZ", "KAZ", "398"),
          "KEN" => '+254',//array("KENYA", "KE", "KEN", "404"),
          "KIR" => '+686',//array("KIRIBATI", "KI", "KIR", "296"),
          "PRK" => '+850',//array("KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF", "KP", "PRK", "408"),
          "KOR" => '+82',//array("KOREA, REPUBLIC OF", "KR", "KOR", "410"),
          "KWT" => '+965',//array("KUWAIT", "KW", "KWT", "414"),
          "KGZ" => '+996',//array("KYRGYZSTAN", "KG", "KGZ", "417"),
          "LAO" => '+856',//array("LAO PEOPLE'S DEMOCRATIC REPUBLIC", "LA", "LAO", "418"),
          "LVA" => '+371',//array("LATVIA", "LV", "LVA", "428"),
          "LBN" => '+961',//array("LEBANON", "LB", "LBN", "422"),
          "LSO" => '+266',//array("LESOTHO", "LS", "LSO", "426"),
          "LBR" => '+231',//array("LIBERIA", "LR", "LBR", "430"),
          "LBY" => '+218',//array("LIBYAN ARAB JAMAHIRIYA", "LY", "LBY", "434"),
          "LIE" => '+423',//array("LIECHTENSTEIN", "LI", "LIE", "438"),
          "LUX" => '+352',//array("LUXEMBOURG", "LU", "LUX", "442"),
          "MAC" => '+389',//array("MACAU", "MO", "MAC", "446"),
          "MDG" => '+261',//array("MADAGASCAR", "MG", "MDG", "450"),
          "MWI" => '+265',//array("MALAWI", "MW", "MWI", "454"),
          "MYS" => '+60',//array("MALAYSIA", "MY", "MYS", "458"),     
          "MEX" => '+52',//array("MEXICO", "MX", "MEX", "484"),
          "MCO" => '+377',//array("MONACO", "MC", "MCO", "492"),
          "MAR" => '+212',//array("MOROCCO", "MA", "MAR", "504")
          "NPL" => '+977',//array("NEPAL", "NP", "NPL", "524"),
          "NLD" => '+31',//array("NETHERLANDS", "NL", "NLD", "528"),
          "NZL" => '+64',//array("NEW ZEALAND", "NZ", "NZL", "554"),
          "NIC" => '+505',//array("NICARAGUA", "NI", "NIC", "558"),
          "NER" => '+227',//array("NIGER", "NE", "NER", "562"),
          "NGA" => '+234',//array("NIGERIA", "NG", "NGA", "566"),
          "NOR" => '+47',//array("NORWAY", "NO", "NOR", "578"),
          "OMN" => '+968',//array("OMAN", "OM", "OMN", "512"),
          "PAK" => '+92',//array("PAKISTAN", "PK", "PAK", "586"),
          "PAN" => '+507',//array("PANAMA", "PA", "PAN", "591"),
          "PNG" => '+675',//array("PAPUA NEW GUINEA", "PG", "PNG", "598"),
          "PRY" =>'+595',// array("PARAGUAY", "PY", "PRY", "600"),
          "PER" =>'+51',// array("PERU", "PE", "PER", "604"),
          "PHL" =>'+63',// array("PHILIPPINES", "PH", "PHL", "608"),
          "POL" => '48',//array("POLAND", "PL", "POL", "616"),
          "PRT" => '+351',//array("PORTUGAL", "PT", "PRT", "620"),
          "QAT" => '+974',//array("QATAR", "QA", "QAT", "634"),
          "RUS" => '+7',//array("RUSSIAN FEDERATION", "RU", "RUS", "643"),
          "RWA" => '+250',//array("RWANDA", "RW", "RWA", "646"),
          "SAU" => '+966',//array("SAUDI ARABIA", "SA", "SAU", "682"),
          "SEN" => '+221',//array("SENEGAL", "SN", "SEN", "686"),
          "SGP" => '+65',//array("SINGAPORE", "SG", "SGP", "702"),
          "SVK" => '+421',//array("SLOVAKIA (Slovak Republic)", "SK", "SVK", "703"),
          "SVN" => '+386',//array("SLOVENIA", "SI", "SVN", "705"),
          "ZAF" => '+27',//array("SOUTH AFRICA", "ZA", "ZAF", "710"),
          "ESP" => '+34',//array("SPAIN", "ES", "ESP", "724"),
          "LKA" => '+94',//array("SRI LANKA", "LK", "LKA", "144"),
          "SDN" => '+249',//array("SUDAN", "SD", "SDN", "736"),
          "SWZ" => '+268',//array("SWAZILAND", "SZ", "SWZ", "748"),
          "SWE" => '+46',//array("SWEDEN", "SE", "SWE", "752"),
          "CHE" => '+41',//array("SWITZERLAND", "CH", "CHE", "756"),
          "SYR" => '+963',//array("SYRIAN ARAB REPUBLIC", "SY", "SYR", "760"),
          "TZA" => '+255',//array("TANZANIA, UNITED REPUBLIC OF", "TZ", "TZA", "834"),
          "THA" => '+66',//array("THAILAND", "TH", "THA", "764"),
          "TGO" => '+228',//array("TOGO", "TG", "TGO", "768"),
          "TON" => '+676',//array("TONGA", "TO", "TON", "776"),
          "TUN" => '+216',//array("TUNISIA", "TN", "TUN", "788"),
          "TUR" => '+90',//array("TURKEY", "TR", "TUR", "792"),
          "TKM" => '+993',//array("TURKMENISTAN", "TM", "TKM", "795"),
          "UKR" => '+380',//array("UKRAINE", "UA", "UKR", "804"),
          "ARE" => '+971',//array("UNITED ARAB EMIRATES", "AE", "ARE", "784"),
          "GBR" => '+44',//array("UNITED KINGDOM", "GB", "GBR", "826"),
          "USA" => '+1'//array("UNITED STATES", "US", "USA", "840"),
          
        );

    
      return $countries[$code];
    }


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
       	$cc=$this->getccPhone($this->module->getCountryIsoCode($invoice_country->iso_code));

	$request_param = array(
					'merchant_email' => $this->module->paytabs_id,
			        'secret_key'     => $this->module->paytabs_password,
				    'cc_first_name' => $address->firstname,
	                'cc_last_name' => $address->lastname,
	                'phone_number' => $address->phone ? $address->phone : $address->phone_mobile,
	                'cc_phone_number' => $cc,
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
		PrestaShopLogger::addLog($object->result, 3, $object->response_code, 'Cart', (int)$cart->id, false);

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
