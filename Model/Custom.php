<?php

namespace Ziffity\Task\Model;

use Ziffity\Task\Api\Data\CustomInterface;
use Magento\Framework\Model\AbstractModel;

class Custom extends AbstractModel implements CustomInterface
{
    /**
     * _construct
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init("Ziffity\Task\Model\ResourceModel\Custom");
    }
    /**
     * get CustomCartId
     *
     * @return void
     */
    public function getCustomCartId()
    {
        return $this->getData(self::CUSTOMCART_ID);
    }
    /**
         * set CustomCartId
         *
         * @param  mixed $customcart_id
         * @return void
         */
    public function setCustomCartId($customcart_id)
    {
        return $this->setData(self::CUSTOMCART_ID, $customcart_id);
    }
    /**
         * get Sku
         *
         * @return void
         */
    public function getSku()
    {
        return $this->getData(self::SKU);
    }
    /**
         * set Sku
         *
         * @param  mixed $sku
         * @return void
         */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }
    /**
         * get CustomerId
         *
         * @return void
         */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }
    /**
         * set CustomerId
         *
         * @param  mixed $customer_id
         * @return void
         */
    public function setCustomerId($customer_id)
    {
        return $this->setData(self::CUSTOMER_ID, $customer_id);
    }
    /**
         * get QuoteId
         *
         * @return void
         */
    public function getQuoteId()
    {
        return $this->getData(self::QUOTE_ID);
    }
    /**
         * set QuoteId
         *
         * @param  mixed $quote_id
         * @return void
         */
    public function setQuoteId($quote_id)
    {
        return $this->setData(self::QUOTE_ID, $quote_id);
    }
    /**
         * get CreatedAt
         *
         * @return void
         */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }
    /**
         * set CreatedAt
         *
         * @param  mixed $created_at
         * @return void
         */
    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }
    /**
     * Get Updated At
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(Self::UPDATED_AT);
    }
    /**
     * Set Updated At
     *
     * @param  [string] $updated_at
     * @return CustomCartInterface
     */
    public function setUpdatedAt($updated_at)
    {
        return $this->setData(Self::UPDATED_AT, $updated_at);
    }
}
