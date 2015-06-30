<?php
class Queen_Skip_Model_Observer
{
    public function addHiringSkip($observer)
    {
        $orderId = $observer->getEvent()->getOrder()->getId();
        $order = Mage::getModel('sales/order')->load($orderId);
        $orderItems = $order->getItemsCollection()
            ->addAttributeToSelect('*');
        foreach ($orderItems as $item)
        {
            $prod = Mage::getModel('catalog/product')->load($item->getProductId());
            $options = $prod->getOptions();
            if(sizeof($options))
            {
                foreach ($options as $opt)
                {
                    if ($opt->getSku()=='skip-address')
                    {
                        $data = array(
                            'order_id' => $orderId,
                            'product_id' => $item->getProductId(),
                            'email' => $order->getCustomerEmail()
                        );
                        $model = Mage::getModel('queen_skip/skip')->setData($data);
                        try {
                            $model->save()->getId();
                        } catch (Exception $e){}
                    }
                }
            }
        }
    }
}