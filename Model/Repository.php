<?php

namespace Ziffity\Task\Model;

use Ziffity\Task\Api\RepositoryInterface;
use Ziffity\Task\Api\Data\CustomInterface;
use Ziffity\Task\Api\Data\CartInterfaceFactory;
use Ziffity\Task\Model\ResourceModel\Custom as ResourceCustomCart;
use Ziffity\Task\Model\ResourceModel\Custom\CollectionFactory as CustomCartCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Ziffity\Task\Api\Data\CustomInterfaceFactory;
class Repository implements RepositoryInterface
{
    protected $resource;
    protected $customCartFactory;
    protected $customCartCollectionFactory;
    protected $searchResultsFactory;
    protected $dataObjectHelper;
    protected $dataObjectProcessor;
    protected $dataCustomCartFactory;
    private $collectionProcessor;    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        ResourceCustomCart $resource,
        CustomFactory $customCartFactory,
        CustomInterfaceFactory $dataCustomCartFactory,
        CustomCartCollectionFactory $customCartCollectionFactory,
        CartInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->customCartFactory = $customCartFactory;
        $this->customCartCollectionFactory = $customCartCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCustomCartFactory = $dataCustomCartFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->collectionProcessor = $collectionProcessor;
    }    
    /**
     * save
     *
     * @param  mixed $cart
     * @return void
     */
    public function save(CustomInterface $cart)
    {
        try {
            $this->resource->save($cart);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $cart;
    }
    /**
     * getById
     *
     * @param  mixed $cartId
     * @return void
     */
    public function getById($cartId)
    {
        $customCart = $this->customCartFactory->create();
        $this->resource->load($customCart, $cartId);
        if (!$customCart->getCustomCartId()) {
            throw new NoSuchEntityException(__(' "%1" ID doesn\'t exist.', $cartId));
        }
        return $customCart;
    }
    /**
     * getList
     *
     * @param  mixed $criteria
     * @return void
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        $collection = $this->customCartCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setItems($collection->getItems());
        return  $searchResults ;
    }    
    /**
     * delete
     *
     * @param  mixed $cart
     * @return void
     */
    public function delete(CustomInterface $cart)
    {
        try {
            $this->resource->delete($cart);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }    
    /**
     * deleteById
     *
     * @param  mixed $cartId
     * @return void
     */
    public function deleteById($cartId)
    {
        return $this->delete($this->getById($cartId));
    }
}
