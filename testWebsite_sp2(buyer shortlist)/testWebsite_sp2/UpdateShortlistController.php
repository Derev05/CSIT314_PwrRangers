<?php
session_start();

require_once 'UsedCarListing.php';
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	var_dump($_POST);
	$updateShortlist = UpdateShortlistController::updateShortlist($_POST['action'], $_POST['listingId'], $_POST['username']);
}

class UpdateShortlistController {
	
	public static function updateShortlist($action, $listingId, $buyerName) {
		
		//Update the shortlist count and add or remove from shortlist according to action
		$updateShortlistCount = UsedCarListing::updateShortlistCount($action, $listingId);
		$addtoBuyerShortlist = UsedCarListing::updateBuyerShortlist($action, $listingId, $buyerName);
		
		//Update session variable to show the correct buttons
		if ($action === "increase") {						
			$_SESSION['message'] = 'Listing successfully added to your shortlist';
		} elseif ($action === "decrease") {
			$_SESSION['message'] = 'Listing successfully removed from your shortlist';
		}
		
		//Redirect user back to car listing page
		header("Location: carListing.php?id=" . $listingId);
		exit();
	}
}
		