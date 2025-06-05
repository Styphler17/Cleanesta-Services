<?php
// Fetch settings and contact info from the database
global $connexion;
if ($connexion) {
    // Settings
    $settings = $connexion->query("SELECT setting_key, setting_value FROM settings")->fetchAll(PDO::FETCH_KEY_PAIR);
    // Contact Info
    $contact = $connexion->query("SELECT * FROM contact_info LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    // Business Hours
    $hours = $connexion->query("SELECT * FROM business_hours ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
} else {
    $settings = [];
    $contact = [];
    $hours = [];
}

?>
<!-- Footer -->
<footer class="bg-gradient-to-r from-gray-900 to-gray-800 text-gray-300 pt-12 pb-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Brand Info -->
            <div class="space-y-4">
                <img src="<?php echo $settings['cleanesta-logo'] ?? '/assets/images/logo/cleanesta-logo.png'; ?>" alt="Cleanesta Cleaning Logo" class="h-12">
                <p class="text-gray-400 text-sm">
                    <?php echo $settings['cleanesta-description'] ?? 'Bringing sparkle to your space. Trusted by hundreds for spotless home and office cleaning services.'; ?>
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h6 class="text-white font-bold uppercase mb-4">Quick Links</h6>
                <ul class="space-y-2 text-sm">
                    <li><a href="./index.php?page=home" class="text-gray-400 hover:text-green-500 transition-colors duration-300 hover:pl-2 block">Home</a></li>
                    <li><a href="./index.php?page=services" class="text-gray-400 hover:text-green-500 transition-colors duration-300 hover:pl-2 block">Services</a></li>
                    <li><a href="./index.php?page=about" class="text-gray-400 hover:text-green-500 transition-colors duration-300 hover:pl-2 block">About</a></li>
                    <li><a href="./index.php?page=process" class="text-gray-400 hover:text-green-500 transition-colors duration-300 hover:pl-2 block">Process</a></li>
                    <li><a href="./index.php?page=testimonials" class="text-gray-400 hover:text-green-500 transition-colors duration-300 hover:pl-2 block">Testimonials</a></li>
                    <li><a href="./index.php?page=contact" class="text-gray-400 hover:text-green-500 transition-colors duration-300 hover:pl-2 block">Contact</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h6 class="text-white font-bold uppercase mb-4">Contact</h6>
                <ul class="space-y-3 text-sm text-gray-400">
                    <?php if (!empty($contact['email'])): ?>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-green-500"></i>
                        <a href="mailto:<?php echo $contact['email']; ?>" class="hover:text-green-500 transition-colors duration-300"><?php echo $contact['email']; ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($contact['whatsapp_link'])): ?>
                    <li class="flex items-center">
                        <i class="fab fa-whatsapp mr-3 text-green-500"></i>
                        <a href="<?php echo $contact['whatsapp_link']; ?>" target="_blank" class="hover:text-green-500 transition-colors duration-300">
                            <?php echo preg_replace('/^https:\/\/wa\.me\//', '+', $contact['whatsapp_link']); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Business Hours -->
            <div>
                <h6 class="text-white font-bold uppercase mb-4">Business Hours</h6>
                <ul class="space-y-2 text-sm">
                    <?php if (!empty($hours)): ?>
                        <?php foreach ($hours as $hour): ?>
                            <li>
                                <span class="font-medium text-gray-200"><?php echo $hour['day']; ?>:</span>
                                <?php if ($hour['is_closed']): ?>
                                    <span class="text-red-400 font-semibold ml-1">Closed</span>
                                <?php else: ?>
                                    <span class="ml-1"><?php echo date('g:i A', strtotime($hour['open_time'])) . ' - ' . date('g:i A', strtotime($hour['close_time'])); ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>Not available</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <hr class="border-gray-700 my-8">

        <!-- Bottom -->
        <div class="flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-400 mb-4 md:mb-0">&copy; <?php echo date('Y'); ?> Cleanesta Cleaning. All rights reserved.</p>
            <div class="flex space-x-6">
                <a href="./index.php?page=privacy" class="text-sm text-gray-400 hover:text-green-500 transition-colors duration-300">Privacy Policy</a>
                <a href="./index.php?page=terms" class="text-sm text-gray-400 hover:text-green-500 transition-colors duration-300">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="backToTop" class="hidden fixed bottom-8 right-8 z-50 bg-primary text-white p-3 rounded-full shadow-lg hover:bg-secondary transition-colors duration-300" aria-label="Back to top">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
    </svg>
</button>

<!-- JS: Back to Top Button and Animations -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopButton = document.getElementById('backToTop');

        if (backToTopButton) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    backToTopButton.classList.remove('hidden');
                    backToTopButton.classList.add('block');
                } else {
                    backToTopButton.classList.add('hidden');
                    backToTopButton.classList.remove('block');
                }
            });

            backToTopButton.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    });
</script>