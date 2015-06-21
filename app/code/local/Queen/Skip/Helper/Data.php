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

	public function checkPostInternal($reqPos)
	{
		$postcodes = Mage::getModel('queen_skip/postcode')->getCollection();
		foreach($postcodes as $p)
		{
			$from = $p->getDistrictFrom();
			$to = $p->getDistrictTo();
			for($i=$from; $i<=$to; $i++)
			{
				$tmp = $this->getTownCode($p->getTown()).$i;
				if (strpos(strtolower($reqPos), strtolower($tmp))===0) return true;
			}
		}
		return false;
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
}