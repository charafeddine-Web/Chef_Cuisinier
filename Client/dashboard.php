

<?php
require('./connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef Charaf Din - Fine Dining Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans">

    <nav class="bg-white shadow-md fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="#Welcome" class="flex items-center">
                        <img src="images/logo.png" alt="Logo" class="h-10 w-10">
                        <span class="ml-2 text-xl font-bold text-gray-800">Chef Italian</span>
                    </a>
                </div>

                <div class="hidden md:flex space-x-6">
                    <a href="#chef" class="text-gray-700 hover:text-blue-600 transition">Chef</a>
                    <a href="#Menu" class="menus text-gray-700 hover:text-blue-600 transition">Menu</a>
                    <a href="#Reservation" class="reservations text-gray-700 hover:text-blue-600 transition">Reservation</a>
                </div>

                <div class="flex items-center space-x-4">
                    <?php if (isset($_SESSION['full_Name']) || isset($_SESSION['email'])): ?>
                        <div class="relative group">
                            <p class="text-gray-800 font-semibold text-lg">
                                <?= htmlspecialchars($_SESSION['full_Name'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p class="text-gray-600"><?= htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <div class="hidden absolute top-full left-0 mt-4 bg-white p-6 rounded-lg shadow-lg max-w-sm w-full group-hover:block">
                                <p class="text-gray-700 text-sm">Welcome back, <?= htmlspecialchars($_SESSION['full_Name'], ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-600">Welcome, Guest!</p>
                    <?php endif; ?>
                </div>

                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden bg-white shadow-md">
            <a href="#chef" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Chef</a>
            <a href="#Menu" class="menus block px-4 py-2 text-gray-700 hover:bg-blue-100">Menu</a>
            <a href="#Reservation" class="reservations block px-4 py-2 text-gray-700 hover:bg-blue-100">Reservation</a>
        </div>
    </nav>

    

    <!-- Sections (e.g., About, Menu, Reservations) -->
    <section id="about" class="py-16 bg-gray-100">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Meet Chef Charaf Din</h2>
            <p class="text-gray-600">
                With years of experience in the culinary arts, Chef Charaf Din specializes in creating extraordinary dishes 
                that blend traditional flavors with modern techniques. Every dish is a work of art, crafted with passion and precision.
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
                            echo "<div class='bg-white shadow-lg rounded-lg overflow-hidden'>";
                            echo "<img src='" . htmlspecialchars($row['MenuImage'], ENT_QUOTES, 'UTF-8') . "' alt='Dish Image' class='w-full h-48 object-cover'>";
                            echo "<div class='p-6'>";
                            echo "<h3 class='text-xl font-bold text-gray-800 mb-2'>" . htmlspecialchars($row['Title'], ENT_QUOTES, 'UTF-8') . "</h3>";
                            echo "<p class='text-gray-600 mb-4'>" . htmlspecialchars($row['Description'], ENT_QUOTES, 'UTF-8') . "</p>";
                            echo "<p class='text-lg font-semibold text-blue-600'>$" . htmlspecialchars($row['Price'], ENT_QUOTES, 'UTF-8') . "</p>";
                            echo "<button class='mt-4 w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700'>Reserve Now</button>";
                            echo "</div>";
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
    <div id="reservation" class="min-w-full hidden overflow-hidden bg-white shadow-md sm:rounded-lg p-6 mt-10">
    <div class="text-xl font-bold mb-4">
        <p>Menu Table</p>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">MenuID</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">Title</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">Description</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">Price</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">Menu Image</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">ChefID</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase border border-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 text-sm text-gray-700 border border-gray-300">1</td>
                    <td class="px-4 py-2 text-sm text-gray-700 border border-gray-300">Pasta</td>
                    <td class="px-4 py-2 text-sm text-gray-700 border border-gray-300">
                        Delicious Italian pasta with fresh ingredients.
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700 border border-gray-300">$12.99</td>
                    <td class="px-4 py-2 text-sm text-green-600 border border-gray-300">Active</td>
                    <td class="px-4 py-2 text-sm border border-gray-300">
                        <img class="w-16 h-16 object-cover rounded" src="https://via.placeholder.com/150" alt="Menu Image">
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700 border border-gray-300">101</td>
                    <td class="px-4 py-2 text-sm text-gray-700 border border-gray-300">
                        <button class="text-blue-600 hover:underline hover:text-blue-800">Edit</button>
                        <button class="ml-2 text-red-600 hover:underline hover:text-red-800">Cancel</button>
                    </td>
                </tr>
            </tbody>
        </table>
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


        const buttonmenu=document.querySelectorAll('.menus');
        const buttonreservation=document.querySelectorAll('.reservations');

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

    </script>
</body>
</html>
