<!-- Header -->
<header class="fixed top-0 left-0 right-0 bg-white/90 shadow-lg border-b border-gray-200 backdrop-blur-md z-50 transition-all duration-300" id="mainHeader">
    <nav class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">
            <a class="flex-shrink-0 group" href="<?php echo BASE_URL; ?>/index.php?page=home">
                <img src="<?php echo BASE_URL; ?>/assets/images/logo/cleanesta-logo.png" alt="Cleanesta Cleaning Logo" class="h-14 transition-transform duration-300 group-hover:scale-105">
            </a>

            <button class="lg:hidden p-2 rounded-full border border-gray-200 bg-white shadow hover:bg-primary hover:text-white focus:outline-none transition-all duration-300" type="button" id="mobileMenuButton" aria-label="Toggle navigation">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="hidden lg:flex lg:items-center lg:space-x-6 xl:space-x-10 font-medium text-base" id="mainNav">
                <a class="text-gray-800 px-2 py-1 rounded transition-all duration-200 hover:text-[var(--color-primary)] hover:underline underline-offset-8 decoration-2" href="<?php echo BASE_URL; ?>/index.php?page=home">Home</a>
                <a class="text-gray-800 px-2 py-1 rounded transition-all duration-200 hover:text-[var(--color-primary)] hover:underline underline-offset-8 decoration-2" href="<?php echo BASE_URL; ?>/index.php?page=services">Services</a>
                <a class="text-gray-800 px-2 py-1 rounded transition-all duration-200 hover:text-[var(--color-primary)] hover:underline underline-offset-8 decoration-2" href="<?php echo BASE_URL; ?>/index.php?page=about">About</a>
                <a class="text-gray-800 px-2 py-1 rounded transition-all duration-200 hover:text-[var(--color-primary)] hover:underline underline-offset-8 decoration-2" href="<?php echo BASE_URL; ?>/index.php?page=process">Process</a>
                <a class="text-gray-800 px-2 py-1 rounded transition-all duration-200 hover:text-[var(--color-primary)] hover:underline underline-offset-8 decoration-2" href="<?php echo BASE_URL; ?>/index.php?page=testimonials">Testimonials</a>
                <a class="text-gray-800 px-2 py-1 rounded transition-all duration-200 hover:text-[var(--color-primary)] hover:underline underline-offset-8 decoration-2" href="<?php echo BASE_URL; ?>/index.php?page=contact">Contact</a>
                <a class="inline-block px-8 py-3 ml-2 rounded-full font-semibold shadow bg-[var(--color-primary)] text-white hover:bg-[var(--color-secondary)] hover:scale-105 hover:brightness-110 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[var(--color-secondary)] focus:ring-offset-2" id="bookNowBtn" href="<?php echo BASE_URL; ?>/index.php?page=booking">
                    Book Now
                </a>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="hidden lg:hidden absolute left-0 right-0 mt-2 bg-white shadow-lg rounded-b-xl border-t border-gray-200" id="mobileMenu">
            <div class="px-4 pt-4 pb-6 space-y-2">
                <a class="block px-3 py-2 rounded text-gray-800 hover:text-[var(--color-primary)] hover:bg-gray-100 font-medium transition-all duration-200" href="<?php echo BASE_URL; ?>/index.php?page=home">Home</a>
                <a class="block px-3 py-2 rounded text-gray-800 hover:text-[var(--color-primary)] hover:bg-gray-100 font-medium transition-all duration-200" href="<?php echo BASE_URL; ?>/index.php?page=services">Services</a>
                <a class="block px-3 py-2 rounded text-gray-800 hover:text-[var(--color-primary)] hover:bg-gray-100 font-medium transition-all duration-200" href="<?php echo BASE_URL; ?>/index.php?page=about">About</a>
                <a class="block px-3 py-2 rounded text-gray-800 hover:text-[var(--color-primary)] hover:bg-gray-100 font-medium transition-all duration-200" href="<?php echo BASE_URL; ?>/index.php?page=process">Process</a>
                <a class="block px-3 py-2 rounded text-gray-800 hover:text-[var(--color-primary)] hover:bg-gray-100 font-medium transition-all duration-200" href="<?php echo BASE_URL; ?>/index.php?page=testimonials">Testimonials</a>
                <a class="block px-3 py-2 rounded text-gray-800 hover:text-[var(--color-primary)] hover:bg-gray-100 font-medium transition-all duration-200" href="<?php echo BASE_URL; ?>/index.php?page=contact">Contact</a>
                <a class="block w-full text-center px-6 py-3 mt-2 rounded-full font-semibold shadow bg-[var(--color-primary)] text-white hover:bg-[var(--color-secondary)] hover:scale-105 hover:brightness-110 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[var(--color-secondary)] focus:ring-offset-2" id="bookNowBtnMobile" href="<?php echo BASE_URL; ?>/index.php?page=booking">
                    Book Now
                </a>
            </div>
        </div>
    </nav>
</header>

<!-- Add margin to prevent content from hiding under fixed header -->
<div class="h-20"></div>
