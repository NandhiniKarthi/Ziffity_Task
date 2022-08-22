<?php

declare(strict_types=1);

namespace Ziffity\Task\Model;

use Magento\Framework\Exception\LocalizedException;
use Ziffity\Task\Model\Repository;
use Psr\Log\LoggerInterface;
use Ziffity\Task\Api\Data\CustomInterface;

class Consumer
{
    private $logger;
    private $customCartRepository;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        CustomInterface $data,
        LoggerInterface $logger,
        Repository $customCartRepository
    ) {
        $this->logger = $logger;
        $this->customCartRepository = $customCartRepository;
    }
    /**
     * process
     *
     * @param  mixed $data
     * @return void
     */
    public function process(CustomInterface $data)
    {
        try {
            $this->customCartRepository->save($data);
        } catch (LocalizedException $e) {
            $this->logger->critical($e->getMessage());
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
