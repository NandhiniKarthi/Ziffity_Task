<?php

namespace Ziffity\Task\Model\ResourceModel\Custom;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Collection
 */
class Collection extends AbstractCollection
{    
    /**
     * _construct
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init("Ziffity\Task\Model\Custom", "Ziffity\Task\Model\ResourceModel\Custom");
    }
}
