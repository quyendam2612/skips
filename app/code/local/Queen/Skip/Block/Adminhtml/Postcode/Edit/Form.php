<?php
class Queen_Skip_Block_Adminhtml_Postcode_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	/**
	 * Init class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->setId('queen_skip_postcode_form');
		$this->setTitle($this->__('Postcode Information'));
	}

	/**
	 * Setup form fields for inserts/updates
	 *
	 * return Mage_Adminhtml_Block_Widget_Form
	 */
	protected function _prepareForm()
	{
		$model = Mage::registry('queen_skip');

		$form = new Varien_Data_Form(array(
			'id'        => 'edit_form',
			'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
			'method'    => 'post'
		));

		$fieldset = $form->addFieldset('base_fieldset', array(
			'legend'    => Mage::helper('checkout')->__('Postcode Information'),
			'class'     => 'fieldset-wide',
		));

		if ($model->getId()) {
			$fieldset->addField('id', 'hidden', array(
				'name' => 'id',
			));
		}

		$fieldset->addField('town', 'select', array(
			'name'      => 'town',
			'label'     => Mage::helper('checkout')->__('Town'),
			'title'     => Mage::helper('checkout')->__('Town'),
			'required'  => true,
			'values'    => Mage::getModel('queen_skip/town')->getCollection()->toOptionHash()
		));

		$fieldset->addField('district_from', 'text', array(
			'name'      => 'district_from',
			'label'     => Mage::helper('checkout')->__('District From'),
			'title'     => Mage::helper('checkout')->__('District From'),
			'required'  => true,
		));

		$fieldset->addField('district_to', 'text', array(
			'name'      => 'district_to',
			'label'     => Mage::helper('checkout')->__('District To'),
			'title'     => Mage::helper('checkout')->__('District To'),
			'required'  => true,
		));

		$fieldset->addField('postcode', 'text', array(
			'name'      => 'postcode',
			'label'     => Mage::helper('checkout')->__('Area/incode'),
			'title'     => Mage::helper('checkout')->__('Area/incode'),
			'required'  => true,
		));

		$collection = Mage::getModel('queen_skip/permit')->getCollection();
		$options = array(0 => Mage::helper('core')->__('Please select'));
		foreach ($collection as $c)
		{
			$options[$c->getId()] = $c->getAuthority();
		}
		$fieldset->addField('permit', 'select', array(
			'name'      => 'permit',
			'label'     => Mage::helper('checkout')->__('Permit Type'),
			'title'     => Mage::helper('checkout')->__('Permit Type'),
			'required'  => true,
			'values'    => $options,
		));

		$fieldset->addField('drive', 'select', array(
			'name'      => 'drive',
			'label'     => Mage::helper('checkout')->__('Drive Only'),
			'title'     => Mage::helper('checkout')->__('Drive Only'),
			'required'  => true,
			'values'    => array(
				array(
					'value'     => 0,
					'label'     => Mage::helper('core')->__('No'),
				),

				array(
					'value'     => 1,
					'label'     => Mage::helper('core')->__('Yes'),
				),
			),
		));

		$form->setValues($model->getData());
		$form->setUseContainer(true);
		$this->setForm($form);

		return parent::_prepareForm();
	}
}