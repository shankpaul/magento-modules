<?php

class Nuevalgo_Hotproduct_Block_Products_Hot extends Mage_Catalog_Block_Product_List
{
    protected $_productCollection;
    public function fetchProducts()
    {
       
       $this->productCollection = Mage::getModel('catalog/product')->getCollection()
        ->addAttributeToSelect('*')
        ->addFieldToFilter('hot_product', array('eq' => '1'));
      return $this->productCollection;
    }
}
