<?php
require('../Client/connection.php');

if (isset($_GET['id'])) {
    $reservationID = $_GET['id'];

    $sql = "UPDATE Reservations SET Status = 'Rejected' WHERE ReservationID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $reservationID);

    if ($stmt->execute()) {
        header("Location: reservation.php?status=rejected");
        exit;
    } else {
        echo "Error rejecting the reservation.";
    }

    $stmt->close();
} else {
    echo "Invalid reservation ID.";
}
?>
