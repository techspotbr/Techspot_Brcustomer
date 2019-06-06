<?php
/**
 * O Módulo Tech Spot - BRCustomer para Magento 2 habilita o cadastro de clientes PF (Pessoa Física) e PJ(Pessoa Jurídica) no cadastro do cliente da sua aplicação Magento.
 * Copyright (C) 2018  Tech Spot 
 * 
 * This file is part of Techspot/Brcustomer.
 * 
 * Techspot/Brcustomer is free software: you can redistribute it and/or modify
 * it under the terms of the MTI Public License as published by
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

namespace Techspot\Brcustomer\Block\Widget;

use Magento\Customer\Api\CustomerMetadataInterface;

/**
 * Customer Value Added Rg Widget
 *
 * @SuppressWarnings(PHPMD.DepthOfInheritance)
 */
class Telephone extends AbstractWidget
{   
    /**
     * Constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Helper\Address $addressHelper
     * @param CustomerMetadataInterface $customerMetadata
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Helper\Address $addressHelper,
        CustomerMetadataInterface $customerMetadata,
        array $data = []
    ) {
        parent::__construct($context, $addressHelper, $customerMetadata, $data);
        $this->_isScopePrivate = true;
    }

    /**
     * Sets the template
     *
     * @return void
     */
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('widget/telephone.phtml');
    }

    /**
     * Get is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->_getAttribute('custom_telephone') ? (bool)$this->_getAttribute('custom_telephone')->isVisible() : false;
    }

    /**
     * Get is required.
     *
     * @return bool
     */
    public function isRequired()
    {
        return $this->_getAttribute('custom_telephone') ? (bool)$this->_getAttribute('custom_telephone')->isRequired() : false;
    }
}
