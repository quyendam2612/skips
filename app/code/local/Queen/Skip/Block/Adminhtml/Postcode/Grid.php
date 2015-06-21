<?php
class Queen_Skip_Block_Adminhtml_Postcode_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();

		// Set some defaults for our grid
		$this->setDefaultSort('id');
		$this->setId('queen_skip_postcode_grid');
		$this->setDefaultDir('asc');
		$this->setSaveParametersInSession(true);
	}

	protected function _getCollectionClass()
	{
		// This is the model we are using for the grid
		return 'queen_skip/postcode_collection';
	}

	protected function _prepareCollection()
	{
		// Get and set our collection for the grid
		$collection = Mage::getResourceModel($this->_getCollectionClass());
		$this->setCollection($collection);

		return parent::_prepareCollection();
	}

	protected function _prepareColumns()
	{
		// Add the columns that should appear in the grid
		$this->addColumn('id',
			array(
				'header'=> $this->__('ID'),
				'align' =>'right',
				'width' => '50px',
				'index' => 'id'
			)
		);

		$this->addColumn('town',
			array(
				'header'=> $this->__('Town'),
				'index' => 'town'
			)
		);

		$this->addColumn('district_from',
			array(
				'header'=> $this->__('District From'),
				'index' => 'district_from'
			)
		);

		$this->addColumn('district_to',
			array(
				'header'=> $this->__('District To'),
				'index' => 'district_to'
			)
		);

		$this->addColumn('postcode',
			array(
				'header'=> $this->__('Area/incode'),
				'index' => 'postcode'
			)
		);

		$this->addColumn('permit',
			array(
				'header'=> $this->__('Permit Type'),
				'index' => 'permit'
			)
		);

		$this->addColumn('drive',
			array(
				'header'=> $this->__('Drive Only'),
				'index' => 'drive'
			)
		);

		return parent::_prepareColumns();
	}

	public function getRowUrl($row)
	{
		// This is where our row data will link to
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}