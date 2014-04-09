<?php
class Nuevalgo_Shippingoffer_Block_Tag_Message extends Mage_Checkout_Block_Cart_Abstract
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('page/html/message.phtml');
    }
    public function getSubtotal($skipTax = true)
    {
        $subtotal = 0;
        $totals = $this->getTotals();
        $config = Mage::getSingleton('tax/config');
        if (isset($totals['subtotal'])) {
            if ($config->displayCartSubtotalBoth()) {
                if ($skipTax) {
                    $subtotal = $totals['subtotal']->getValueExclTax();
                } else {
                    $subtotal = $totals['subtotal']->getValueInclTax();
                }
            } elseif ($config->displayCartSubtotalInclTax()) {
                $subtotal = $totals['subtotal']->getValueInclTax();
            } else {
                $subtotal = $totals['subtotal']->getValue();
                if (!$skipTax && isset($totals['tax'])) {
                    $subtotal+= $totals['tax']->getValue();
                }
            }
        }
        return $subtotal;
    }
    public function getMessage()
    {
        
        $baseCurrency = Mage::app()->getStore()->getBaseCurrencyCode();
        $currentCurrency = Mage::app()->getStore()->getCurrentCurrencyCode();
        $msg = '';
        $balaceAmount = 0.0;
        $cartAmount = $this->getSubtotal();
       
        $amt = Mage::helper('shippingoffer')->getMinimumOrderAmount();
        $minmAmount = round((Mage::helper('directory')->currencyConvert($amt, $baseCurrency, $currentCurrency)), 2);
        $currencySymbol = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())
                ->getSymbol();
        if (Mage::helper('shippingoffer')->isMethodActive()) {
            if ($cartAmount < $minmAmount) {
                $balaceAmount = $minmAmount - $cartAmount;
                $tagmsg = Mage::helper('shippingoffer')->getTagMessage();
                $msg = str_replace('{{amount}}', '<span>' . $currencySymbol . $balaceAmount . '</span>', $tagmsg);
            }
        }       
        return $msg;
        
    }
}