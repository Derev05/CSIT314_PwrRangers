
<?php
require_once 'UserAccount.php';
header('Content-Type: application/json');

$query = isset($_GET['query']) ? $_GET['query'] : '';
$users = UserAccount::searchUsers($query);

echo json_encode($users);
?>
