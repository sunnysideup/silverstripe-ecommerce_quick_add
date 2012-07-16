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


}

class AddToCartPage_Controller extends Page_Controller {


	function init() {
		parent::init();
		Requirements::themedCSS('Products');
		Requirements::themedCSS('AddToCartPage');
		Requirements::javascript(THIRDPARTY_DIR."/jquery/jquery.js");
		//Requirements::block(THIRDPARTY_DIR."/jquery/jquery.js");
		//Requirements::javascript(Director::protocol()."ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js");
		Requirements::javascript(THIRDPARTY_DIR."/jquery-form/jquery.form.js");
		Requirements::javascript("ecommerce_quick_add/javascript/AddToCartPage.js");
	}

	function AddMemberToCartForm(){
		$member = Member::currentMember();
		$order = ShoppingCart::current_order();
		$currentCustomer = $order->CreateOrReturnExistingMember(false);
		if($member && $member->IsShopAdmin()) {
			$fields = new FieldSet(
				new HeaderField("SelectCustomer", _t("AddToCartPage.SELECTCUSTOMER", "Select Customer")),
				new DropdownField("MemberID", _t("AddToCartPage.CUSTOMER", "Customer"), EcommerceRole::list_of_customers()),
				new ReadonlyField("CurrentMember", _t("AddToCartPage.CURRENTCUSTOMER", "Current Customer"), $currentCustomer->getTitle())
			);
			$actions = new FieldSet(
				new FormAction("addmembertocartform_add", _t("AddToCartPage.ADDMEMBERTOORDER", "Add customer to current order"))
			);
			$validator = new RequiredFields(array("MemberID"));
			return new Form($this, "AddMemberToCartForm", $fields, $actions, $validator);
		}
	}

	function addmembertocartform_add($data, $form) {
		$member = Member::currentMember();
		if($member && $member->IsShopAdmin()) {
			$order = ShoppingCart::current_order();
			$member = DataObject::get_by_id("Member", intval($data["MemberID"]));
			if($member) {
				$order->MemberID = $member->ID;
				$order->write();
				$response = $member->getTitle()." "._t("AddToCartPage.ADDED", "Added");
				$status = "good";
			}
			else {
				$response = _t("AddToCartPage.CUSTOMERNOTADDED", "Customer could not be added");
				$status = "bad";
			}
			if(Director::is_ajax()) {
				return $response;
			}
			else {
				$form->setMessage($response, $status);
				Director::redirectBack();
			}
		}
	}

	function QuickAddToCartForm(){
		$fields = new FieldSet(
			new HeaderField("SelectCustomer", _t("AddToCartPage.ADDPRODUCTS", "Add Products")),
			new HiddenField("BuyableID"),
			new HiddenField("BuyableClassName"),
			new HiddenField("Version"),
			new BuyableSelectField("FindBuyable", _t("AddToCartPage.PRODUCT", "Product")),
			new NumericField("Quantity", _t("AddToCartPage.QUANTITY", "Quantity"), 1)
		);
		$actions = new FieldSet(
			new FormAction("quickaddtocartform_add", _t("AddToCartPage.ADD", "Add"))
		);
		$validator = new RequiredFields(array("Quantity"));
		return new Form($this, "QuickAddToCartForm", $fields, $actions, $validator);
	}

	function quickaddtocartform_add($data, $form) {
		$buyableID = intval($data["BuyableID"]);
		$buyableClassName = Convert::raw2sql($data["BuyableClassName"]);
		$version = Intval($data["Version"]);
		$quantity = floatval($data["Quantity"]);
		$status = "bad";
		$response = _t("AddToCartPage.ERRORPRODUCTNOTADDED", "ERROR: Product Not Added - make sure to find a product first.");
		if(class_exists($buyableClassName) && EcommerceDBConfig::is_buyable($buyableClassName)) {
			$buyable = DataObject::get_by_id($buyableClassName, $buyableID);
			if($buyable) {
				$orderItem = $buyable->OrderItem();
				$orderItem->Quantity = $quantity;
				$orderItem->Version = $version;
				$orderItem->write();
				$status = "good";
				$response = _t("AddToCartPage.ADDED", "Added");
			}
		}
		if(Director::is_ajax()) {
			return $response;
		}
		else {
			$form->setMessage($response, $status);
			Director::redirectBack();
		}
	}

}

