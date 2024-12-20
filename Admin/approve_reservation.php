<?php
require('../Client/connection.php');

if (isset($_GET['id'])) {
    $reservationID = $_GET['id'];

    $sql = "UPDATE Reservations SET Status = 'Approved' WHERE ReservationID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $reservationID);

    if ($stmt->execute()) {
        header("Location: reservation.php?status=approved");
        exit;
    } else {
        echo "Error approving the reservation.";
    }

    $stmt->close();
} else {
    echo "Invalid reservation ID.";
}
?>
