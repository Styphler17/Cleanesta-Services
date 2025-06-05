<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
require_once '../app/config/params.php';
use Core\Database;
$pdo = Database::getConnection();

// Fetch stats
$stats = [];
$tables = [
    'services' => 'Services',
    'reviews' => 'Reviews',
    'bookings' => 'Bookings',
    'service_areas' => 'Service Areas',
    'admins' => 'Admins'
];
foreach ($tables as $table => $label) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM $table");
    $stats[$label] = $stmt->fetchColumn();
}

// Dashboard content
ob_start();
?>
<div class="mb-8">
    <h1 class="text-3xl font-bold text-primary mb-2">Dashboard</h1>
    <p class="text-gray-600">Welcome, <?php echo $_SESSION['admin_username'] ?? 'Admin'; ?>! Here are your site stats:</p>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow p-6 flex items-center space-x-4">
        <span class="bg-primary/10 text-primary p-3 rounded-full"><i class="fas fa-broom fa-lg"></i></span>
        <div>
            <div class="text-2xl font-bold"><?php echo $stats['Services']; ?></div>
            <div class="text-gray-600">Services</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 flex items-center space-x-4">
        <span class="bg-secondary/10 text-secondary p-3 rounded-full"><i class="fas fa-star fa-lg"></i></span>
        <div>
            <div class="text-2xl font-bold"><?php echo $stats['Reviews']; ?></div>
            <div class="text-gray-600">Reviews</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 flex items-center space-x-4">
        <span class="bg-accent/10 text-accent p-3 rounded-full"><i class="fas fa-calendar-check fa-lg"></i></span>
        <div>
            <div class="text-2xl font-bold"><?php echo $stats['Bookings']; ?></div>
            <div class="text-gray-600">Bookings</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 flex items-center space-x-4">
        <span class="bg-secondary/10 text-secondary p-3 rounded-full"><i class="fas fa-map-marker-alt fa-lg"></i></span>
        <div>
            <div class="text-2xl font-bold"><?php echo $stats['Service Areas']; ?></div>
            <div class="text-gray-600">Service Areas</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 flex items-center space-x-4">
        <span class="bg-accent/10 text-accent p-3 rounded-full"><i class="fas fa-user-shield fa-lg"></i></span>
        <div>
            <div class="text-2xl font-bold"><?php echo $stats['Admins']; ?></div>
            <div class="text-gray-600">Admins</div>
        </div>
    </div>
</div>
<!-- Add more dashboard widgets or quick links here -->
<?php
$content = ob_get_clean();
include 'layout.php';
