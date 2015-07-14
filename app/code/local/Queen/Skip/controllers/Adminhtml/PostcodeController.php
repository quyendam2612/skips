<?php
class Queen_Skip_Adminhtml_PostcodeController
	extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		// Let's call our initAction method which will set some basic params for each action
		$this->_initAction()
		     ->renderLayout();
	}

	public function newAction()
	{
		// We just forward the new action to a blank edit form
		$this->_forward('edit');
	}

	public function editAction()
	{
		$this->_initAction();

		// Get id if available
		$id  = $this->getRequest()->getParam('id');
		$model = Mage::getModel('queen_skip/postcode');

		if ($id) {
			// Load record
			$model->load($id);

			// Check if record is loaded
			if (!$model->getId()) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('This postcode type no longer exists.'));
				$this->_redirect('*/*/');

				return;
			}
		}

		$this->_title($model->getId() ? $model->getName() : $this->__('New Postcode'));

		$data = Mage::getSingleton('adminhtml/session')->getPostcodeData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register('queen_skip', $model);

		$this->_initAction()
		     ->_addBreadcrumb($id ? $this->__('Edit Postcode') : $this->__('New Postcode'), $id ? $this->__('Edit Postcode') : $this->__('New Postcode'))
		     ->_addContent($this->getLayout()->createBlock('queen_skip/adminhtml_postcode_edit')->setData('action', $this->getUrl('*/*/save')))
		     ->renderLayout();
	}

	public function saveAction()
	{
		if ($postData = $this->getRequest()->getPost()) {
			$model = Mage::getSingleton('queen_skip/postcode');

			try {
                $collection = Mage::getModel('queen_skip/postcode')->getCollection()
                    ->addFieldToFilter('town', array('eq' => $postData['town']))
                    ->addFieldToFilter('district_from', array('eq' => $postData['district_from']))
                    ->addFieldToFilter('district_to', array('eq' => $postData['district_to']));

                if(sizeof($collection))
                {
                    Mage::getSingleton('adminhtml/session')->addError($this->__('Duplicated record. Please check your Town, District from & District to.'));
                    $this->_redirect('*/*/');
                    return;
                }

                $model->setData($postData);
				$model->save();

				Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The postcode type has been saved.'));
				$this->_redirect('*/*/');

				return;
			}
			catch (Mage_Core_Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this postcode type.'));
			}

			Mage::getSingleton('adminhtml/session')->setPostcodeData($postData);
			$this->_redirectReferer();
		}
	}

	public function messageAction()
	{
		$data = Mage::getModel('queen_skip/postcode')->load($this->getRequest()->getParam('id'));
		echo $data->getContent();
	}

	/**
	 * Initialize action
	 *
	 * Here, we set the breadcrumbs and the active menu
	 *
	 * @return Mage_Adminhtml_Controller_Action
	 */
	protected function _initAction()
	{
		$this->loadLayout()
			// Make the active menu match the menu config nodes (without 'children' inbetween)
			 ->_setActiveMenu('catalog/queen_skip_postcode')
			 ->_title($this->__('Catalog'))->_title($this->__('Postcode'))
			 ->_addBreadcrumb($this->__('Catalog'), $this->__('Catalog'))
			 ->_addBreadcrumb($this->__('Postcode'), $this->__('Postcode'));

		return $this;
	}

	/**
	 * Check currently called action by permissions for current user
	 *
	 * @return bool
	 */
	protected function _isAllowed()
	{
		return Mage::getSingleton('admin/session')->isAllowed('catalog/queen_skip_postcode');
	}

    public function deleteAction()
    {
        if($this->getRequest()->getParam('id') > 0)
        {
            try
            {
                $testModel = Mage::getModel('queen_skip/postcode');
                $testModel->setId($this->getRequest()
                    ->getParam('id'))
                    ->delete();
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess('Delete successfully');
                $this->_redirect('*/*/');
            }
            catch (Exception $e)
            {
                Mage::getSingleton('adminhtml/session')
                    ->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

}