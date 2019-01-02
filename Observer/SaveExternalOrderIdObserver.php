<?php

namespace Quarcade\ExternalOrder\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class SaveExternalOrderIdObserver implements ObserverInterface
{
    /**
     * Add External Order Id to order data
     *
     * @param EventObserver $observer
     * @return $this
     */
    public function execute(EventObserver $observer)
    {
        $order = $observer->getOrder();
        $quote = $observer->getQuote();

        $externalOrderId = $quote->getExternalOrderId();

        if (empty($externalOrderId)) {
            return $this;
        }

        $order->setExternalOrderId($externalOrderId);

        return $this;
    }
}
