<?php
require_once 'UsedCarListing.php';
header('Content-Type: application/json');

$isShortlisted = UsedCarListing::checkShortListforListing($_GET['username'], $_GET['id']);

echo json_encode($isShortlisted);
?> 