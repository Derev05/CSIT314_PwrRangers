
<?php
require_once 'UserAccount.php';
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $result = UserAccount::deleteUser($userId);
    echo json_encode(['success' => $result, 'message' => $result ? 'User deleted successfully!' : 'Failed to delete user']);
} else {
    echo json_encode(['success' => false, 'message' => 'No user ID provided.']);
}
?>
