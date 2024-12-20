<?php
session_start();
require('../Client/connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_SESSION['user_id']; 
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $profileImage = null;

    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
        $fileTmpPath = $_FILES['profileImage']['tmp_name'];
        $fileName = $_FILES['profileImage']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadDir = 'profile_images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $uploadPath = $uploadDir . $_FILES['profileImage']['name'];
            if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                $profileImage = $uploadPath;
            } else {
                echo "Error uploading image.";
            }
        } else {
            echo "Invalid file type. Allowed types are jpg, jpeg, png, gif.";
        }
    }

    $sql = "UPDATE users SET full_Name = ?, Email = ?, ProfileImage = ? WHERE UserID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param('sssi', $fullName, $email, $profileImage, $userID);
    
    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile.";
    }
}

