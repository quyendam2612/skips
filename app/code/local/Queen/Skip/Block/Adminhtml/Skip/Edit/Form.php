<?php
class Queen_Skip_Block_Adminhtml_Skip_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	/**
	 * Init class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->setId('queen_skip_skip_form');
		$this->setTitle($this->__('Collection Information'));
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
			'legend'    => Mage::helper('checkout')->__('Collection Information'),
			'class'     => 'fieldset-wide',
		));

		if ($model->getId()) {
			$fieldset->addField('id', 'hidden', array(
				'name' => 'id',
			));
		}

        $fieldset->addField('product_id', 'text', array(
            'name'      => 'product_id',
            'label'     => Mage::helper('core')->__('Product ID'),
            'title'     => Mage::helper('core')->__('Product ID'),
            'required'  => true,
        ));

        $fieldset->addField('order_id', 'text', array(
            'name'      => 'order_id',
            'label'     => Mage::helper('core')->__('Order ID'),
            'title'     => Mage::helper('core')->__('Order ID'),
            'required'  => true,
        ));

        $fieldset->addField('email', 'text', array(
            'name'      => 'email',
            'label'     => Mage::helper('core')->__('Customer Email'),
            'title'     => Mage::helper('core')->__('Customer Email'),
            'required'  => true,
            'class'     => 'validate-email'
        ));

        $statusOptions = array(
            '0' => 'Working',
            '1' => 'Requested',
            '2'  => 'Collected'
        );
        $fieldset->addField('status', 'select', array(
            'name'      => 'status',
            'label'     => Mage::helper('core')->__('Status'),
            'title'     => Mage::helper('core')->__('Status'),
            'required'  => false,
            'type'      => '',
            'options'   => $statusOptions
        ));

        $fieldset->addField('collect_date', 'date', array(
            'name'      => 'collect_date',
            'label'     => Mage::helper('core')->__('Collect Date'),
            'title'     => Mage::helper('core')->__('Collect Date'),
            'required'  => true,
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'format'    => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
        ));


        $form->setValues($model->getData());
		$form->setUseContainer(true);
		$this->setForm($form);

		return parent::_prepareForm();
	}
}