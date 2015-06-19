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
class Emipro_Customoptions_Block_Adminhtml_Removecustomoptions_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {

        parent::__construct();
        $this->_objectId = "entity_id";
        $this->_blockGroup = "customoptions";
        $this->_controller = "adminhtml_removecustomoptions";
//        $this->_updateButton("save", "label", Mage::helper("customoptions")->__("Save Options"));
        $this->removeButton("delete");
        $this->removeButton("reset");
        $this->removeButton("save");

        $this->_addButton("delete", array(
            "label" => Mage::helper("customoptions")->__("Remove From Product (SKU list)"),
            "onclick" => "deleteOption()",
            "class" => "delete",
                ), -100);


        $this->_formScripts[] = "

							function deleteOption(){
								editForm.submit();

							}
						";
    }

    public function getHeaderText() {
        $data = Mage::registry("customoption_data")->getData();
        if (Mage::registry("customoption_data") && Mage::registry("customoption_data")->getData("option_id")) {

            return Mage::helper("customoptions")->__("%s", $this->htmlEscape($data[0]["title"]));
        } else {

            return Mage::helper("customoptions")->__("Add Item");
        }
    }

}
