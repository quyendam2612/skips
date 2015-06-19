<?php 
/*
 * //////////////////////////////////////////////////////////////////////////////////////
 *
 * @author Emipro Technologies
 * @Category Emipro
 * @package Emipro_Customoptions
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 * //////////////////////////////////////////////////////////////////////////////////////
 */
class Emipro_Customoptions_Block_Adminhtml_Removecustomoptions_Edit_Tab_Removesku extends Mage_Adminhtml_Block_Widget_Form {

	public function _prepareForm() {

        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('_removesku');
        $form->setFieldNameSuffix('removesku');
        $this->setForm($form);
        $fieldset = $form->addFieldset('removesku_form', array('legend' => Mage::helper('customoptions')->__('Sku List')));

        $fieldset->addField('remove_sku', 'textarea', array(
            'label' => Mage::helper('customoptions')->__('Sku List'),
            'name' => 'remove_sku',
            'note'=>'Enter sku list comma(,) seprated.eg(sku1,sku2)',
        ));
        return parent::_prepareForm();
    }

}
