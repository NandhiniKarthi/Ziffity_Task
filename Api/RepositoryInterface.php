<?php

namespace Ziffity\Task\Api;

use Ziffity\Task\Api\Data\CustomInterface;
use \Magento\Framework\Api\SearchCriteriaInterface;

interface RepositoryInterface
{
    /**
     * Save Cart.
     *
     * @param \Ziffity\Task\Api\Data\CustomInterface $Cart
     * @return \Ziffity\Task\Api\Data\CustomInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(CustomInterface $cart);

    /**
     * Retrieve Cart.
     *
     * @param string $CartId
     * @return \Ziffity\Task\Api\Data\CustomInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getReferenceById($cartId);

    /**
     * Retrieve customCarts matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Ziffity\Task\Api\Data\CartInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */

    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete Cart.
     *
     * @param \Ziffity\Task\Api\Data\CustomInterface $Cart
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(CustomInterface $cart);

    /**
     * Delete Cart by ID.
     *
     * @param string $CartId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($cartId);
}
