<?php
class Queen_Skip_CollectController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		$orderId = $this->getRequest()->getParam('order_id');
		if ($orderId) {
			$email = Mage::getStoreConfig('queen_skip/skip_options/email');

			$to      = $email;
			$subject = 'Request a collection';
			$message = 'A request for collection just been made for order '.$orderId;
			$headers = 'From: webmaster@example.com' . "\r\n" .
			           'Reply-To: webmaster@example.com' . "\r\n";

			mail($to, $subject, $message, $headers);

			Mage::getModel( 'core/session' )->addSuccess( 'You have requested a collection successfully.' );
			$this->_redirectUrl( Mage::getUrl( "sales/order/view/order_id/$orderId/" ) );
		} else {
			Mage::getModel('core/session')->addError('Collection request cannot be made. Missing order id.');
			$this->_redirectUrl( Mage::getUrl( "sales/order/history" ) );
		}
	}
}