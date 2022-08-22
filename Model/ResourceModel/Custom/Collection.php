<?php

namespace Ziffity\Task\Model\ResourceModel\Custom;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Ziffity\Task\Model\Custom::class, \Ziffity\Task\Model\ResourceModel\Custom::class);
    }
}
