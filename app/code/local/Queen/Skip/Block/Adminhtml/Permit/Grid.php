<?php
class Queen_Skip_Block_Adminhtml_Permit_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();

		// Set some defaults for our grid
		$this->setDefaultSort('id');
		$this->setId('queen_skip_permit_grid');
		$this->setDefaultDir('asc');
		$this->setSaveParametersInSession(true);
	}

	protected function _getCollectionClass()
	{
		// This is the model we are using for the grid
		return 'queen_skip/permit_collection';
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

		$this->addColumn('authority',
			array(
				'header'=> $this->__('Authority'),
				'index' => 'authority'
			)
		);

		$this->addColumn('name',
			array(
				'header'=> $this->__('Name'),
				'index' => 'name'
			)
		);

		$this->addColumn('duration',
			array(
				'header'=> $this->__('Duration (days)'),
				'index' => 'duration'
			)
		);

		$this->addColumn('price',
			array(
				'header'=> $this->__('Price'),
				'index' => 'price'
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