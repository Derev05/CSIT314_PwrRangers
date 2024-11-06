<?php
require_once 'UsedCarListing.php';
header('Content-Type: application/json');

$carListingId = $_GET['id'];
$listingInfo = UsedCarListing::getListingbyId($carListingId);

echo json_encode($listingInfo);
?>