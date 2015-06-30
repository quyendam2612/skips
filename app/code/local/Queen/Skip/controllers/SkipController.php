<?php
class Queen_Skip_SkipController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        if( !Mage::getSingleton('customer/session')->isLoggedIn() ) {
            Mage::getSingleton('customer/session')->authenticate($this);
            return;
        }

        $this->loadLayout();
        $navigationBlock = $this->getLayout()->getBlock('customer_account_navigation');
        if ($navigationBlock) {
            $navigationBlock->setActive('skip/skip');
        }

        $this->getLayout()->getBlock('head')->setTitle($this->__('Hiring Skips'));

        $this->renderLayout();
    }

    public function requestAction()
    {
        $session = Mage::getModel('core/session');
        $params = $this->getRequest()->getParams();
        if(isset($params['skip-id']) && isset($params['collect-date']))
        {
            $skipId = $params['skip-id'];
            $collectDate = $params['collect-date'];

            $skip = Mage::getModel('queen_skip/skip')->load($skipId);
            $skip->setCollectDate(strtotime($collectDate));
            $skip->setStatus(1);
            $skip->save();

            $session->addSuccess("Request success");
        } else {
            $session->addError("Missing arguments");
        }
        $this->_redirectReferer();
    }
}