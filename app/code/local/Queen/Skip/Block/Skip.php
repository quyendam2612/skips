<?php
class Queen_Skip_Block_Skip extends Mage_Core_Block_Template
{
    public function getHiringSkips()
    {
        $session = Mage::getSingleton('customer/session');
        $customerEmail = $session->getCustomer()->getEmail();

        $collection = Mage::getModel('queen_skip/skip')->getCollection()
            ->addFieldToFilter('email', $customerEmail);
        $result = array();
        foreach ($collection as $c)
        {
            switch($c->getStatus()) {
                case 1:
                    $status = "REQUESTED";
                    break;
                case 2:
                    $status = "COLLECTED";
                    break;
                default:
                    $status = "WORKING";
                    break;
            }
            $prod = Mage::getModel('catalog/product')->load($c->getProductId());
            $order = Mage::getModel('sales/order')->load($c->getOrderId());
            $result[$c->getId()] = array(
                'product_name'  => $prod->getName(),
                'order_id'      => $order->getIncrementId(),
                'status'        => $status,
                'collect_date'  => ($c->getCollectDate()) ? date('m/d/Y', $c->getCollectDate()) : null
            );
        }
        return $result;
    }
}