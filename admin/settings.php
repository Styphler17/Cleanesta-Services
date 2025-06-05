<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
require_once '../app/config/params.php';
use Core\Database;
$pdo = Database::getConnection();

// Fetch all settings
$stmt = $pdo->query("SELECT * FROM settings ORDER BY id ASC");
$settings = $stmt->fetchAll(PDO::FETCH_ASSOC);
$settingsAssoc = [];
foreach ($settings as $row) {
    $settingsAssoc[$row['setting_key']] = $row['setting_value'];
}

// Handle update
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle file uploads separately
    if (isset($_FILES['cleanesta-logo']) && $_FILES['cleanesta-logo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/images/logo/';
        $filename = basename($_FILES['cleanesta-logo']['name']);
        $targetPath = $uploadDir . $filename;
        if (move_uploaded_file($_FILES['cleanesta-logo']['tmp_name'], $targetPath)) {
            $stmt = $pdo->prepare("UPDATE settings SET setting_value=?, updated_at=NOW() WHERE setting_key='cleanesta-logo'");
            $stmt->execute([$targetPath]);
        }
    }
    
    if (isset($_FILES['favicon']) && $_FILES['favicon']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/images/logo/';
        $filename = basename($_FILES['favicon']['name']);
        $targetPath = $uploadDir . $filename;
        if (move_uploaded_file($_FILES['favicon']['tmp_name'], $targetPath)) {
            $stmt = $pdo->prepare("UPDATE settings SET setting_value=?, updated_at=NOW() WHERE setting_key='favicon'");
            $stmt->execute([$targetPath]);
        }
    }

    // Handle text settings
    $textSettings = ['cleanesta-description', 'social-media-links', 'terms-of-service', 'privacy-policy', 'theme-colors'];
    foreach ($textSettings as $key) {
        if (isset($_POST[$key])) {
            $newValue = $_POST[$key];
            // Encode JSON for theme-colors and social-media-links
            if ($key === 'theme-colors' || $key === 'social-media-links') {
                $json = json_decode($newValue, true);
                $newValue = json_encode($json, JSON_PRETTY_PRINT);
            }
            $stmt = $pdo->prepare("UPDATE settings SET setting_value=?, updated_at=NOW() WHERE setting_key=?");
            $stmt->execute([$newValue, $key]);
        }
    }

    $success = 'Settings updated successfully!';
    
    // Refresh settings
    $stmt = $pdo->query("SELECT * FROM settings ORDER BY id ASC");
    $settings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $settingsAssoc = [];
    foreach ($settings as $row) {
        $settingsAssoc[$row['setting_key']] = $row['setting_value'];
    }

    // Generate CSS for theme colors
    if (isset($settingsAssoc['theme-colors'])) {
        $themeColors = json_decode($settingsAssoc['theme-colors'], true);
        $css = ":root {\n";
        foreach ($themeColors as $color => $value) {
            $css .= "  --color-{$color}: {$value};\n";
        }
        $css .= "}\n";
        file_put_contents('../assets/css/theme.css', $css);
    }
}

ob_start();
?>
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow p-4 sm:p-8 mt-4 sm:mt-8">
    <h1 class="text-2xl font-bold text-primary mb-6">Settings Management</h1>
    <?php if ($success): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <!-- File Upload Form -->
    <form method="post" enctype="multipart/form-data" class="space-y-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Logo & Favicon</h2>
        <?php foreach (['cleanesta-logo', 'favicon'] as $key): ?>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
                <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-0 sm:w-48 flex-shrink-0"><?php echo ucwords(str_replace(['-', '_'], ' ', $key)); ?></label>
                <div class="flex-1">
                    <input type="file" name="<?php echo $key; ?>" class="w-full px-4 py-2 border rounded-lg" accept="image/*" onchange="previewImage(event, '<?php echo $key; ?>')">
                    <div class="mt-2 flex items-center gap-2 flex-wrap">
                        <img id="preview-<?php echo $key; ?>" src="<?php echo str_replace('../', BASE_URL . '/', $settingsAssoc[$key]); ?>" alt="<?php echo $key; ?>" class="h-12 w-12 object-contain border rounded shadow">
                        <span class="text-xs text-gray-500">Current</span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="w-full bg-primary text-white py-2 px-4 rounded-lg hover:bg-secondary transition duration-200">Update Images</button>
    </form>

    <!-- Text Settings Form -->
    <form method="post" class="space-y-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Text Settings</h2>
        <?php foreach ($settingsAssoc as $key => $value): ?>
            <?php if (!in_array($key, ['cleanesta-logo', 'favicon'])): ?>
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-0 sm:w-48 flex-shrink-0"><?php echo ucwords(str_replace(['-', '_'], ' ', $key)); ?></label>
                    <div class="flex-1">
                        <?php if ($key === 'theme-colors' || $key === 'social-media-links'): ?>
                            <textarea name="<?php echo $key; ?>" rows="4" class="w-full px-4 py-2 border rounded-lg"><?php echo $value; ?></textarea>
                        <?php elseif ($key === 'terms-of-service' || $key === 'privacy-policy' || $key === 'cleanesta-description'): ?>
                            <textarea name="<?php echo $key; ?>" rows="4" class="w-full px-4 py-2 border rounded-lg"><?php echo $value; ?></textarea>
                        <?php else: ?>
                            <input type="text" name="<?php echo $key; ?>" value="<?php echo $value; ?>" class="w-full px-4 py-2 border rounded-lg">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <button type="submit" class="w-full bg-primary text-white py-2 px-4 rounded-lg hover:bg-secondary transition duration-200">Update Settings</button>
    </form>
</div>
<script>
function previewImage(event, key) {
    const input = event.target;
    const preview = document.getElementById('preview-' + key);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?php
$content = ob_get_clean();
include 'layout.php'; 