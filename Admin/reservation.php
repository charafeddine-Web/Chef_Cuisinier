<?php
require('../Client/connection.php');
session_start();
if (!isset($_SESSION['user_id']) || (int)$_SESSION['RoleID'] !== 2) {
    header('Location: ../Client/sginIn.php');
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
</head>
<body>
<div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
    
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <svg class="w-12 h-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z" fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z" fill="white"></path>
                    </svg>
                    
                    <span class="mx-2 text-2xl font-semibold text-white">Chef Charaf</span>
                </div>
            </div>
    
            <nav class="mt-10">
                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="./index.php">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                    <span class="mx-3">Dashboard</span>
                </a>
    
                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="./menus.php">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
                        </path>
                    </svg>
    
                    <span class="mx-3">Menus</span>
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
              
                <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
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
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                        
                    </button>
                 
    
                    <div class="relative mx-4 lg:mx-0">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </span>
    
                        <input class="w-32 pl-10 pr-4 md:p-2 rounded-md form-input sm:w-64 focus:border-indigo-600 bg-gray-200" type="text"
                            placeholder="">
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
                        <?php if ( isset($_SESSION['email'])): ?>
                                <div class="relative group">
                                    <p class="text-gray-600">Welcome back, <?= htmlspecialchars($_SESSION['full_Name']); ?></p>
                                </div>
                            <?php else: ?>
                                <p class="text-gray-600">Welcome, Guest!</p>
                        <?php endif; ?>
    
                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full"
                            style="display: none;"></div>
    
                        <div x-show="dropdownOpen"
                            class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl"
                            style="display: none;">
                            <a id="profile" href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>
                            <a href="logout.php"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
                        </div>
                    </div>
                </div>
            </header>
            <div id="profileForm"
                    class="hidden fixed inset-0 flex items-center justify-center z-50 bg-gray-700 bg-opacity-50">
                    <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg w-full">
                    <div class="flex justify-between">
                        <h1 class="text-2xl font-bold text-center mb-1">Modifier les Informations du Chef</h1>
                        <strong id="close" class="bg-red-500 p-2 rounded cursor-pointer">X</strong>
                        </div>
                        <form action="update_profile.php" method="POST" enctype="multipart/form-data" class="space-y-4 mt-2">
                            <div>
                                <label for="fullName" class="block text-sm font-semibold">Nom Complet</label>
                                <input type="text" id="fullName" name="fullName" required
                                    class="w-full px-4 py-2 mt-2 border rounded-md"
                                    value="<?= $_SESSION['full_Name'] ?? ''; ?>" />
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold">Email</label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-4 py-2 mt-2 border rounded-md"
                                    value="<?= $_SESSION['email'] ?? ''; ?>" />
                            </div>

                            <div>
                                <label for="profileImage" class="block text-sm font-semibold">Image de Profil</label>
                                <input type="file" id="profileImage" name="profileImage"
                                    class="w-full px-4 py-2 mt-2 border rounded-md" />
                            </div>

                            <div class="flex justify-center">
                                <button type="submit" name="submit"
                                    class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                    Modifier
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    <div class="flex items-center justify-between">
                          <h3 class="text-3xl font-medium text-gray-700">Reservations</h3>
                        </div>
                    <div class="mt-4">
                        <div class="flex flex-wrap -mx-6">
                           
                        </div>
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
                                                    Client</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Menu</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    N.People</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Date</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Status</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Action</th>
                                            </tr>
                                        </thead>
    
                                        <tbody class="bg-white">
                                            <?php
                                            $sql = "SELECT R.ReservationDate, R.NumberOfPeople, R.Status, u.full_Name AS client, M.Title AS Menu, u.UserID 
                                                    FROM Reservations R
                                                    INNER JOIN users u ON R.UserID = u.UserID
                                                    INNER JOIN Menu M ON R.MenuID = M.MenuID";

                                            $stmt = $connect->prepare($sql);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result->num_rows > 0) {
                                                while ($reservation = $result->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                                <?php echo htmlspecialchars($reservation['client']); ?>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                            <div class="text-sm leading-5 text-gray-500">
                                                                <?php echo htmlspecialchars($reservation['Menu']); ?>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                            <div class="text-sm leading-5 text-gray-500">
                                                                <?php echo htmlspecialchars($reservation['NumberOfPeople']); ?>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                            <div class="text-sm leading-5 text-gray-500">
                                                                <?php echo htmlspecialchars($reservation['ReservationDate']); ?>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                            <div class="text-sm leading-5 text-gray-500">
                                                                <?php echo htmlspecialchars($reservation['Status']); ?>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                            <a href="edit_user.php?id=<?php echo $reservation['UserID']; ?>" class="text-indigo-600 hover:text-indigo-900">accepter </a>
                                                            <a href="delete_user.php?id=<?php echo $reservation['UserID']; ?>" class="text-red-600 hover:text-red-900 pl-2">refuser</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="6" class="px-6 py-4 text-center text-sm leading-5 text-gray-500 border-b border-gray-200">
                                                        No reservations found.
                                                    </td>
                                                </tr>
                                                <?php
                                            }

                                            $stmt->close();
                                            ?>
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
<script src="./js/index.js"></script>

</body>
</html>