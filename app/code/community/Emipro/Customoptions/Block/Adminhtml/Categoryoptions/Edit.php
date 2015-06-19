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
class Emipro_Customoptions_Block_Adminhtml_Categoryoptions_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {

        parent::__construct();
        $this->_objectId = "entity_id";
        $this->_blockGroup = "customoptions";
        $this->_controller = "adminhtml_categoryoptions";
        ;
        $this->_removeButton('delete');
        $this->_removeButton('save');
        $this->_removeButton('reset');
        $this->_addButton("saveandcontinue", array(
            "label" => Mage::helper("customoptions")->__("Save Option to Category"),
            "onclick" => "saveAndContinueEdit()",
            "class" => "save",
                ), -100);
        $this->_addButton("deletecategory", array(
            "label" => Mage::helper("customoptions")->__("Delete Option from Category"),
            "onclick" => "deleteCat()",
            "class" => "delete",
                ), -100);



        $this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');

							}
							function deleteCat(){
								editForm.submit($('edit_form').action+'del/delete/');

							}
						";
    }

    public function getHeaderText() {
        $data = Mage::registry("customoption_data")->getData();
        if (Mage::registry("customoption_data") && $data[0]["title"]) {

            return Mage::helper("customoptions")->__("%s", $this->htmlEscape($data[0]["title"]));
        } else {

            return Mage::helper("customoptions")->__("Add Item");
        }
    }

}
