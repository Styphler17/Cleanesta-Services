<!-- Hero Section -->
<section id="home" class="container-fluid relative flex items-center justify-center min-h-screen bg-gradient-to-br from-[var(--color-primary)]/80 to-[var(--color-secondary)]/80">
    <!-- Background Image -->
    <div class="absolute inset-0 w-full h-full bg-[url('<?php echo BASE_URL; ?>/assets/images/hero/hero-bg.png')] bg-center bg-cover bg-no-repeat"></div>

    <!-- Glassmorphism Overlay -->
    <div class="absolute inset-0 w-full h-full bg-white/30 backdrop-blur-md"></div>

    <!-- Content -->
    <div class="container mx-auto relative z-10 text-center px-4">
        <div class="max-w-4xl mx-auto">
            <div class="animate-fadeInUp">
                <h1 class="text-5xl md:text-7xl font-extrabold mb-4 uppercase text-[var(--color-primary)] drop-shadow-lg tracking-tight">
                    Cleanesta Services
                </h1>
                <p class="text-2xl md:text-3xl italic mb-4 text-[var(--color-dark)] font-medium">
                    "Spotless Every Time"
                </p>
                <p class="text-xl md:text-2xl mb-10 text-gray-700 font-light">
                    Professional cleaning services for your home, office, and events
                </p>
                <a href="./index.php?page=services" class="inline-block px-10 py-5 text-xl font-bold text-white bg-[var(--color-secondary)] hover:bg-[var(--color-primary)] shadow-xl rounded-full transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-[var(--color-primary)] focus:ring-offset-2">
                    Check Our Services
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(40px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fadeInUp {
        animation: fadeInUp 1.2s ease-out;
    }
</style>