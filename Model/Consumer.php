<?php
declare(strict_types=1);

namespace Ziffity\Task\Model;

use Magento\Framework\Exception\LocalizedException;
use Ziffity\Task\Model\Repository;


class Consumer
{
    
    private $logger;
    
    private $customCartRepository;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        Repository $customCartRepository
    ) {
       
        $this->logger = $logger;
        $this->customCartRepository = $customCartRepository;
    }

   
    public function process(\Ziffity\Task\Api\Data\CustomInterface $data)
    {
        try {
           
         $this->customCartRepository->save($data);
        
        }catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
        catch (LocalizedException $e) {
            $this->logger->critical($e->getMessage());
        }
          
    }
}