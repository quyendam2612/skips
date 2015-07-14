<?php
class Queen_Skip_Model_Sales_Total_Quote_Subtotal extends Mage_Tax_Model_Sales_Total_Quote_Subtotal
{
    protected function _totalBaseCalculation($item, $request)
    {
        $calc = $this->_calculator;
        $request->setProductClassId($item->getProduct()->getTaxClassId());
        $rate = $calc->getRate($request);
        $qty = $item->getTotalQty();

        $price = $taxPrice = $this->_calculator->round($item->getCalculationPriceOriginal());
        $basePrice = $baseTaxPrice = $this->_calculator->round($item->getBaseCalculationPriceOriginal());
        $subtotal = $taxSubtotal = $this->_calculator->round($item->getRowTotal());
        $baseSubtotal = $baseTaxSubtotal = $this->_calculator->round($item->getBaseRowTotal());

        // if we have a custom price, determine if tax should be based on the original price
        $taxOnOrigPrice = !$this->_helper->applyTaxOnCustomPrice($this->_store) && $item->hasCustomPrice();
        if ($taxOnOrigPrice) {
            $origSubtotal = $item->getOriginalPrice() * $qty;
            $baseOrigSubtotal = $item->getBaseOriginalPrice() * $qty;
        }

        $item->setTaxPercent($rate);
        if ($this->_config->priceIncludesTax($this->_store)) {
            if ($this->_sameRateAsStore($request)) {
                // determine which price to use when we calculate the tax
                if ($taxOnOrigPrice) {
                    $taxable = $origSubtotal;
                    $baseTaxable = $baseOrigSubtotal;
                } else {
                    $taxable = $subtotal;
                    $baseTaxable = $baseSubtotal;
                }
                // HACK TO SUBTRACT permit-type PRICE
                $permitPrice = 0;
                $options = $item->getProduct()
                    ->getTypeInstance(true)
                    ->getOrderOptions($item->getProduct());
                if (isset($options['options']))
                {
                    foreach ($options['options'] as $opt)
                    {
                        if (@$opt['label'] == 'Permit Type')
                        {
                            $selectedOptId = $opt['option_id'];
                            $selectedOptVal = $opt['option_value'];

                            $resource = Mage::getSingleton('core/resource');
                            $readConnection = $resource->getConnection('core_read');
                            $optionTypePriceTable = $resource->getTableName('catalog_product_option_type_price');
                            $query = 'SELECT price FROM ' . $optionTypePriceTable . ' WHERE option_type_id = ' . $selectedOptId;
                            $result = $readConnection->fetchOne($query);
                            $permitPrice = floatval($result);
                        }
                    }
                }

                if ($permitPrice)
                {
                    $taxable -= $qty*$permitPrice;
                    $baseTaxable -= $qty*$permitPrice;
                }
                // END HACKING
                
                $rowTaxExact     = $calc->calcTaxAmount($taxable, $rate, true, false);
                $rowTax          = $this->_deltaRound($rowTaxExact, $rate, true);
                $baseRowTaxExact = $calc->calcTaxAmount($baseTaxable, $rate, true, false);
                $baseRowTax      = $this->_deltaRound($baseRowTaxExact, $rate, true, 'base');

                $taxPrice        = $price;
                $baseTaxPrice    = $basePrice;
                $taxSubtotal = $subtotal;
                $baseTaxSubtotal = $baseSubtotal;

                $subtotal          = $subtotal - $rowTax;
                $baseSubtotal      = $baseSubtotal - $baseRowTax;

                $price = $calc->round($subtotal / $qty);
                $basePrice = $calc->round($baseSubtotal / $qty);

                $isPriceInclTax  = true;

                //Save the tax calculated
                $item->setRowTax($rowTax);
                $item->setBaseRowTax($baseRowTax);

            } else {
                $storeRate = $calc->getStoreRate($request, $this->_store);
                if ($taxOnOrigPrice) {
                    // the merchant already provided a customer's price that includes tax
                    $taxPrice     = $price;
                    $baseTaxPrice = $basePrice;
                    // determine which price to use when we calculate the tax
                    $taxable      = $this->_calculatePriceInclTax($item->getOriginalPrice(), $storeRate, $rate);
                    $baseTaxable  = $this->_calculatePriceInclTax($item->getBaseOriginalPrice(), $storeRate, $rate);
                } else {
                    // determine the customer's price that includes tax
                    $taxPrice     = $this->_calculatePriceInclTax($price, $storeRate, $rate);
                    $baseTaxPrice = $this->_calculatePriceInclTax($basePrice, $storeRate, $rate);
                    // determine which price to use when we calculate the tax
                    $taxable      = $taxPrice;
                    $baseTaxable  = $baseTaxPrice;
                }
                // determine the customer's tax amount based on the taxable price
                $tax             = $this->_calculator->calcTaxAmount($taxable, $rate, true, true);
                $baseTax         = $this->_calculator->calcTaxAmount($baseTaxable, $rate, true, true);
                // determine the customer's price without taxes
                $price = $taxPrice - $tax;
                $basePrice = $baseTaxPrice - $baseTax;
                // determine subtotal amounts
                $taxable        *= $qty;
                $baseTaxable    *= $qty;
                $taxSubtotal     = $taxPrice * $qty;
                $baseTaxSubtotal = $baseTaxPrice * $qty;
                // HACK TO SUBTRACT permit-type PRICE
                $permitPrice = 0;
                $options = $item->getProduct()
                    ->getTypeInstance(true)
                    ->getOrderOptions($item->getProduct());
                if (isset($options['options']))
                {
                    foreach ($options['options'] as $opt)
                    {
                        if (@$opt['label'] == 'Permit Type')
                        {
                            $selectedOptId = $opt['option_id'];
                            $selectedOptVal = $opt['option_value'];

                            $resource = Mage::getSingleton('core/resource');
                            $readConnection = $resource->getConnection('core_read');
                            $optionTypePriceTable = $resource->getTableName('catalog_product_option_type_price');
                            $query = 'SELECT price FROM ' . $optionTypePriceTable . ' WHERE option_type_id = ' . $selectedOptId;
                            $result = $readConnection->fetchOne($query);
                            $permitPrice = floatval($result);
                        }
                    }
                }

                if ($permitPrice)
                {
                    $taxable -= $qty*$permitPrice;
                    $baseTaxable -= $qty*$permitPrice;
                }
                // END HACKING

                $rowTax =
                    $this->_deltaRound($calc->calcTaxAmount($taxable, $rate, true, false), $rate, true);
                $baseRowTax =
                    $this->_deltaRound($calc->calcTaxAmount($baseTaxable, $rate, true, false), $rate, true, 'base');
                $subtotal = $taxSubtotal - $rowTax;
                $baseSubtotal = $baseTaxSubtotal - $baseRowTax;
                $isPriceInclTax  = true;

                $item->setRowTax($rowTax);
                $item->setBaseRowTax($baseRowTax);
            }
        } else {
            // determine which price to use when we calculate the tax
            if ($taxOnOrigPrice) {
                $taxable = $origSubtotal;
                $baseTaxable = $baseOrigSubtotal;
            } else {
                $taxable = $subtotal;
                $baseTaxable = $baseSubtotal;
            }
            // HACK TO SUBTRACT permit-type PRICE
            $permitPrice = 0;
            $options = $item->getProduct()
                ->getTypeInstance(true)
                ->getOrderOptions($item->getProduct());
            if (isset($options['options']))
            {
                foreach ($options['options'] as $opt)
                {
                    if (@$opt['label'] == 'Permit Type')
                    {
                        $selectedOptId = $opt['option_id'];
                        $selectedOptVal = $opt['option_value'];

                        $resource = Mage::getSingleton('core/resource');
                        $readConnection = $resource->getConnection('core_read');
                        $optionTypePriceTable = $resource->getTableName('catalog_product_option_type_price');
                        $query = 'SELECT price FROM ' . $optionTypePriceTable . ' WHERE option_type_id = ' . $selectedOptId;
                        $result = $readConnection->fetchOne($query);
                        $permitPrice = floatval($result);
                    }
                }
            }

            if ($permitPrice)
            {
                $taxable -= $qty*$permitPrice;
                $baseTaxable -= $qty*$permitPrice;
            }
            // END HACKING

            $appliedRates = $this->_calculator->getAppliedRates($request);
            $rowTaxes = array();
            $baseRowTaxes = array();
            foreach ($appliedRates as $appliedRate) {
                $taxId = $appliedRate['id'];
                $taxRate = $appliedRate['percent'];
                $rowTaxes[] = $this->_deltaRound($calc->calcTaxAmount($taxable, $taxRate, false, false), $taxId, false);
                $baseRowTaxes[] = $this->_deltaRound(
                    $calc->calcTaxAmount($baseTaxable, $taxRate, false, false), $taxId, false, 'base');

            }

            $taxSubtotal     = $subtotal + array_sum($rowTaxes);
            $baseTaxSubtotal = $baseSubtotal + array_sum($baseRowTaxes);

            $taxPrice        = $calc->round($taxSubtotal/$qty);
            $baseTaxPrice    = $calc->round($baseTaxSubtotal/$qty);

            $isPriceInclTax = false;
        }

        if ($item->hasCustomPrice()) {
            /**
             * Initialize item original price before declaring custom price
             */
            $item->getOriginalPrice();
            $item->setCustomPrice($price);
            $item->setBaseCustomPrice($basePrice);
        } else {
            $item->setConvertedPrice($price);
        }
        $item->setPrice($basePrice);
        $item->setBasePrice($basePrice);
        $item->setRowTotal($subtotal);
        $item->setBaseRowTotal($baseSubtotal);
        $item->setPriceInclTax($taxPrice);
        $item->setBasePriceInclTax($baseTaxPrice);
        $item->setRowTotalInclTax($taxSubtotal);
        $item->setBaseRowTotalInclTax($baseTaxSubtotal);
        $item->setTaxableAmount($taxable);
        $item->setBaseTaxableAmount($baseTaxable);
        $item->setIsPriceInclTax($isPriceInclTax);
        if ($this->_config->discountTax($this->_store)) {
            $item->setDiscountCalculationPrice($taxSubtotal / $qty);
            $item->setBaseDiscountCalculationPrice($baseTaxSubtotal / $qty);
        } elseif ($isPriceInclTax) {
            $item->setDiscountCalculationPrice($subtotal / $qty);
            $item->setBaseDiscountCalculationPrice($baseSubtotal / $qty);
        }
        return $this;
    }
}