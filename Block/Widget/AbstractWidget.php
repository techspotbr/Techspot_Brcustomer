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

class AbstractWidget extends \Magento\Customer\Block\Widget\AbstractWidget
{
    const CUSTOMER_EDIT_FORM_BLOCK = 'form_additional_info_customer_edit';

    /**
     * Check if current block is a customer edit
     * 
     * @param $block
     * @return bool
     */
    public function isEditForm($block)
    {
        if ($block->getNameInLayout() === self::CUSTOMER_EDIT_FORM_BLOCK) {
            return true;
        }
        return false;
    }

    /*
    * Return the attribute value for customer, 
    * or Form Data Attribute
    *
    * @param $blockThis
    * @param $block
    * @param $attributeCode
    *
    * @return string
    */
    public function getCustomAttribute($blockThis, $block, $attributeCode)
    {
        if($this->isEditForm($blockThis)){
            $attribute = $block->getCustomer()->getCustomAttribute($attributeCode);
            $value = $attribute ? $attribute->getValue() : null;
            
            return $value;
        } else {
            return $block->getFormData()->getAttribute($attributeCode);
        }
    }
}
