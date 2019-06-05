<?php
/**
 * O Módulo Tech Spot - BRCustomer para Magento 2 habilita o cadastro de clientes PF (Pessoa Física) e PJ(Pessoa Jurídica) no cadastro do cliente da sua aplicação Magento.
 * Copyright (C) 2017  Tech Spot 
 * 
 * This file is part of Techspot/Brcustomer.
 * 
 * Techspot/Brcustomer is free software: you can redistribute it and/or modify
 * it under the terms of the MTI License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Techspot\Brcustomer\Setup;

use Magento\Customer\Model\Customer;
use Magento\Framework\Indexer\IndexerRegistry;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{

    /**
     * Customer setup factory
     *
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * @var IndexerRegistry
     */
    protected $indexerRegistry;

    /**
     * @var \Magento\Eav\Model\Config
     */
    protected $eavConfig;

    /**
     * Constructor
     *
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */

    /**
     * @param CustomerSetupFactory $customerSetupFactory
     * @param IndexerRegistry $indexerRegistry
     * @param \Magento\Eav\Model\Config $eavConfig
     */
    public function __construct(
        \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory,
        IndexerRegistry $indexerRegistry,
        \Magento\Eav\Model\Config $eavConfig
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->indexerRegistry = $indexerRegistry;
        $this->eavConfig = $eavConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        if (version_compare($context->getVersion(), "1.0.1", "<")) {
            $this->upgradeVersionOneZeroOne($customerSetup);
        }

        if (version_compare($context->getVersion(), "1.0.2", "<")) {
            $this->upgradeVersionOneZeroTwo($customerSetup);
        }

        if (version_compare($context->getVersion(), "1.0.3", "<")) {
            $this->upgradeVersionOneZeroTree($customerSetup);
        }

        $indexer = $this->indexerRegistry->get(Customer::CUSTOMER_GRID_INDEXER_ID);
        $indexer->reindexAll();
        $this->eavConfig->clear();

        $setup->endSetup();
    }

    /**
     * @param CustomerSetup $customerSetup
     * @return void
     */
    private function upgradeVersionOneZeroOne($customerSetup)
    {
        $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'document', [
            'type' => 'varchar',
            'label' => 'Document ID',
            'input' => 'text',
            'source' => '',
            'required' => false,
            'visible' => false,
            'position' => 336,
            'system' => false,
            'backend' => ''
        ]);

        $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'document_emitter', [
            'type' => 'varchar',
            'label' => 'Document ID Emitter',
            'input' => 'text',
            'source' => '',
            'required' => false,
            'visible' => false,
            'position' => 337,
            'system' => false,
            'backend' => ''
        ]);
    }

    /**
     * @param CustomerSetup $customerSetup
     * @return void
     */
    private function upgradeVersionOneZeroTwo($customerSetup)
    {
        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'legal_type')
            ->addData([
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'is_searchable_in_grid' => true
            ]);
        $attribute->save();

        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'document')
            ->addData(['used_in_forms' => [
                'adminhtml_customer',
                'adminhtml_checkout',
                'customer_account_create',
                'customer_account_edit'
                ]
            ]);
        $attribute->save();

        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'document_emitter')
            ->addData(['used_in_forms' => [
                'adminhtml_customer',
                'adminhtml_checkout',
                'customer_account_create',
                'customer_account_edit'
                ]
            ]);
        $attribute->save();
    }

    /**
     * @param CustomerSetup $customerSetup
     * @return void
     */
    private function upgradeVersionOneZeroTree($customerSetup)
    {
        $customerSetup->addAttribute('customer_address', 'cellphone', [
            'type' => 'varchar',
            'label' => 'Cell phone',
            'input' => 'text',
            'required' => false,
            'visible' => true,
            'user_defined' => true,
            'sort_order' => 1000,
            'position' => 1000,
            'system' => 0,
        ]);

        $indexer = $this->indexerRegistry->get(Customer::CUSTOMER_GRID_INDEXER_ID);
        $indexer->reindexAll();
        $this->eavConfig->clear();

        $attribute = $customerSetup->getEavConfig()->getAttribute('customer_address', 'cellphone')
            ->addData([
                'used_in_forms' => ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address'],
            ]);

        $attribute->save();
    }

}
