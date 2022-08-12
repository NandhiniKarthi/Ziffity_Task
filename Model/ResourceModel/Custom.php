<?php

namespace Ziffity\Task\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Custom extends AbstractDb
{

    /**
     * _construct
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init("crud", "id");
    }
}
