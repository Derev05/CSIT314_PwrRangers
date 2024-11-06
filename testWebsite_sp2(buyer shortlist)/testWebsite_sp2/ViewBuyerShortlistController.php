<?php
require_once 'UsedCarListing.php';
header('Content-Type: application/json');

$query = isset($_GET['query']) ? $_GET['query'] : '';
$buyerName = $_GET['username'];
$listings = UsedCarListing::searchBuyerShortlist($query, $buyerName);

echo json_encode($listings);
?>