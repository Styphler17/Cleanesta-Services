<?php
require_once 'includes/auth.php';
require_once '../app/config/params.php';
use Core\Database;
$pdo = Database::getConnection();

// Get current admin data
$stmt = $pdo->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->execute([$_SESSION['admin_id']]);
$admin = $stmt->fetch();

// Handle profile update
if (isset($_POST['update_profile'])) {
    $picture = $admin['picture'];
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/images/admins/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $filename = uniqid() . '_' . basename($_FILES['picture']['name']);
        $targetPath = $uploadDir . $filename;
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetPath)) {
            // Delete old picture if exists
            if ($picture && file_exists($picture)) {
                unlink($picture);
            }
            $picture = $targetPath;
        }
    }

    $stmt = $pdo->prepare("UPDATE admins SET username=?, email=?, picture=?, updated_at=NOW() WHERE id=?");
    $stmt->execute([
        $_POST['username'],
        $_POST['email'],
        $picture,
        $_SESSION['admin_id']
    ]);

    // Update session data
    $_SESSION['admin_username'] = $_POST['username'];
    $_SESSION['admin_email'] = $_POST['email'];

    header('Location: profile.php?success=1');
    exit;
}

// Handle password change
if (isset($_POST['change_password'])) {
    if (password_verify($_POST['current_password'], $admin['password'])) {
        if ($_POST['new_password'] === $_POST['confirm_password']) {
            $stmt = $pdo->prepare("UPDATE admins SET password=?, updated_at=NOW() WHERE id=?");
            $stmt->execute([
                password_hash($_POST['new_password'], PASSWORD_DEFAULT),
                $_SESSION['admin_id']
            ]);
            header('Location: profile.php?success=2');
            exit;
        } else {
            $password_error = "New passwords do not match";
        }
    } else {
        $password_error = "Current password is incorrect";
    }
}

ob_start();
?>
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h1 class="text-2xl font-bold text-primary mb-6">Profile Settings</h1>

        <?php if (isset($_GET['success'])): ?>
            <div class="mb-4 p-4 rounded-lg <?php echo $_GET['success'] == 1 ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700'; ?>">
                <?php echo $_GET['success'] == 1 ? 'Profile updated successfully!' : 'Password changed successfully!'; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($password_error)): ?>
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <?php echo $password_error; ?>
            </div>
        <?php endif; ?>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Profile Information -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Profile Information</h2>
                <form method="post" enctype="multipart/form-data" class="space-y-4">
                    <div>
                        <label class="block mb-1 font-medium">Profile Picture</label>
                        <div class="flex items-center gap-4 mb-2">
                            <?php if ($admin['picture']): ?>
                                <img src="<?php echo str_replace('../', '/scrub/', $admin['picture']); ?>" alt="Profile" class="w-20 h-20 rounded-full object-cover">
                            <?php else: ?>
                                <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500 text-2xl"><?php echo strtoupper(substr($admin['username'], 0, 1)); ?></span>
                                </div>
                            <?php endif; ?>
                            <div>
                                <input type="file" name="picture" accept="image/*" class="w-full px-4 py-2 border rounded" onchange="previewImage(event)">
                                <div id="preview" class="mt-2 hidden">
                                    <img src="" alt="Preview" class="w-20 h-20 rounded-full object-cover">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">Username</label>
                        <input type="text" name="username" value="<?php echo $admin['username']; ?>" class="w-full px-4 py-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">Email</label>
                        <input type="email" name="email" value="<?php echo $admin['email']; ?>" class="w-full px-4 py-2 border rounded" required>
                    </div>
                    <div>
                        <button type="submit" name="update_profile" class="px-4 py-2 bg-primary text-white rounded hover:bg-secondary transition">Update Profile</button>
                    </div>
                </form>
            </div>

            <!-- Change Password -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Change Password</h2>
                <form method="post" class="space-y-4">
                    <div>
                        <label class="block mb-1 font-medium">Current Password</label>
                        <input type="password" name="current_password" class="w-full px-4 py-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">New Password</label>
                        <input type="password" name="new_password" class="w-full px-4 py-2 border rounded" required>
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="w-full px-4 py-2 border rounded" required>
                    </div>
                    <div>
                        <button type="submit" name="change_password" class="px-4 py-2 bg-secondary text-white rounded hover:bg-primary transition">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    const img = preview.querySelector('img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?php
$content = ob_get_clean();
include 'layout.php'; 