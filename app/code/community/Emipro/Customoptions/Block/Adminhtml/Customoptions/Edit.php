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
class Emipro_Customoptions_Block_Adminhtml_Customoptions_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {

        parent::__construct();
        $this->_objectId = "entity_id";
        $this->_blockGroup = "customoptions";
        $this->_controller = "adminhtml_customoptions";
        $this->removeButton("delete");
        $this->removeButton("reset");
		$this->removeButton("save");
		if($this->getRequest()->getParam("skulist")==1)
		{
			$lbl="Assign to Product (SKU list)";
		}
		else
		{
			$lbl="Assign to Product";
		}
		
        $this->_addButton("saveandcontinue", array(
            "label" => Mage::helper("customoptions")->__($lbl),
            "onclick" => "saveAndContinueEdit()",
            "class" => "save",
                ), -100);


        $this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');

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
