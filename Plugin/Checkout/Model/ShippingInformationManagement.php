<?php

namespace Quarcade\ExternalOrder\Plugin\Checkout\Model;

use Magento\Framework\Exception\InputException;

/**
 * Class ShippingInformationManagement
 * @package Quarcade\ExternalOrder\Plugin\Checkout\Model
 */
class ShippingInformationManagement
{
    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $quoteRepository;

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     * @throws InputException
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        $extAttributes = $addressInformation->getShippingAddress()->getExtensionAttributes();
        $externalOrderId = $extAttributes->getExternalOrderId();

        if (!$externalOrderId) {
            return;
        }

        if (strlen($externalOrderId) > 40) {
            throw new InputException(__('Maximum length of External Order Id must be equal or lower than 40 symbols.'));
        }

        $quote = $this->quoteRepository->getActive($cartId);
        $quote->setExternalOrderId($externalOrderId);
    }
}