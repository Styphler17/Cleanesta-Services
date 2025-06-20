<?php
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['admin_username'] ?? null;
?>
<header class="w-full bg-white shadow flex items-center justify-between px-8 py-4 sticky top-0 z-10">
    <div class="flex items-center gap-3">
        <!-- Logo (optional, remove if not needed) -->
        <img src="/scrub/assets/images/logo/cleanesta-logo.png" alt="Logo" class="h-12 w-auto">
    </div>
    <div class="flex items-center gap-4 justify-between">
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-primary focus:outline-none">
                <?php if (isset($_SESSION['admin_picture']) && $_SESSION['admin_picture']): ?>
                    <img src="<?php echo str_replace('../', '/scrub/', $_SESSION['admin_picture']); ?>" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                <?php else: ?>
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500 text-sm">
                            <?php echo $username ? strtoupper(substr($username, 0, 1)) : '?'; ?>
                        </span>
                    </div>
                <?php endif; ?>
                <span class="font-medium"><?php echo $username ?? 'Admin'; ?></span>
                <i class="fas fa-chevron-down text-xs"></i>
            </button>
            <div x-show="open" x-transition @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50" style="display: none;" x-cloak>
                <a href="profile.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-user-circle mr-2"></i> Profile Settings
                </a>
                <a href="logout.php" class="block px-4 py-2 text-red-600 hover:bg-gray-100">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>
    </div>
</header>
<!-- Alpine.js for dropdown -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script> 