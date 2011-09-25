<?php

/**
 *
 *@author nicolaas [at] sunnysideup.co.nz
 *
 **/

class AddToCartPage extends Page {

	public static $icon = "ecommerce_quick_add/images/treeicons/AddToCartPage";

	public function canCreate($member = null){
		return !DataObject::get_one("AddToCartPage", "\"ClassName\" = 'AddToCartPage'");
	}

	public static $many_many = array(
		"ExcludedProductsAndGroups" => "SiteTree",
	);

	public function ProductsAndGroupsToBeExcludedArray() {
		$components = $this->getManyManyComponents('ExcludedProductsAndGroups');
		if($components && $components->count()) {
			return $components->column("ID");
		}
		else {
			return array(0 => 0);
		}
	}

	public function ProductsAndGroupsToBeExcludedWhereString() {
		$array = $this->ProductsAndGroupsToBeExcludedArray();
		$stage = '';
		if(Versioned::current_stage() == "Live") {
			$stage = "_Live";
		}
		return "\"SiteTree$stage\".\"ID\" NOT IN (".implode(",", $array).")";
	}


}

class AddToCartPage_Controller extends Page_Controller {


	function init() {
		parent::init();
		Requirements::themedCSS('Products');
	}

	function TopLevelGroups() {
		if($dos = DataObject::get("ProductGroup", "\"ParentID\" = 0 AND ".$this->ProductsAndGroupsToBeExcludedWhereString())) {
			return $dos;
		}
		else {
			$stage = '';
			if(Versioned::current_stage() == "Live") {
				$stage = "_Live";
			}
			if($dos = DataObject::get("ProductGroup", "ParentPage.ID = 0 AND ".$this->ProductsAndGroupsToBeExcludedWhereString(), "", "INNER JOIN SiteTree$stage AS ParentPage ON SiteTree$stage.ParentID = ParentPage.ID")) {
				return $dos;
			}
			else {
				return DataObject::get("ProductGroup", "GrandParentPage.ID = 0 AND ".$this->ProductsAndGroupsToBeExcludedWhereString(), "", "INNER JOIN SiteTree$stage AS ParentPage ON SiteTree$stage.ParentID = ParentPage.ID INNER JOIN SiteTree$stage AS GrandParentPage ON ParentPage.ParentID = GrandParentPage.ID");
			}
		}
	}

}

