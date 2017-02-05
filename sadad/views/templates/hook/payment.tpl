{*
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
*  @version  Release: $Revision: 6844 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<div class="row">
	<div class="col-xs-12 col-md-6">
        <p class="payment_module">
        <form action="{$link->getModuleLink('sadad', 'payment')}" method="post">
      <img src="{$this_path}sadad.png">
        <input type="text" name="sadad" placeholder="Enter Sadad Account ID">
        <input type="submit">
        </form>

           
            	
            </a>
        </p>
    </div>
</div>


<!-- <p class="payment_module">
	<a href="{$link->getModuleLink('paytabs', 'payment')}" title="{l s='Pay by Paytabs' mod='paytabs'}">
		<img src="{$this_path}logo.png" alt="{l s='Pay by Paytabs' mod='paytabs'}"/>
		{l s='Pay by Paytabs' mod='paytabs'}
	</a>
</p> -->