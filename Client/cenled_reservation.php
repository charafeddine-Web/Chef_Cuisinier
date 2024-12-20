<?php
require('./connection.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $reservationID = intval($_POST['id']);

    if ($reservationID > 0) {
        $sql = "UPDATE Reservations SET Status = 'Cancelled' WHERE ReservationID = ?";
        $stmt = $connect->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $reservationID);
            if ($stmt->execute()) {
                header("Location: dashboard.php?message=Reservation+cancelled+successfully");
            } else {
                echo "Error executing the query: " . $connect->error;
            }
        } else {
            echo "Error preparing the statement: " . $connect->error;
        }
    } else {
        echo "Invalid reservation ID.";
    }
} else {
    echo "Invalid request.";
}
?>
