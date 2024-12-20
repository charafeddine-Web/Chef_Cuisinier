<?php
require('./connection.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['ReservationID'];
    $title = $_POST['Title'];
    $price = $_POST['Price'];
    $chefName = $_POST['ChefName'];

    $sql = "UPDATE Menu SET Title = ?, Price = ?, ChefName = ? WHERE MenuID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssi", $title, $price, $chefName, $id);

    if ($stmt->execute()) {
        header("Location: menu_page.php?message=Menu item updated successfully");
    } else {
        header("Location: menu_page.php?error=Failed to update menu item");
    }
}
?>
