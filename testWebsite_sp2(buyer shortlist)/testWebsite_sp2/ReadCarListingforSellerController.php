<?php
require_once 'UsedCarListing.php';
header('Content-Type: application/json');

$query = isset($_GET['query']) ? $_GET['query'] : '';
$sellerName = $_GET['username'];
$listings = UsedCarListing::searchListingsforSeller($query, $sellerName);

echo json_encode($listings);
?>
