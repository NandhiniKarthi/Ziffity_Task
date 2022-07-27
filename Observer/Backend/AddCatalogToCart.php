<?php
 namespace Ziffity\Task\Observer\Backend;
 use Magento\Catalog\Model\Product;
 use Magento\Framework\Event\Observer;
 use Magento\Framework\Event\ObserverInterface;


 class AddCatalogToCart implements ObserverInterface
 {
    public function __construct(
        \Magento\Framework\Message\ManagerInterface $message,
        \Magento\Checkout\Model\Session $session,
        \Magento\Framework\MessageQueue\PublisherInterface $publisher,
        \Magento\Framework\Serialize\SerializerInterface $serializer,
        \Ziffity\Task\Model\Custom $Cart,
    
       \Ziffity\Task\Model\Repository $Repository
    )
    
        
        {
            $this->_messageManager = $message;
            $this->_checkoutSession=$session;
            $this->publisher = $publisher;
            $this->serializer = $serializer;
            $this->Cart = $Cart;
            $this->Repository = $Repository;
        }
     public function execute(Observer $observer)
     {
         $sku = $observer->getEvent()->getData('product')->getSku();
         $quote = $this->_checkoutSession->getQuote();
         $this->Cart->setSku($sku);
         $this->Cart->setQuoteId($quote->getId());
         $this->Cart->setCustomerId($quote->getCustomerId());
         $this->Repository->save($this->Cart);
         $this->publisher->publish(
            'crud_data', $this->Cart
        ); 
        if ($sku) {
            $this->_messageManager->addSuccess(
                __('added to queue')
            );
        } else {
            $this->_messageManager->addSuccess(
                __('queue not added')
            );
        }
    }

         
         
        
     }
    
 
