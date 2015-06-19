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
class Emipro_Customoptions_Block_Adminhtml_Categoryoptions_Edit_Tab_Categories extends Mage_Adminhtml_Block_Widget_Form {

    public $chkd = '';

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

    public function getCopyUrl() {
        return Mage::helper('adminhtml')->getUrl('customoptions/adminhtml_index/copypost');
    }

    public function getDeleteUrl() {
        return Mage::helper('adminhtml')->getUrl('customoptions/adminhtml_index/delete');
    }

    public function getReportUrl() {
        return Mage::helper('adminhtml')->getUrl('customoptions/adminhtml_index/report');
    }

    public function getCategoryUrl() {
        return Mage::helper('adminhtml')->getUrl('customoptions/adminhtml_index/category');
    }

    public function getCategoryDeleteUrl() {
        return Mage::helper('adminhtml')->getUrl('customoptions/adminhtml_index/categoryDelete');
    }

    public function getStores() {
        $allStores = Mage::app()->getStores();
        return $allStores;
    }

    public function getRootCategories($eachStoreId) {
        $storeId = Mage::app()->getStore($eachStoreId)->getId();
        $rootCat = Mage::app()->getStore($storeId)->getRootCategoryId();
        $_categories = Mage::getModel('catalog/category')->getCategories($rootCat);
        return $_categories;
    }

    public function getCategoriesRecursively($categories) {

        $optionId = $this->getRequest()->getParam("id");
        $array = '';
        $array = '<ul>';
        foreach ($categories as $category) {

            $cat = Mage::getModel('catalog/category')->load($category->getId());
            $count = $cat->getProductCount();
            $array .= '<li><input type="checkbox" name="categories[]" value="' . $category->getId() . '"' . $this->getSelectedCategory($category->getId()) . '" />' . $category->getName();
            if ($category->hasChildren()) {
                $children = Mage::getModel('catalog/category')->getCategories($category->getId());
                $array .= $this->getCategoriesRecursively($children);
            }
            $array .= '</li>';
        }
        return $array . '</ul>';
    }

}
