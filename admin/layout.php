<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- favicon  -->
    <link rel="icon" href="/scrub/assets/images/logo/cleanesta-logo.png" type="image/png">
    <link rel="stylesheet" href="/scrub/assets/css/theme.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: 'var(--color-primary, #f34d26)',
                        secondary: 'var(--color-secondary, #00bda4)',
                        accent: 'var(--color-accent, #7d2ea8)',
                        neutral: 'var(--color-neutral, #ffffff)',
                        dark: 'var(--color-dark, #1f1f1f)',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-white border-r border-gray-200 w-60 flex-shrink-0 flex flex-col transition-all duration-300 z-30 fixed md:static inset-y-0 left-0 transform -translate-x-full md:translate-x-0 md:relative" style="min-width:15rem;">
            <div class="flex items-center justify-center px-4 py-6 border-b">
                <span class="font-extrabold text-2xl text-primary tracking-wide">Admin Panel</span>
            </div>
            <nav class="flex-1 px-2 py-4 space-y-1">
                <a href="dashboard.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition text-gray-700">
                    <i class="fas fa-chart-line mr-3"></i> Dashboard
                </a>
                <a href="services.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition text-gray-700">
                    <i class="fas fa-broom mr-3"></i> Services
                </a>
                <a href="reviews.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition text-gray-700">
                    <i class="fas fa-star mr-3"></i> Reviews
                </a>
                <a href="areas.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition text-gray-700">
                    <i class="fas fa-map-marker-alt mr-3"></i> Service Areas
                </a>
                <a href="bookings.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition text-gray-700">
                    <i class="fas fa-calendar-check mr-3"></i> Bookings
                </a>
                <a href="admins.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition text-gray-700">
                    <i class="fas fa-users mr-3"></i> Admins
                </a>
                <a href="staff.php" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-user-clock mr-3"></i>
                    Staff
                </a>
                <a href="contact.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition text-gray-700">
                    <i class="fas fa-address-book mr-3"></i> Contact
                </a>
                <a href="settings.php" class="flex items-center px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition text-gray-700">
                    <i class="fas fa-cog mr-3"></i> Settings
                </a>
            </nav>
            <div class="mt-auto px-4 py-4">
                <a href="logout.php" class="flex items-center justify-center px-4 py-2 rounded bg-red-500 text-white text-center hover:bg-red-600 transition w-full">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Logout
                </a>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-40 z-20 hidden md:hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <?php include 'includes/header.php'; ?>
            <!-- Main Content Area -->
            <main class="flex-1 p-6 overflow-y-auto">
                <?php if (isset($content)) {
                    echo $content;
                } ?>
            </main>
        </div>
    </div>
    <script>
        // Sidebar toggle for mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarOpen = document.getElementById('sidebarOpen');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (sidebarOpen) {
            sidebarOpen.onclick = () => {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
            };
        }
        if (sidebarClose) {
            sidebarClose.onclick = () => {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            };
        }
        if (sidebarOverlay) {
            sidebarOverlay.onclick = () => {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            };
        }
        // Profile dropdown
        const profileBtn = document.getElementById('profileDropdownBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        if (profileBtn && profileDropdown) {
            profileBtn.onclick = (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            };
            document.addEventListener('click', function(e) {
                if (!profileDropdown.contains(e.target) && !profileBtn.contains(e.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });
        }
    </script>
</body>

</html>