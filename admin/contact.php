<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
require_once '../app/config/params.php';
$pdo = $connexion;

// Fetch all contact info
$stmt = $pdo->query("SELECT * FROM contact_info ORDER BY id ASC");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle add/edit/delete
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add' || $_POST['action'] === 'edit') {
            $whatsapp = $_POST['whatsapp_link'] ?? '';
            $email = $_POST['email'] ?? '';
            if ($_POST['action'] === 'add') {
                $stmt = $pdo->prepare("INSERT INTO contact_info (whatsapp_link, email, created_at, updated_at) VALUES (?, ?, NOW(), NOW())");
                $stmt->execute([$whatsapp, $email]);
            } else {
                $id = $_POST['id'] ?? 0;
                $stmt = $pdo->prepare("UPDATE contact_info SET whatsapp_link=?, email=?, updated_at=NOW() WHERE id=?");
                $stmt->execute([$whatsapp, $email, $id]);
            }
            $success = 'Contact info ' . ($_POST['action'] === 'add' ? 'added' : 'updated') . ' successfully!';
        } elseif ($_POST['action'] === 'delete') {
            $id = $_POST['id'] ?? 0;
            $stmt = $pdo->prepare("DELETE FROM contact_info WHERE id=?");
            $stmt->execute([$id]);
            $success = 'Contact info deleted successfully!';
        }
    }
    // Refresh data
    $stmt = $pdo->query("SELECT * FROM contact_info ORDER BY id ASC");
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

ob_start();
?>
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow p-4 sm:p-8 mt-4 sm:mt-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-primary">Contact Info Management</h1>
        <button onclick="openModal('add')" class="bg-primary text-white py-2 px-4 rounded-lg hover:bg-secondary transition duration-200 w-full sm:w-auto">Add Contact</button>
    </div>
    <?php if ($success): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>
    <!-- Desktop Table -->
    <div class="overflow-x-auto rounded-lg hidden sm:block">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">ID</th>
                    <th class="py-2 px-4 border-b text-left">WhatsApp Link</th>
                    <th class="py-2 px-4 border-b text-left">Email</th>
                    <th class="py-2 px-4 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?php echo $contact['id']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $contact['whatsapp_link']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $contact['email']; ?></td>
                        <td class="py-2 px-4 border-b">
                            <button onclick="openModal('edit', <?php echo $contact['id']; ?>, '<?php echo $contact['whatsapp_link']; ?>', '<?php echo $contact['email']; ?>')" class="text-blue-500 hover:text-blue-700 mr-2">Edit</button>
                            <form method="post" class="inline">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Mobile Card View -->
    <div class="sm:hidden space-y-4">
        <?php foreach ($contacts as $contact): ?>
        <div class="bg-white rounded-lg shadow p-4 flex flex-col gap-2">
            <div class="flex justify-between items-center">
                <span class="font-bold text-primary">Contact #<?php echo $contact['id']; ?></span>
            </div>
            <div class="text-sm text-gray-700">WhatsApp: <?php echo $contact['whatsapp_link']; ?></div>
            <div class="text-sm text-gray-700">Email: <?php echo $contact['email']; ?></div>
            <div class="flex gap-2 mt-2">
                <button onclick="openModal('edit', <?php echo $contact['id']; ?>, '<?php echo $contact['whatsapp_link']; ?>', '<?php echo $contact['email']; ?>')" class="flex-1 px-3 py-2 bg-secondary text-white rounded">Edit</button>
                <form method="post" class="flex-1">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                    <button type="submit" class="w-full px-3 py-2 bg-red-500 text-white rounded" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-xl shadow p-8 max-w-md w-full">
        <h2 id="modalTitle" class="text-xl font-bold text-primary mb-4">Add Contact</h2>
        <form method="post" id="contactForm">
            <input type="hidden" name="action" id="formAction" value="add">
            <input type="hidden" name="id" id="formId" value="">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp Link</label>
                <input type="text" name="whatsapp_link" id="whatsappLink" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg" required>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-secondary transition duration-200">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(action, id = '', whatsapp = '', email = '') {
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('modalTitle').textContent = action === 'add' ? 'Add Contact' : 'Edit Contact';
    document.getElementById('formAction').value = action;
    document.getElementById('formId').value = id;
    document.getElementById('whatsappLink').value = whatsapp;
    document.getElementById('email').value = email;
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>
<?php
$content = ob_get_clean();
include 'layout.php'; 