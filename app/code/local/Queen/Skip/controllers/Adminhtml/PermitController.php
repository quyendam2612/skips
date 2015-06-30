<?php
class Queen_Skip_Adminhtml_PermitController
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
		$model = Mage::getModel('queen_skip/permit');

		if ($id) {
			// Load record
			$model->load($id);

			// Check if record is loaded
			if (!$model->getId()) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('This permit type no longer exists.'));
				$this->_redirect('*/*/');

				return;
			}
		}

		$this->_title($model->getId() ? $model->getName() : $this->__('New Permit Type'));

		$data = Mage::getSingleton('adminhtml/session')->getPermitData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register('queen_skip', $model);

		$this->_initAction()
		     ->_addBreadcrumb($id ? $this->__('Edit Permit Type') : $this->__('New Permit Type'), $id ? $this->__('Edit Permit Type') : $this->__('New Permit Type'))
		     ->_addContent($this->getLayout()->createBlock('queen_skip/adminhtml_permit_edit')->setData('action', $this->getUrl('*/*/save')))
		     ->renderLayout();
	}

	public function saveAction()
	{
		if ($postData = $this->getRequest()->getPost()) {
			$model = Mage::getSingleton('queen_skip/permit');
			$model->setData($postData);

			try {
				$model->save();

				Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The permit type has been saved.'));
				$this->_redirect('*/*/');

                // update custom option 'permit-type' for customoptionmaster product
                Mage::helper('queen_skip')->updatePermitTypeForCustomOptionMaster();

				return;
			}
			catch (Mage_Core_Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this permit type.'));
			}

			Mage::getSingleton('adminhtml/session')->setPermitData($postData);
			$this->_redirectReferer();
		}
	}

	public function messageAction()
	{
		$data = Mage::getModel('queen_skip/permit')->load($this->getRequest()->getParam('id'));
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
			 ->_setActiveMenu('catalog/queen_skip_permit')
			 ->_title($this->__('Catalog'))->_title($this->__('Permit Type'))
			 ->_addBreadcrumb($this->__('Catalog'), $this->__('Catalog'))
			 ->_addBreadcrumb($this->__('Permit Type'), $this->__('Permit Type'));

		return $this;
	}

	/**
	 * Check currently called action by permissions for current user
	 *
	 * @return bool
	 */
	protected function _isAllowed()
	{
		return Mage::getSingleton('admin/session')->isAllowed('catalog/queen_skip_permit');
	}

    public function deleteAction()
    {
        if($this->getRequest()->getParam('id') > 0)
        {
            try
            {
                $testModel = Mage::getModel('queen_skip/permit');
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