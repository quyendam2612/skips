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
class Emipro_Customoptions_Block_Adminhtml_Customoptions_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId("customoptionsGrid");
        $this->setDefaultSort("entity_id");
        $this->setDefaultDir("DESC");
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
		$feature_id = Mage::getModel('catalog/product')->getIdBySku('customoptionmaster');
        $collection = Mage::getModel("catalog/product_option")->getCollection()->addFieldToFilter("main_table.product_id",$feature_id);
        $collection->getSelect()->join(Mage::getConfig()->getTablePrefix() . 'catalog_product_option_title', 'main_table.option_id =' . Mage::getConfig()->getTablePrefix() . 'catalog_product_option_title.option_id', array("title" => "title"))->group("main_table.option_id");
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
		$optionType=array();
		$types=Mage::getSingleton('adminhtml/system_config_source_product_options_type')->toOptionArray();
		foreach($types as $type)
		{
			foreach($type as $key => $value)
			{
				foreach($value as $k => $v)
				{
					$optionType[$v["value"]]=$v["label"];

				}
			}
		}
        $this->addColumn("option_id", array(
            "header" => Mage::helper("customoptions")->__("ID"),
            "align" => "right",
            "width" => "10px",
            "type" => "number",
            "index" => "option_id",
        ));
        $this->addColumn("title", array(
            "header" => Mage::helper("customoptions")->__("Title"),
            "align" => "center",
            "width" => "400px",
            "type" => "text",
            "index" => "title",
        ));
        $this->addColumn("sku", array(
            "header" => Mage::helper("customoptions")->__("SKU"),
            "align" => "left",
            "width" => "200px",
            "type" => "text",
            "index" => "sku",
        ));

        $this->addColumn("type", array(
            "header" => Mage::helper("customoptions")->__("Type"),
            "align" => "left",
            "width" => "50px",
            "type" => "options",
            "index" => "type",
            "options"=>$optionType,
        ));
        $this->addColumn("action_product", array(
            "header" => Mage::helper("customoptions")->__("Action"),
            "index" => "type",
            "width" => "100px",
            "renderer"=>"Emipro_Customoptions_Block_Adminhtml_Customoptions_Grid_Renderer_EditProduct",
        ));
        $this->addColumn("action_sku", array(
            "header" => Mage::helper("customoptions")->__("Action"),
            "index" => "type",
            "width" => "100px",
            "renderer"=>"Emipro_Customoptions_Block_Adminhtml_Customoptions_Grid_Renderer_Sku",
        ));
        $this->addColumn("action_category", array(
            "header" => Mage::helper("customoptions")->__("Action"),
            "index" => "type",
            "width" => "100px",
            "renderer"=>"Emipro_Customoptions_Block_Adminhtml_Customoptions_Grid_Renderer_EditCategory",
        ));
        $this->addColumn("action_rmvsku", array(
            "header" => Mage::helper("customoptions")->__("Action"),
            "index" => "type",
            "width" => "100px",
            "renderer"=>"Emipro_Customoptions_Block_Adminhtml_Customoptions_Grid_Renderer_RemoveProduct",
        ));
        return parent::_prepareColumns();
    }

}
