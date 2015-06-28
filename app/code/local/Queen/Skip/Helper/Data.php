<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/18/15
 * Time: 8:19 PM
 */ 
class Queen_Skip_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getSearchUrl()
	{
		return Mage::getUrl('skip/search/index');
	}

	protected function getTownCode($townId)
	{
		$town = Mage::getModel('queen_skip/town')->load($townId);
		if(is_object($town)) {
			return $town->getCode();
		} else {
			return null;
		}
	}

    protected function _getPermitTypeIdFromPostcode($postcode)
    {
        $postcodes = Mage::getModel('queen_skip/postcode')->getCollection();
        foreach($postcodes as $p)
        {
            $from = $p->getDistrictFrom();
            $to = $p->getDistrictTo();
            for($i=$from; $i<=$to; $i++)
            {
                $tmp = $this->getTownCode($p->getTown()).$i;
                if (strpos(strtolower($postcode), strtolower($tmp))===0) return $p->getPermit();
            }
        }
        return 0;
    }

	public function checkPostInternal($reqPos)
	{
		return $this->_getPermitTypeIdFromPostcode($reqPos);
	}

	public function checkPostcodeAnywhere($reqPos)
	{
		$serviceKey = Mage::getStoreConfig('queen_skip/postcodeanywhere/key');
		$country = Mage::getStoreConfig('queen_skip/postcodeanywhere/country');
		$lang = Mage::getStoreConfig('queen_skip/postcodeanywhere/language');
		$searchTerm = urlencode($reqPos);
		$url = "http://services.postcodeanywhere.co.uk/CapturePlus/Interactive/Find/v2.10/json.ws?Key=$serviceKey&SearchTerm=$searchTerm&LastId=&SearchFor=PostalCodes&Country=$country&LanguagePreference=$lang&MaxSuggestions=&MaxResults=";

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$result = json_decode($result);
		$return = array();
		foreach ($result as $r)
		{
			$return[] = $r->Text;
		}

		return $return;
	}

    public function getSelectedPermitType($prodId)
    {
        $session = Mage::getModel('core/session');
        $add = explode(',', $session->getSelectedAddress());
        $postcode = str_replace(' ', '', $add[0]);
        $permitId = $this->_getPermitTypeIdFromPostcode($postcode);

        $permit = Mage::getModel('queen_skip/permit')->load($permitId);
        $permitLabel = $permit->getAuthority();

        $prod = Mage::getModel('catalog/product')->load($prodId);
        foreach ($prod->getOptions() as $opt)
        {
            if ($opt->getSku()=='permit-type')
            {
                foreach($opt->getValues() as $key => $val)
                {
                    if ($val->getTitle()==$permitLabel)
                    {
                        return $key;
                    }
                }
            }

        }
        return 0;
    }

    public function updatePermitTypeForCustomOptionMaster()
    {
        $sku = 'customoptionmaster';
        $pro = Mage::getModel('catalog/product')->loadByAttribute('sku', $sku);
        $pro->load($pro->getId());

        $permitOption = null;
        foreach ($pro->getOptions() as $opt)
        {
            if($opt->getSku()=='permit-type')
            {
                $permitOption = $opt;
                foreach($opt->getValues() as $val)
                {
                    $val->delete();
                }
            }
        }

        $permits = Mage::getModel('queen_skip/permit')->getCollection();
        foreach ($permits as $p)
        {
            $value = Mage::getModel('catalog/product_option_value');
            $value->setOption($permitOption)
                ->setTitle($p->getAuthority())
                ->setPriceType('fixed')
                ->setPrice($p->getPrice())
                ->setOptionId($permitOption->getId());
            $value->save();
        }
    }
}