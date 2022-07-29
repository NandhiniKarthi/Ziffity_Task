<?php

namespace Ziffity\Task\Model;

use Ziffity\Task\Api\Data\CustomInterface;
use \Magento\Framework\Model\AbstractModel; 

class Custom extends AbstractModel implements CustomInterface
{
    protected function _construct()
    {
        $this->_init("Ziffity\Task\Model\ResourceModel\Custom");
    }

    public function getCustomCartId()
    {
        return $this->getData(self::CUSTOMCART_ID);
    }


    public function setCustomCartId($customcart_id)
    {
        return $this->setData(self::CUSTOMCART_ID, $customcart_id);
    }


    public function getSku()
    {
        return $this->getData(self::SKU);
    }


    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }


    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }


    public function setCustomerId($customer_id)
    {
        return $this->setData(self::CUSTOMER_ID, $customer_id);
    }


    public function getQuoteId()
    {
        return $this->getData(self::QUOTE_ID);
    }


    public function setQuoteId($quote_id)
    {
        return $this->setData(self::QUOTE_ID, $quote_id);
    }


    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }


    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }
}
