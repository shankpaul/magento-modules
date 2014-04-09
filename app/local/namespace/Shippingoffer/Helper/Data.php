<?php
class Nuevalgo_Shippingoffer_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XPATH_FRONTEND_MESSAGE = 'carriers/shippingoffer/tagmessage';
    const XPATH_FRONTEND_ENABLED = 'carriers/shippingoffer/active';
    const XPATH_FRONTEND_AMOUNT = 'carriers/shippingoffer/free_shipping_subtotal';
    /**
     * Check whether module is enabled or not
     *
     * @return boolean
     */
    public function isMethodActive()
    {
        return Mage::getStoreConfig(self::XPATH_FRONTEND_ENABLED);
    }
    /**
     * Get the message template
     *
     * @return string
     */
    public function getTagMessage()
    {
        return Mage::getStoreConfig(self::XPATH_FRONTEND_MESSAGE);
    }
    /**
     * Get the minimum order amount to compare with present cart order amount
     *
     * @return decimal
     */
    public function getMinimumOrderAmount()
    {
        return Mage::getStoreConfig(self::XPATH_FRONTEND_AMOUNT);
    }
}