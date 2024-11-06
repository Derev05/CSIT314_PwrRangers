
<?php
require_once 'UserAccount.php';
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $result = UserAccount::suspendUser($userId);
    echo json_encode(['success' => $result, 'message' => $result ? 'User suspended successfully.' : 'Error suspending user.']);
} else {
    echo json_encode(['success' => false, 'message' => 'User ID not provided.']);
}
?>
