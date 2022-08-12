<?php

declare(strict_types=1);

namespace Ziffity\Task\Model;

use Ziffity\Task\Api\Data\CartInterface;
use Magento\Framework\Api\SearchResults;

class Cart extends SearchResults implements CartInterface
{
}
