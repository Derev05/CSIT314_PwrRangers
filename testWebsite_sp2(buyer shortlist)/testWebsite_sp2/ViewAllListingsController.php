<?php
require_once 'UsedCarListing.php';
header('Content-Type: application/json');

$query = isset($_GET['query']) ? $_GET['query'] : '';
$listings = UsedCarListing::searchListings($query);

echo json_encode($listings);
?>