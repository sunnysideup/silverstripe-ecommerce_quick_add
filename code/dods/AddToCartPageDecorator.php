<?php


class AddToCartPageDecorator extends DataObjectDecorator {



	/**
	 *@return DataObjectSet (ProductGroups ONLY)
	 **/
	function DirectChildGroups($filter = "") {
		if($filter) {
			$filter = " AND $filter";
		}
		$stage = '';
		if(Versioned::current_stage() == "Live") {
			$stage = "_Live";
		}
		return DataObject::get("ProductGroup", "\"ParentID\" = ".$this->owner->ID." AND \"ShowInSearch\" = 1 AND ".$this->exclusionString()." $filter");
	}


	/**
	 *@return DataObjectSet (Products ONLY)
	 **/
	function DirectChildProducts($filter = "") {
		if($filter) {
			$filter = " AND $filter";
		}
		$stage = '';
		if(Versioned::current_stage() == "Live") {
			$stage = "_Live";
		}
		return DataObject::get("Product", "ParentID = ".$this->owner->ID." AND \"ShowInSearch\" = 1 AND ".$this->exclusionString()." $filter");
	}


	protected function exclusionString() {
		if($page = DataObject::get_one("AddToCartPage")) {
			return $page->ProductsAndGroupsToBeExcludedWhereString();
		}
		else {
			return " 0 = 0 ";
		}
	}

}
