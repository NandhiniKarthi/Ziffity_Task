<?php

namespace Ziffity\Task\Observer\Backend;

use Magento\Framework\Message\ManagerInterface;
use Magento\Checkout\Model\Session;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Ziffity\Task\Model\Custom;
use Ziffity\Task\Model\Repository;

class AddCatalogToCart implements ObserverInterface
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        ManagerInterface $message,
        Session $session,
        PublisherInterface $publisher,
        SerializerInterface $serializer,
        Custom $cart,
        LoggerInterface $logger,
        Repository $repository
    ) {
        $this->_messageManager = $message;
        $this->_checkoutSession=$session;
        $this->publisher = $publisher;
        $this->serializer = $serializer;
        $this->cart = $cart;
        $this->repository = $repository;
    }
    /**
     * execute
     *
     * @param  mixed $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $sku = $observer->getEvent()->getData('product')->getSku();
        $quote = $this->_checkoutSession->getQuote();
        $this->cart->setSku($sku);
        $this->cart->setQuoteId($quote->getId());
        $this->cart->setCustomerId($quote->getCustomerId());
        $this->repository->save($this->cart);
        $this->publisher->publish(
            'crud_data',
            $this->cart
        );
        if ($sku) {
            try {
                $this->_messageManager->addSuccessMessage(
                    __('added to queue')
                );
            } catch (\Exception $e) {
                $this->_messageManager->addErrorMessage($e->getMessage());
            }
        }
    }
}
