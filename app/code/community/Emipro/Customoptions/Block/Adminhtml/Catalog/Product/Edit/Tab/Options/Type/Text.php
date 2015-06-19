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

class Emipro_Customoptions_Block_Adminhtml_Catalog_Product_Edit_Tab_Options_Type_Text extends
    Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Options_Type_Text
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('customoptions/text.phtml');
    }
}
