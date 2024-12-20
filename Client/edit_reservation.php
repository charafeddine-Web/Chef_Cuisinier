<?php
require('./connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ReservationID'])) {
    $id = intval($_POST['ReservationID']);

    $sql = "SELECT * FROM Reservations WHERE ReservationID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $row = $result->fetch_assoc();

    if ($row) {
        echo "<form method='POST' action='update_reservation.php'>";
        echo "<input type='hidden' name='ReservationID' value='" . htmlspecialchars($row['ReservationID'], ENT_QUOTES, 'UTF-8') . "'>";
        echo "Title: <input type='text' name='Title' value='" . htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8') . "'><br>";
        echo "Price: <input type='number' name='Price' value='" . htmlspecialchars($row['Price'], ENT_QUOTES, 'UTF-8') . "'><br>";
        echo "Chef Name: <input type='text' name='ChefName' value='" . htmlspecialchars($row['ChefName'], ENT_QUOTES, 'UTF-8') . "'><br>";
        echo "<button type='submit'>Save Changes</button>";
        echo "</form>";
    } else {
        echo "Reservation not found.";
    }
} else {
    echo "Invalid request.";
}
?>
