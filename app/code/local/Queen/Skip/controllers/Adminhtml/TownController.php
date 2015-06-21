<?php
class Queen_Skip_Adminhtml_TownController
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
		$model = Mage::getModel('queen_skip/town');

		if ($id) {
			// Load record
			$model->load($id);

			// Check if record is loaded
			if (!$model->getId()) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('This town type no longer exists.'));
				$this->_redirect('*/*/');

				return;
			}
		}

		$this->_title($model->getId() ? $model->getName() : $this->__('New Town'));

		$data = Mage::getSingleton('adminhtml/session')->getTownData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register('queen_skip', $model);

		$this->_initAction()
		     ->_addBreadcrumb($id ? $this->__('Edit Town') : $this->__('New Town'), $id ? $this->__('Edit Town') : $this->__('New Town'))
		     ->_addContent($this->getLayout()->createBlock('queen_skip/adminhtml_town_edit')->setData('action', $this->getUrl('*/*/save')))
		     ->renderLayout();
	}

	public function saveAction()
	{
		if ($postData = $this->getRequest()->getPost()) {
			$model = Mage::getSingleton('queen_skip/town');
			$model->setData($postData);

			try {
				$model->save();

				Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The town type has been saved.'));
				$this->_redirect('*/*/');

				return;
			}
			catch (Mage_Core_Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this town type.'));
			}

			Mage::getSingleton('adminhtml/session')->setTownData($postData);
			$this->_redirectReferer();
		}
	}

	public function messageAction()
	{
		$data = Mage::getModel('queen_skip/town')->load($this->getRequest()->getParam('id'));
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
			 ->_setActiveMenu('catalog/queen_skip_town')
			 ->_title($this->__('Catalog'))->_title($this->__('Town'))
			 ->_addBreadcrumb($this->__('Catalog'), $this->__('Catalog'))
			 ->_addBreadcrumb($this->__('Town'), $this->__('Town'));

		return $this;
	}

	/**
	 * Check currently called action by permissions for current user
	 *
	 * @return bool
	 */
	protected function _isAllowed()
	{
		return Mage::getSingleton('admin/session')->isAllowed('catalog/queen_skip_town');
	}

}