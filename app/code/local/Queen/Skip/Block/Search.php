<?php
class Queen_Skip_Block_Search extends Mage_Core_Block_Template
{
	public function getAvailableAddress()
	{
		$postcodeanywhere = Mage::registry( 'postcodeanywhere_result' );
		return (null !== $postcodeanywhere) ? Mage::registry( 'postcodeanywhere_result' ) : array();
	}
}