<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the order from the database
    $sql = "DELETE FROM pesanan WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: orders.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
