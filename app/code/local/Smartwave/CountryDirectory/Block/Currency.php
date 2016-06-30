<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Directory
 * @copyright  Copyright (c) 2006-2016 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Currency dropdown block
 *
 * @category   Mage
 * @package    Mage_Directory
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Smartwave_CountryDirectory_Block_Currency extends Mage_Directory_Block_Currency
{

    const COUNTRY_CODE_CN = "CNY";
    const COUNTRY_CODE_EURO = "EUR";
    const CURRENCY_FLAG_IMAGE_PATH = 'smartwave/megamenu/default/icons-de-cn.jpg';
    const CHINESE_STORE_CODE = 'zh';
    const MAGIC_EUR_CNY_RATE = '7.50';

    public function isChineseStore()
    {
        $storeCode = Mage::app()->getStore()->getCode();
        if ($storeCode == self::CHINESE_STORE_CODE)
        {
            return true;
        } else {
            return false;
        }

    }

    public function getGermanyChinaFlags()
    {
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . self::CURRENCY_FLAG_IMAGE_PATH;
    }

    public function getEurToCNYRate()
    {
        $currencyModel = Mage::getModel('directory/currency');
        $eur_to_cny= $currencyModel->getCurrencyRates(self::COUNTRY_CODE_EURO, self::COUNTRY_CODE_CN);

        $euro_symbol = Mage::app()->getLocale()->currency( self::COUNTRY_CODE_EURO )->getSymbol();
        $cny_symbol = Mage::app()->getLocale()->currency( self::COUNTRY_CODE_CN )->getSymbol();
        if(count($eur_to_cny) > 0) {
            return '1' . $euro_symbol . ' : '.  number_format((float)$eur_to_cny[self::COUNTRY_CODE_CN], 2, '.', '') . $cny_symbol;
        }

        return '1' . $euro_symbol . ' : '.  self::MAGIC_EUR_CNY_RATE . $cny_symbol;
    }

}
