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
class Emipro_Customoptions_Model_Customoptions extends Mage_Core_Model_Abstract {

    public function _construct() {
        $this->init('customoptions/customoptions');
    }

    public function saveCustomOption($optionSku, $productId) {
        $copyFrom = $optionSku;
        $copyTo = $productId;
        $catalogModel = Mage::getModel('catalog/product');

        if (count($copyTo) < 1) {
            Mage::getSingleton('adminhtml/session')->addError('Select Products to which you want to copy.');
        } else {

            if ($copyFrom == null) {
                Mage::getSingleton('adminhtml/session')->addError('Select Products Option which you want to copy.');
            } else {
                if ($copyFrom) {
                    $product = Mage::getModel('catalog/product');
                    $productId = $product->getIdBySku('customoptionmaster');
                    $product->load($productId);
                    $opt = $product->getOptions();
                    $newOptionsVal = array();

                    foreach ($opt as $o) {

                        if ($o->getSku() == $copyFrom) {
                            $optionValues = $o->getValues();

                            $newOptions = array(); //array of custom options
                            $newOptions['title'] = $o->getTitle();
                            $newOptions['is_require'] = $o->getIsRequire();
                            $newOptions['type'] = $o->getType();
                            $newOptions['sort_order'] = $o->getSortOrder();
                            $newOptions ['sku'] = $o->getSku();
                            $newOptions ['max_characters'] = $o->getMaxCharacters();
                            $newOptions ['file_extension'] = $o->getFileExtension();
                            $newOptions ['image_size_x'] = $o->getImageSizeX();
                            $newOptions ['image_size_y'] = $o->getImageSizeY();
                            $newOptions ['default_title'] = $o->getDefaultTitle();
                            $newOptions ['store_title'] = $o->getStoreTitle();
                            $newOptions ['default_price'] = $o->getDefaultPrice();
                            $newOptions ['default_price_type'] = $o->getDefaultPriceType();
                            $newOptions ['store_price'] = $o->getStorePrice();
                            $newOptions ['store_price_type'] = $o->getStorePriceType();
                            $newOptions ['price'] = $o->getPrice();
                            $newOptions ['price_type'] = $o->getPriceType();

                            $newOptionsVal = array();
                            foreach ($optionValues as $val) {
                                $copyValues = array();
                                $newOptionsValues = array(); //array of custom options values

                                $newOptionsValues['sku'] = $val->getSku();
                                $newOptionsValues['sort_order'] = $val->getSortOrder();
                                $newOptionsValues['default_title'] = $val->getDefaultTitle();
                                $newOptionsValues['store_title'] = $val->getStoreTitle();
                                $newOptionsValues['title'] = $val->getTitle();
                                $newOptionsValues['default_price'] = $val->getDefaultPrice();
                                $newOptionsValues['default_price_type'] = $val->getDefaultPriceType();
                                $newOptionsValues['store_price'] = $val->getStorePrice();
                                $newOptionsValues['store_price_type'] = $val->getStorePriceType();
                                $newOptionsValues['price'] = $val->getPrice();
                                $newOptionsValues['price_type'] = $val->getPriceType();

                                $newOptionsVal[] = ($newOptionsValues);
                            }
                            $newOptions['values'] = $newOptionsVal;  //custom option values 
                            foreach ($copyTo as $to) {

                                $skus = array();
                                $option_product = Mage::getModel('catalog/product')->load($to);
                                $custom_options = $option_product->getOptions();
                                foreach ($custom_options as $custom_option) {
                                    array_push($skus, $custom_option['sku']);
                                }
                                if (!in_array($newOptions['sku'], $skus)) {
                                    $option_product->setHasOptions(1)->save();
                                    $opt = Mage::getModel('catalog/product_option');
                                    $opt->setProduct($option_product);
                                    $opt->addOption($newOptions);
                                    $opt->saveOptions(); //saving custom options
                                    $option_product->save();
                                }
                            }
                        }
                    }
                }
                Mage::getSingleton('adminhtml/session')->addSuccess('Custom Options Added Successfully.');
            }
        }
        $this->_redirect('*/*/'); //redirect to index action
    }

}
