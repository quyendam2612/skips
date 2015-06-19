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
ini_set("max_execution_time", 0);
class Emipro_Customoptions_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action {

    public function indexAction() {
    
        $this->loadLayout();
        $this->renderLayout();
    }
	public function saveSkuAction()
	{
		$feature_id = Mage::getModel('catalog/product')->getIdBySku('customoptionmaster');

        $optionId = $this->getRequest()->getParam("id");
        $sku = Mage::getModel("catalog/product_option")->load($optionId)->getData("sku");

        $sql = "select product_id from " . Mage::getConfig()->getTablePrefix() . "catalog_product_option where sku='$sku' and product_id != " . $feature_id;
        $results = Mage::getSingleton('core/resource')->getConnection('core_read')->fetchAll($sql);
        $categoryid = array();
        $data = $this->getRequest()->getPost();

		$skurmv=str_replace(array("\r\n","\r"),",",$data["removesku"]["remove_sku"]);
		$skurmvarray=explode(",",$skurmv);
		     
        if(count($skurmvarray)>0 && !empty($skurmvarray[0]))
        {
			   
			try{
			$optionModel = Mage::getModel("customoptions/customoptionscollection");
				foreach($skurmvarray as $rmsku)
				{
						
						if(!empty($rmsku))
						{
							$product = Mage::getModel('catalog/product');
							$productId = $product->getIdBySku(trim($rmsku));
							if(!empty($productId))
							{
								$optionModel->deleteCustomOption($sku, $productId);
							}
						}
				}
		
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('customoptions')->__('Option was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);
				$this->_redirect('*/*/');
				return;
			}
			catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/adminhtml_remove/edit', array('id' => $this->getRequest()->getParam('id')));
            return;
				}
		}
		$this->_redirect('*/*/editsku', array('id' => $this->getRequest()->getParam('id')));
            return;
	}	
    public function saveAction() {
        $feature_id = Mage::getModel('catalog/product')->getIdBySku('customoptionmaster');

        $optionId = $this->getRequest()->getParam("id");
        $sku = Mage::getModel("catalog/product_option")->load($optionId)->getData("sku");

        $sql = "select product_id from " . Mage::getConfig()->getTablePrefix() . "catalog_product_option where sku='$sku' and product_id != " . $feature_id;
        $results = Mage::getSingleton('core/resource')->getConnection('core_read')->fetchAll($sql);
        $categoryid = array();
        $data = $this->getRequest()->getPost();
        
		if(isset($data["productsku"]))
		{
		
					$skuvalue=str_replace(array("\r\n","\r"),",",$data["productsku"]["sku_list"]);
					$skuarray=explode(",",$skuvalue);
					if(count($skuarray)>0 && !empty($skuarray[0]))
					{
						try
						{		
						$optionModel = Mage::getModel("customoptions/customoptionscollection");
						foreach($skuarray as $prodsku)
						{
								if(!empty($prodsku))
								{
									$product = Mage::getModel('catalog/product');
									$productId = $product->getIdBySku(trim($prodsku));
									if(!empty($productId))
									{
										$optionModel->saveCustomOption($sku, $productId);
									}
								}
						}
						Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('customoptions')->__('Option was successfully saved'));
						Mage::getSingleton('adminhtml/session')->setFormData(false);
						if ($this->getRequest()->getParam('back')) {
							$this->_redirect('*/*/edit', array('id' => $optionId, 'sku' => $sku,"skulist"=>1));
							return;
						}
						$this->_redirect('*/*/');
						return;
					} catch (Exception $e) {
						Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						Mage::getSingleton('adminhtml/session')->setFormData($data);
						$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
						return;
						}
					}
					else
					{
						 $this->_redirect('*/*/edit', array('id' => $optionId, 'sku' => $sku,"skulist"=>1));
							return;
					}
		}
		
        if (isset($data['links'])) {
            $products = Mage::helper('adminhtml/js')->decodeGridSerializedInput($data['links']['products']);
        }
		
        $productsId = array();
        $optionModel = Mage::getModel("customoptions/customoptionscollection");
        try {
            if (!empty($products)) {
                foreach ($products as $key => $value) {

                    $productsId[] = $key;
                    $optionModel->saveCustomOption($sku, $key);
                }
                foreach ($results as $result) {

                    if (!in_array($result["product_id"], $productsId)) {
                        $optionModel->deleteCustomOption($sku, $result["product_id"]);
                    }
                }
            } 
            else {
				
                foreach ($results as $result) {
                    $optionModel->deleteCustomOption($sku, $result["product_id"]);
                }
                
            }
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('customoptions')->__('Option was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(false);
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $optionId, 'sku' => $sku));
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            return;
        }
    }

    public function productsAction() {


        $this->loadLayout();
        $this->getLayout()->getBlock('product.grid')
                ->setSelectedProduct($this->getRequest()->getPost('products_id', null));
        $this->renderLayout();
    }

    public function productsgridAction() {
        $this->loadLayout();
        $this->getLayout()->getBlock('product.grid')
                ->setSelectedProduct($this->getRequest()->getPost('products_id', null));
        $this->renderLayout();
    }

    public function deleteCategoryAction() {
        $data = $this->getRequest()->getParams();
        $categoryid = $data["data"];
        $sku = $data["sku"];
        $optionId = $data["id"];
        try {
            $optionModel = Mage::getModel("customoptions/customoptionscollection");
            $catid = explode(",", $categoryid);

            $optionModel->deleteCategory($sku, $catid);
            $write = mage::getsingleton('core/resource')->getconnection('core_write');
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('customoptions')->__('Option was successfully deleted from category'));
            Mage::getSingleton('adminhtml/session')->setFormData(false);
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/deletecategory', array('data' => $categoryid, "id" => $optionId, "sku" => $sku));
            return;
        }
    }

    public function saveCategoryAction() {
        $data = $this->getRequest()->getPost();
        $optionId = $this->getRequest()->getParam("id");
        $sku = Mage::getModel("catalog/product_option")->load($optionId)->getData("sku");
        if ($this->getRequest()->getParam("del")) {

            $this->_redirect('*/*/deletecategory', array('data' => implode(",", $data["categories"]), "id" => $optionId, "sku" => $sku));
            return;
        }
        $feature_id = Mage::getModel('catalog/product')->getIdBySku('productfeatures');
        $categoryid = array();


        $optionModel = Mage::getModel("customoptions/customoptionscollection");
        try {
            if (isset($data["categories"])) {
                $optionModel->saveToCategory($sku, $data["categories"], $optionId);
            }
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('customoptions')->__('Option was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(false);
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/editcategory', array('id' => $optionId, 'sku' => $sku));
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/editcategory', array('id' => $this->getRequest()->getParam('id')));
            return;
        }
    }

    public function editCategoryAction() {
        $collection = Mage::getModel("catalog/product_option")->getCollection()->addFieldToFilter("main_table.option_id", $this->getRequest()->getParam("id"));
        $collection->getSelect()->join(Mage::getConfig()->getTablePrefix() . 'catalog_product_option_title', 'main_table.option_id =' . Mage::getConfig()->getTablePrefix() . 'catalog_product_option_title.option_id', array("title" => "title"))->group('title');
        Mage::register("customoption_data", $collection);
        $this->loadLayout();
        $this->_setActiveMenu("customoptions/customoptions");
        $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock("customoptions/adminhtml_categoryoptions_edit"))
                ->_addLeft($this->getLayout()->createBlock("customoptions/adminhtml_categoryoptions_edit_tabs"));
        $this->renderLayout();
    }
    public function editSkuAction() {
        Mage::unregister("customoption_data");
        $collection = Mage::getModel("catalog/product_option")->getCollection()->addFieldToFilter("main_table.option_id", $this->getRequest()->getParam("id"));
        $collection->getSelect()->join(Mage::getConfig()->getTablePrefix() . 'catalog_product_option_title', 'main_table.option_id =' . Mage::getConfig()->getTablePrefix() . 'catalog_product_option_title.option_id', array("title" => "title"))->group('title');
        Mage::register("customoption_data", $collection);
        $this->loadLayout();
        $this->_setActiveMenu("customoptions/customoptions");
        $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock("customoptions/adminhtml_removecustomoptions_edit"))
                ->_addLeft($this->getLayout()->createBlock("customoptions/adminhtml_removecustomoptions_edit_tabs"));
        $this->renderLayout();
    }

    public function editAction() {
		Mage::getSingleton("adminhtml/session")->addNotice("Your current setting for max_input_vars is ".ini_get("max_input_vars").". If you want to assign this custom option to more than ".ini_get("max_input_vars"). " products, then please increase this value in php.ini file, otherwise neglect this message.");
        Mage::unregister("customoption_data");
        $collection = Mage::getModel("catalog/product_option")->getCollection()->addFieldToFilter("main_table.option_id", $this->getRequest()->getParam("id"));
        $collection->getSelect()->join(Mage::getConfig()->getTablePrefix() . 'catalog_product_option_title', 'main_table.option_id =' . Mage::getConfig()->getTablePrefix() . 'catalog_product_option_title.option_id', array("title" => "title"))->group('title');
        Mage::register("customoption_data", $collection);
        $this->loadLayout();
        $this->_setActiveMenu("customoptions/customoptions");
        $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock("customoptions/adminhtml_customoptions_edit"))
                ->_addLeft($this->getLayout()->createBlock("customoptions/adminhtml_customoptions_edit_tabs"));
        $this->renderLayout();
    }
    
    

}
