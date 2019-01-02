<?php

namespace Quarcade\ExternalOrder\Setup;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData
 * @package Quarcade\ExternalOrder\Setup
 */
class InstallData implements InstallDataInterface
{

    /**
     *  @var \Magento\Framework\App\Config\Storage\WriterInterface
     */
    protected $configWriter;

    /**
     * Init
     *
     * @param \Magento\Framework\App\Config\Storage\WriterInterface $configWriter
     */
    public function __construct(\Magento\Framework\App\Config\Storage\WriterInterface $configWriter)
    {
        $this->configWriter = $configWriter;
    }

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        /* Disable guest checkout by default */
        $this->configWriter->save('checkout/options/guest_checkout',  0, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);

        $installer->endSetup();
    }
}