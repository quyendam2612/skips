<?php
class Queen_Skip_SearchController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		$session = Mage::getModel('core/session');
		$reqPos = $this->getRequest()->getParam('postcode-search');
		if(strlen(str_replace(" ", "", $reqPos))!=6)
		{
			$session->addError('Postcode must be 6 characters (space is not counted).');
			goto end;
		}

		if (Mage::helper('queen_skip')->checkPostInternal($reqPos))
		{
			Mage::register(
				'postcodeanywhere_result',
				Mage::helper('queen_skip')->checkPostcodeAnywhere($reqPos)
			);
		} else {
			$session->addError('No address available');
		}

		end:
		$this->loadLayout();
		$this->renderLayout();
	}
}