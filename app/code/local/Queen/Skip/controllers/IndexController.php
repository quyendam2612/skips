<?php
class Queen_Skip_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		$selectedAdd = $this->getRequest()->getParam('selected-address');
		Mage::getModel('core/session')->setSelectedAddress($selectedAdd);
		$this->_redirectUrl(Mage::getUrl(Mage::getStoreConfig('queen_skip/skip_options/skip_page_url')));
	}
}