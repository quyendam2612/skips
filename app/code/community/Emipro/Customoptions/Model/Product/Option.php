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
class Emipro_Customoptions_Model_Product_Option extends Mage_Catalog_Model_Product_Option {

    public function saveOptions() {
        $_skus = array();

        foreach ($this->getOptions() as $option) {
            array_push($_skus, $option['sku']);
        }

        if (count($_skus) != count(array_unique($_skus))) {
            Mage::throwException('Duplicate Option found');
        }

        foreach ($this->getOptions() as $option) {
            $feature_id = Mage::getModel('catalog/product')->getIdBySku('customoptionmaster');
            if ($feature_id == $this->getProduct()->getId() && count($option) > 0) {
                $qry = "SELECT product_id FROM  " . Mage::getConfig()->getTablePrefix() . "catalog_product_option WHERE sku = '" . $option['sku'] . "' GROUP BY product_id";
                $res = Mage::getSingleton('core/resource')->getConnection('core_read')->fetchAll($qry);

                foreach ($res as $option_product_id) {
                    if ($option_product_id['product_id'] != $feature_id && isset($option["copy_to"])) {
                        $option_product = Mage::getModel('catalog/product')->load($option_product_id['product_id']);
                        $product_options = $option_product->getOptions();

                        foreach ($product_options as $product_option) {
                            if ($product_option['sku'] == $option['sku']) {
                                $optionValues = $option['values'];

                                $newOptions = array(); //array of custom options
                                $newOptions['title'] = $option['title'];
                                $newOptions['is_require'] = $option['is_require'];
                                $newOptions['type'] = $option['type'];
                                $newOptions['sort_order'] = $option['sort_order'];
                                $newOptions['sku'] = $option['sku'];
                                $newOptions['max_characters'] = $option['max_characters'];
                                $newOptions['file_extension'] = $option['file_extension'];
                                $newOptions['image_size_x'] = $option['image_size_x'];
                                $newOptions['image_size_y'] = $option['image_size_y'];
                                $newOptions['default_title'] = $option['default_title'];
                                $newOptions['store_title'] = $option['store_title'];
                                $newOptions['default_price'] = $option['default_price'];
                                $newOptions['default_price_type'] = $option['default_price_type'];
                                $newOptions['store_price'] = $option['store_price'];
                                $newOptions['store_price_type'] = $option['store_price_type'];
                                $newOptions['price'] = $option['price'];
                                $newOptions['price_type'] = $option['price_type'];

                                $newOptionsVal = array();
                                foreach ($optionValues as $val) {
                                    $copyValues = array();
                                    $newOptionsValues = array(); //array of custom options values

                                    $newOptionsValues['sku'] = $val['sku'];
                                    $newOptionsValues['sort_order'] = $val['sort_order'];
                                    $newOptionsValues['default_title'] = $val['default_title'];
                                    $newOptionsValues['store_title'] = $val['store_title'];
                                    $newOptionsValues['title'] = $val['title'];
                                    $newOptionsValues['default_price'] = $val['default_price'];
                                    $newOptionsValues['default_price_type'] = $val['default_price_type'];
                                    $newOptionsValues['store_price'] = $val['store_price'];
                                    $newOptionsValues['store_price_type'] = $val['store_price_type'];
                                    $newOptionsValues['price'] = $val['price'];
                                    $newOptionsValues['price_type'] = $val['price_type'];

                                    $newOptionsVal[] = ($newOptionsValues);
                                }
                                $newOptions['values'] = $newOptionsVal;



                                if ($product_option->delete())
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

            $this->setData($option)
                    ->setData('product_id', $this->getProduct()->getId())
                    ->setData('store_id', $this->getProduct()->getStoreId());

            if ($this->getData('option_id') == '0') {
                $this->unsetData('option_id');
            } else {
                $this->setId($this->getData('option_id'));
            }
            $isEdit = (bool) $this->getId() ? true : false;

            if ($this->getData('is_delete') == '1') {
                if ($isEdit) {
                    $this->getValueInstance()->deleteValue($this->getId());
                    $this->deletePrices($this->getId());
                    $this->deleteTitles($this->getId());
                    $this->delete();
                }
            } else {
                if ($this->getData('previous_type') != '') {
                    $previousType = $this->getData('previous_type');

                    /**
                     * if previous option has different group from one is came now
                     * need to remove all data of previous group
                     */
                    if ($this->getGroupByType($previousType) != $this->getGroupByType($this->getData('type'))) {

                        switch ($this->getGroupByType($previousType)) {
                            case self::OPTION_GROUP_SELECT:
                                $this->unsetData('values');
                                if ($isEdit) {
                                    $this->getValueInstance()->deleteValue($this->getId());
                                }
                                break;
                            case self::OPTION_GROUP_FILE:
                                $this->setData('file_extension', '');
                                $this->setData('image_size_x', '0');
                                $this->setData('image_size_y', '0');
                                break;
                            case self::OPTION_GROUP_TEXT:
                                $this->setData('max_characters', '0');
                                break;
                            case self::OPTION_GROUP_DATE:
                                break;
                        }
                        if ($this->getGroupByType($this->getData('type')) == self::OPTION_GROUP_SELECT) {
                            $this->setData('sku', '');
                            $this->unsetData('price');
                            $this->unsetData('price_type');
                            if ($isEdit) {
                                $this->deletePrices($this->getId());
                            }
                        }
                    }
                }
                $this->save();
            }
        }//eof foreach()
        return $this;
    }

}
