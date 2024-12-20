<?php
ob_start();
require('./connection.php');
session_start();

if (!isset($_SESSION['user_id']) || (int) $_SESSION['RoleID'] !== 3) {
    header('Location: ./index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_SESSION['user_id']; 
    $menuID = $_POST['menuID'];
    $numberOfPeople = intval($_POST['numberOfPeople']);
    $reservationDate = $_POST['reservationDate'];

    $sql = "INSERT INTO Reservations (UserID, ChefID, MenuID, ReservationDate, NumberOfPeople) 
            VALUES (?, ?, ?, ?, ?)";
    $ChefID = 2;

    $stmt = $connect->prepare($sql);
    $stmt->bind_param('iiisi', $userID, $ChefID, $menuID, $reservationDate, $numberOfPeople);

    if ($stmt->execute()) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Reservation Successful!',
                    text: 'Your reservation has been confirmed.',
                    confirmButtonText: 'Go to Menu'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'dashboard.php';
                    }
                });
            });
        </script>";
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please try again.',
                    confirmButtonText: 'Retry'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'dashboard.php'; 
                    }
                });
            });
        </script>";
    }
}



$userID = $_SESSION['user_id']; 

$sql = "SELECT 
            r.ReservationID,
            r.ReservationDate,
            r.NumberOfPeople,
            r.Status,
            m.Title,
            m.Price,
            m.MenuImage,
            u.full_Name AS ChefName
        FROM Reservations r
        JOIN Menu m ON r.MenuID = m.MenuID
        JOIN users u ON r.ChefID = u.UserID
        WHERE r.UserID = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result_res = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef Charaf Eddine - Fine Dining Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-50 font-sans">
<nav class="bg-white shadow-md fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="#Welcome" class="flex items-center">
                        <img src="images/logo.png" alt="Logo" class="h-10 w-10">
                        <span class="ml-2 text-xl font-bold text-gray-800">Chef Charaf</span>
                    </a>
                </div>

                <div class="hidden md:flex space-x-6">
                    <a href="#chef" class="text-gray-700 hover:text-blue-600 transition">Chef</a>
                    <a href="#Menu" class="menus text-gray-700 hover:text-blue-600 transition">Menu</a>
                    <a href="#Reservation" class="reservations text-gray-700 hover:text-blue-600 transition">Reservation</a>
                </div>

                <div class="flex items-center gap-4 space-x-4 hidden md:flex">
                    <?php if (isset($_SESSION['full_Name']) || isset($_SESSION['email'])): ?>
                        <div class="relative group">
                            <p class="text-gray-800 font-semibold text-lg">
                                <?= htmlspecialchars($_SESSION['full_Name'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p class="text-gray-600"><?= htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <div
                                class="hidden absolute top-full left-0 mt-4 bg-white p-6 rounded-lg shadow-lg max-w-sm w-full group-hover:block">
                                <p class="text-gray-700 text-sm">Welcome back,
                                    <?= htmlspecialchars($_SESSION['full_Name'], ENT_QUOTES, 'UTF-8'); ?>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div>
                        <a href="../Admin/logout.php"
                            class="group flex items-center justify-start w-11 h-11 bg-black rounded-full cursor-pointer relative overflow-hidden transition-all duration-200 shadow-lg ">
                            <div class="flex items-center justify-center w-full transition-all duration-300 ">
                                <svg class="w-4 h-4" viewBox="0 0 512 512" fill="white">
                                    <path
                                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                                    </path>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden bg-white shadow-md">
            <a href="#chef" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Chef</a>
            <a href="#Menu" class="menus block px-4 py-2 text-gray-700 hover:bg-blue-100">Menu</a>
            <a href="#Reservation" class="reservations block px-4 py-2 text-gray-700 hover:bg-blue-100">Reservation</a>
            <div class="flex justify-between">
                <a href="../Admin/Logout.php"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
            </div>
        </div>
    </nav>



    <section id="about" class="py-16 bg-gray-100">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Meet Chef Charaf Din</h2>
            <p class="text-gray-600">
                With years of experience in the culinary arts, Chef Charaf Din specializes in creating extraordinary
                dishes
                that blend traditional flavors with modern techniques. Every dish is a work of art, crafted with passion
                and precision.
            </p>
        </div>
    </section>


    <section id="menu" class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center">Our Signature Menu</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $sql = "SELECT * FROM Menu";
                $stmt = $connect->prepare($sql);
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $menuID = $row['MenuID'];
                            echo "<div class='bg-white shadow-lg rounded-lg overflow-hidden cursor-pointer' onclick='showModal(\"menu-$menuID\")'>";
                            echo "<img src='" . htmlspecialchars($row['MenuImage'], ENT_QUOTES, 'UTF-8') . "' alt='Dish Image' class='w-full h-48 object-cover'>";
                            echo "<div class='p-6'>";
                            echo "<h3 class='text-xl font-bold text-gray-800 mb-2'>" . htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8') . "</h3>";
                            echo "<p class='text-gray-600 mb-4'>" . htmlspecialchars($row['Description'], ENT_QUOTES, 'UTF-8') . "</p>";
                            echo "<p class='text-lg font-semibold text-blue-600'>$" . htmlspecialchars($row['Price'], ENT_QUOTES, 'UTF-8') . "</p>";
                            echo "</div>";
                            echo "</div>";

                            // Hidden modal data
                            echo "<div id='menu-$menuID' class='hidden modal-data'>";
                            echo "<img src='" . htmlspecialchars($row['MenuImage'], ENT_QUOTES, 'UTF-8') . "' alt='Dish Image' class='w-full h-48 object-cover mb-4'>";
                            echo "<h3 class='text-2xl font-bold text-gray-800 mb-2'>" . htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8') . "</h3>";
                            echo "<p class='text-gray-600 mb-4'>" . htmlspecialchars($row['Description'], ENT_QUOTES, 'UTF-8') . "</p>";
                            echo "<p class='text-lg font-semibold text-blue-600 mb-4'>$" . htmlspecialchars($row['Price'], ENT_QUOTES, 'UTF-8') . "</p>";
                            echo "<button class='mt-4 w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700' onclick='showReservationModal($menuID)'>Reserve Now</button>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p class='text-gray-600'>No menu items available at the moment.</p>";
                    }
                } else {
                    echo "<p class='text-red-600'>Failed to fetch menu data. Please try again later.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <div id="menuModal" class="hidden fixed inset-0 bg-gray-700 bg-opacity-50 flex items-center justify-center z-50">
        <button id='closeModal'
            class='absolute top-4 right-4 text-gray-900 hover:text-gray-800 text-4xl text-red-900 bg-red-500  px-2 rounded'>&times;</button>;
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-xl w-full">
            <div id="modalContent">
            </div>
        </div>
    </div>
    <div id="reservationModal"
        class="hidden fixed inset-0 bg-gray-700 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
            <button id="closeReservationModal"
                class="absolute top-4 right-4 text-gray-900 hover:text-gray-800 text-4xl text-red-900 bg-red-500  px-2 rounded">&times;</button>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Make a Reservation</h2>

            <form action="dashboard.php" method="POST" id="reservationForm" class="space-y-4">
                <input type="hidden" name="menuID" id="menuID">
                <div>
                    <label for="numberOfPeople" class="block text-sm font-semibold">Number of People</label>
                    <input type="number" id="numberOfPeople" name="numberOfPeople" min="1" required
                        class="w-full px-4 py-2 mt-2 border rounded-md">
                </div>
                <div>
                    <label for="reservationDate" class="block text-sm font-semibold">Reservation Date</label>
                    <input type="datetime-local" id="reservationDate" name="reservationDate" required
                        class="w-full px-4 py-2 mt-2 border rounded-md">
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">Confirm
                        Reservation</button>
                </div>
            </form>
        </div>
    </div>

    <div id="reservation" class="min-w-full hidden overflow-hidden bg-white shadow-md sm:rounded-lg p-6 mt-10">
      
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Your Reservations</h2>
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Reservation ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Menu Item
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Chef Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Number of People
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Reservation Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    if ($result_res->num_rows > 0) {
                        while ($row = $result_res->fetch_assoc()) {
                            echo "<tr class='hover:bg-gray-50'>";
                            echo "<td class='px-6 py-4 text-sm text-gray-700'>" . $row['ReservationID'] . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-gray-700'>" . $row['Title'] . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-gray-700'>$" . number_format($row['Price'], 2) . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-gray-700'>" . $row['ChefName'] . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-gray-700'>" . $row['NumberOfPeople'] . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-gray-700'>" . $row['ReservationDate'] . "</td>";
                            echo "<td class='px-6 py-4 text-sm text-" . ($row['Status'] == 'Approved' ? 'green' : ($row['Status'] == 'Rejected' ? 'red' : 'yellow')) . "-600'>" . $row['Status'] . "</td>";
                            echo "<td class='px-6 py-4 text-sm'>
                                    <button class='text-green-900 hover:underline hover:text-blue-800 p-2 bg-green-500 rounded'>Edit</button>
                                    <button class='ml-2 text-red-900 hover:underline hover:text-red-800  p-2 bg-red-500 rounded'>Cancel</button>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='px-6 py-4 text-center text-gray-700'>No Reservations Found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>

    <section id="contact" class="py-16 bg-gray-800 text-white px-10">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Get in Touch</h2>
            <p class="mb-4">For reservations or inquiries, feel free to reach out to us.</p>
            <form action="#" class="max-w-md mx-auto">
                <input type="text" placeholder="Your Name"
                    class="w-full py-3 px-4 mb-4 rounded-md bg-gray-700 text-white focus:ring-2 focus:ring-blue-500">
                <input type="email" placeholder="Your Email"
                    class="w-full py-3 px-4 mb-4 rounded-md bg-gray-700 text-white focus:ring-2 focus:ring-blue-500">
                <textarea placeholder="Your Message"
                    class="w-full py-3 px-4 mb-4 rounded-md bg-gray-700 text-white focus:ring-2 focus:ring-blue-500"></textarea>
                <button type="submit" class="w-full py-3 bg-blue-600 rounded-md hover:bg-blue-700">Send Message</button>
            </form>
        </div>
    </section>

    <footer class=" text-black py-8">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; 2024 Chef Charaf Din. All Rights Reserved.</p>
        </div>
    </footer>
    <script>
        // const userInfoToggle = document.getElementById('user-info-toggle');
        // const userInfo = document.getElementById('user-info');

        // userInfoToggle.addEventListener('click', () => {
        //     userInfo.classList.toggle('hidden');
        // });
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });


        const buttonmenu = document.querySelectorAll('.menus');
        const buttonreservation = document.querySelectorAll('.reservations');

        buttonmenu.forEach(e => {
            e.addEventListener('click', () => {
                document.getElementById('reservation').classList.toggle('hidden');
                document.getElementById('menu').classList.toggle('hidden');
                document.getElementById('about').classList.toggle('hidden');
            });
        });

        buttonreservation.forEach(e => {
            e.addEventListener('click', () => {
                document.getElementById('reservation').classList.toggle('hidden');
                document.getElementById('menu').classList.toggle('hidden');
                document.getElementById('about').classList.toggle('hidden');


            });
        });

        /**
         * Pour afficher data du une Menu
         */

        function showModal(menuID) {
            const modalData = document.getElementById(menuID).innerHTML;
            document.getElementById('modalContent').innerHTML = modalData;
            document.getElementById('menuModal').classList.remove('hidden');
        }

        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('menuModal').classList.add('hidden');
        });

        /**
         * function pour afficher model de reservation 
         */
        function showReservationModal(menuID) {
            document.getElementById('menuID').value = menuID; 
            document.getElementById('reservationModal').classList.remove('hidden');
        }
        document.getElementById('closeReservationModal').addEventListener('click', () => {
            document.getElementById('reservationModal').classList.add('hidden');
        });


    </script>

</body>

</html>