<?php
class Queen_Skip_Block_Adminhtml_Skip_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();

		// Set some defaults for our grid
		$this->setDefaultSort('id');
		$this->setId('queen_skip_skip_grid');
		$this->setDefaultDir('asc');
		$this->setSaveParametersInSession(true);
	}

	protected function _getCollectionClass()
	{
		// This is the model we are using for the grid
		return 'queen_skip/skip_collection';
	}

	protected function _prepareCollection()
	{
		// Get and set our collection for the grid
		$collection = Mage::getResourceModel($this->_getCollectionClass());
        $collection->getSelect()->joinLeft(
            array('sfo' => 'sales_flat_order'),
            'main_table.order_id = sfo.entity_id',
            array('increment_id')
        );
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

		$this->addColumn('product_id',
			array(
				'header'=> $this->__('Product ID'),
				'index' => 'product_id'
			)
		);

		$this->addColumn('increment_id',
			array(
				'header'=> $this->__('Order ID'),
				'index' => 'increment_id'
			)
		);

        $this->addColumn('sfo.order_id',
            array(
                'header' => Mage::helper('core')->__('View Order'),
                'width' => '100',
                'type' => 'action',
                'getter' => 'getOrderId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('core')->__('View'),
                        'url' => array('base'=> 'adminhtml/sales_order/view'),
                        'field' => 'order_id',
                        'target' => '_blank'
                    )
                ),
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'is_system' => true
            )
        );

        $this->addColumn('email',
            array(
                'header'=> $this->__('Customer Email'),
                'index' => 'email'
            )
        );

        $this->addColumn('status',
            array(
                'header'=> $this->__('Status (WORKING=0,REQUESTED=1,COLLECTED=2)'),
                'index' => 'status',
                'filter_index'  => '`main_table`.`status`'
            )
        );

        $this->addColumn('collect_date',
            array(
                'header'=> $this->__('Collect Date'),
                'index' => 'collect_date'
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