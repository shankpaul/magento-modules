<?php
class Nuevalgo_Shippingoffer_Model_Carrier_Shippingoffer
extends Mage_Shipping_Model_Carrier_Abstract 
implements Mage_Shipping_Model_Carrier_Interface
{
    /**
     * Carrier's code
     *
     * @var string
     */
    protected $_code = 'shippingoffer';

    /**
     * FreeShipping Rates Collector
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }
        $result = Mage::getModel('shipping/rate_result');
        $grandTotal = $request->getBaseSubtotalInclTax();
        $orderMinimum = $this->getConfigData('free_shipping_subtotal');
        if ($grandTotal >= $orderMinimum) {
                $method = Mage::getModel('shipping/rate_result_method');
                $method->setCarrier($this->_code);
                $method->setCarrierTitle($this->getConfigData('title'));
                $method->setMethod($this->_code);
                $method->setPrice('0.00');
                $method->setCost('0.00');
                $result->append($method);
        }
        return $result;
    }

    /**
     * Get allowed shipping methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return array('shippingoffer' => $this->getConfigData('name'));
    }
}