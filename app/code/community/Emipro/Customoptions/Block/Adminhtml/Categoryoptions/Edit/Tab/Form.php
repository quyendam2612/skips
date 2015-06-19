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
class Emipro_Customoptions_Block_Adminhtml_Categoryoptions_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    public function __construct() {
        parent::__construct();

        $this->setTemplate('customoptions/category.phtml');
    }

    public function _getOptions() {
        $title = array();

        $product = Mage::getModel('catalog/product');
        $productId = $product->getIdBySku('customoptionmaster');
        $product->load($productId);
        $options = $product->getOptions();

        return $options;
    }

    public function _getCollectionWithoutOptions() {
        $catalogModel = Mage::getModel('catalog/product')->getCollection()->addAttributeToFilter('status', '1')->addAttributeToSelect('*');
        return $catalogModel;
    }

}
