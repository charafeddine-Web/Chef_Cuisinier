<?php
require('../Client/connection.php');
session_start();

if (!isset($_SESSION['user_id']) || (int) $_SESSION['RoleID'] !== 2) {
    header('Location: ../Client/sginIn.php');
    exit();
}

$query = "SELECT PlateID, PlateName FROM Plates";
$result = $connect->query($query);
$plates = [];
while ($row = $result->fetch_assoc()) {
    $plates[] = $row;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $title = trim(htmlspecialchars($_POST['title']));
    $description = trim(htmlspecialchars($_POST['description']));
    $price = trim(htmlspecialchars($_POST['price']));
    $status = $_POST['status'];
    $selectedPlates = $_POST['plates'] ?? []; 

    $sql = "INSERT INTO Menu (Title, Description, Price, Status, chef_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param('ssdsi', $title, $description, $price, $status, $_SESSION['user_id']);
    $stmt->execute();

    $menuID = $stmt->insert_id;
    $stmt->close();

    foreach ($selectedPlates as $plateID) {
        $sql_insert_plate = "INSERT INTO PlatesMenu (MenuID, PlateID) VALUES (?, ?)";
        $stmt = $connect->prepare($sql_insert_plate);
        $stmt->bind_param('ii', $menuID, $plateID);
        $stmt->execute();
        $stmt->close();
    }
    header('Location: menus.php'); 
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Page-Admin</title>
    <script defer>
        function addPlateFields() {
            const plateContainer = document.getElementById('plate-container');
            const plateCount = plateContainer.children.length;

            if (plateCount < 3) {
                const plateForm = `
                    <div class="bg-gray-50 p-4 border rounded-md mb-4">
                        <h3 class="font-semibold mb-2">Plate ${plateCount + 1}</h3>
                        <div class="mb-2">
                            <label class="block text-sm font-medium text-gray-700">Plate Name</label>
                            <input type="text" name="plates[${plateCount}][name]" class="w-full border rounded-md p-2" placeholder="Plate Name" required>
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-medium text-gray-700">Plate Description</label>
                            <textarea name="plates[${plateCount}][description]" class="w-full border rounded-md p-2" rows="2" placeholder="Plate Description"></textarea>
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-medium text-gray-700">Plate Price</label>
                            <input type="number" name="plates[${plateCount}][price]" class="w-full border rounded-md p-2" placeholder="Plate Price" required>
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-medium text-gray-700">Plate Image</label>
                            <input type="file" name="plates[${plateCount}][image]" class="w-full border rounded-md p-2">
                        </div>
                    </div>`;
                plateContainer.insertAdjacentHTML('beforeend', plateForm);
            } else {
                alert("You can add a maximum of 3 plates.");
            }
        }
    </script>
</head>

<body>

    <div>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
            <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
                class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

            <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
                class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
                <div class="flex items-center justify-center mt-8">
                    <div class="flex items-center">
                        <svg class="w-12 h-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                                fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path
                                d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                                fill="white"></path>
                        </svg>

                        <span class="mx-2 text-2xl font-semibold text-white">Chef Charaf</span>
                    </div>
                </div>

                <nav class="mt-10">
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                        href="./index.php">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>

                        <span class="mx-3">Dashboard</span>
                    </a>


                    <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
                        href="./menus.php">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
                            </path>
                        </svg>

                        <span class="mx-3">Menu</span>
                    </a>

                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                        href="./clients.php">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>

                        <span class="mx-3">Client</span>
                    </a>
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                        href="./reservation.php">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>

                        <span class="mx-3">Reservations</span>
                    </a>
                </nav>
            </div>
            <div class="flex flex-col flex-1 overflow-hidden">
                <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>

                        <div class="relative mx-4 lg:mx-0">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                </svg>
                            </span>

                            <input
                                class="w-32 pl-10 pr-4 md:p-2 rounded-md form-input sm:w-64 focus:border-indigo-600 bg-gray-200"
                                type="text" placeholder="">
                        </div>
                    </div>

                    <div class="flex items-center">


                        <div x-data="{ dropdownOpen: false }" class="relative">
                            <button @click="dropdownOpen = ! dropdownOpen"
                                class="relative block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none">
                                <img class="object-cover w-full h-full"
                                    src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=296&amp;q=80"
                                    alt="Your avatar">
                            </button>

                            <div x-show="dropdownOpen" @click="dropdownOpen = false"
                                class="fixed inset-0 z-10 w-full h-full" style="display: none;"></div>

                            <div x-show="dropdownOpen"
                                class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl"
                                style="display: none;">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
                            </div>
                        </div>
                    </div>
                </header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container px-6 py-8 mx-auto">
                        <h3 class="text-3xl font-medium text-gray-700">Menus</h3>

                        <div class="max-w-4xl mx-auto p-4">
                            <h1 class="text-3xl font-bold text-center mb-6">Ajouter un Nouveau Menu</h1>

                            <form action="" method="POST" class="space-y-4">
                                <div>
                                    <label for="title" class="block text-sm font-semibold">Titre du Menu</label>
                                    <input type="text" id="title" name="title" required
                                        class="w-full px-4 py-2 mt-2 border rounded-md" />
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-semibold">Description du
                                        Menu</label>
                                    <textarea id="description" name="description" required
                                        class="w-full px-4 py-2 mt-2 border rounded-md" rows="4"></textarea>
                                </div>

                                <div>
                                    <label for="price" class="block text-sm font-semibold">Prix du Menu</label>
                                    <input type="number" id="price" name="price" required
                                        class="w-full px-4 py-2 mt-2 border rounded-md" />
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-semibold">Statut du Menu</label>
                                    <select id="status" name="status" class="w-full px-4 py-2 mt-2 border rounded-md">
                                        <option value="Active">Active</option>
                                        <option value="Archived">Archived</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="plates" class="block text-sm font-semibold">Sélectionner les Plats
                                        (jusqu'à 3)</label>
                                    <select id="plates" name="plates[]" multiple required
                                        class="w-full px-4 py-2 mt-2 border rounded-md" size="5">
                                        <?php foreach ($plates as $plate): ?>
                                            <option value="<?= $plate['PlateID']; ?>"><?= $plate['PlateName']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p class="text-xs text-gray-500 mt-2">Choisissez jusqu'à 3 plats pour ce menu.</p>
                                </div>

                                <div class="flex justify-center">
                                    <button type="submit" name="submit"
                                        class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                        Ajouter le Menu
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="mt-8">

                        </div>

                        <div class="flex flex-col mt-8">
                            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                                <div
                                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                                    <table class="min-w-full">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Name</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Title</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Status</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Role</th>
                                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                                            </tr>
                                        </thead>

                                        <tbody class="bg-white">


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>

</html>