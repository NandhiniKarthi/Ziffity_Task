<?php
 namespace Ziffity\Task\Observer\Backend;
 use Magento\Catalog\Model\Product;
 use Magento\Framework\Event\Observer;
 use Magento\Framework\Event\ObserverInterface;
 use \Psr\Log\LoggerInterface;

 class AddCatalogToCart implements ObserverInterface
 {
    public function __construct(
        \Magento\Framework\Message\ManagerInterface $message,
        \Magento\Checkout\Model\Session $session,
        \Magento\Framework\MessageQueue\PublisherInterface $publisher,
        \Magento\Framework\Serialize\SerializerInterface $serializer,
        \Ziffity\Task\Model\Custom $cart,
        LoggerInterface $logger,
       \Ziffity\Task\Model\Repository $repository
    )
    {
            $this->_messageManager = $message;
            $this->_checkoutSession=$session;
            $this->publisher = $publisher;
            $this->serializer = $serializer;
            $this->cart = $cart;
            $this->repository = $repository;
        }
     public function execute(Observer $observer)
     {
         $sku = $observer->getEvent()->getData('product')->getSku();
         $quote = $this->_checkoutSession->getQuote();
         $this->cart->setSku($sku);
         $this->cart->setQuoteId($quote->getId());
         $this->cart->setCustomerId($quote->getCustomerId());
         $this->repository->save($this->cart);
         $this->publisher->publish(
            'crud_data', $this->cart
        ); 
        if ($sku) {
            try
            {
            $this->_messageManager->addSuccess(
                __('added to queue')
            );
        }
         catch (\Exception $e) {
            $this->logger->critical($e->addSuccess(
                __('queue not added'))
            );
        }
    }
    }
}
    
 
