<?php
require_once('connection.inc.php');
require_once('functions.inc.php');

if (!isset($_SESSION['USER_LOGIN']) || !isset($_SESSION['USER_ID'])) {
    echo "User not logged in!";
    exit;
}

$current_password = get_safe_value($con, $_POST['current_password']);
$new_password = get_safe_value($con, $_POST['new_password']);
$uid = $_SESSION['USER_ID'];

// Fetch user password
$query = mysqli_query($con, "SELECT password FROM users WHERE id='$uid'");

if (!$query || mysqli_num_rows($query) == 0) {
    echo "User not found!";
    exit;
}

$row = mysqli_fetch_assoc($query);

if ($row['password'] != $current_password) {
    echo "Please enter your current valid password";
} else {
    mysqli_query($con, "UPDATE users SET password='$new_password' WHERE id='$uid'");
    echo "Password updated";
}
?>
