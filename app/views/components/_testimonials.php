<main class="flex flex-col lg:flex-row items-center lg:items-start relative">
    <!-- Testimonials Carousel (SwiperJS) -->
    <div id="testimonials" class="py-12 flex-1 w-full lg:w-2/3">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="mb-12 text-center">
                <!-- Title and subtitle -->
                <h2 class="text-3xl font-bold mb-2">What Our Clients Say</h2>
                <p class="text-gray-600">Real feedback from our valued clients</p>
            </div>
            <!-- Swiper Carousel -->
            <div class="swiper testimonials-swiper">
                <div class="swiper-wrapper">
                    <?php
                    // Use either $testimonials or $reviews, whichever is available
                    $items = isset($testimonials) ? $testimonials : (isset($reviews) ? $reviews : []);
                    foreach ($items as $item):
                    ?>
                        <div class="swiper-slide">
                            <!-- Testimonial Card -->
                            <div class="relative group h-full flex flex-col items-center">
                                <!-- Glassmorphism background -->
                                <div class="absolute inset-0 z-0 bg-gradient-to-br from-[var(--color-neutral)]/60 to-[var(--color-neutral)]/20 rounded-2xl border border-[var(--color-primary)]/30 group-hover:border-[var(--color-accent)]/60 backdrop-blur-lg transition-all duration-300 shadow-xl group-hover:shadow-2xl"></div>
                                <div class="relative z-10 p-6 flex flex-col h-full w-full max-w-md mx-auto ">
                                    <!-- Star Rating -->
                                    <div class="flex items-center mb-3">
                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                            <i class="fas fa-star <?php echo $i < $item['rating'] ? 'text-yellow-400' : 'text-gray-300'; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <!-- Testimonial Comment -->
                                    <p class="text-gray-700 mb-4 flex-1">“<?php echo $item['comment']; ?>”</p>
                                    <!-- Reviewer Name and Date -->
                                    <div class="flex items-center mt-4">
                                        <div>
                                            <h6 class="font-semibold text-gray-800"><?php echo !empty($item['name']) ? $item['name'] : 'Anonymous'; ?></h6>
                                            <small class="text-gray-500"><?php echo date('F Y', strtotime($item['created_at'])); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Swiper Pagination (dots) -->
                <div class="swiper-pagination mt-6"></div>
            </div>
        </div>
    </div>
    <!-- Review Form Aside (fixed/sticky on desktop, stacked on mobile) -->
    <aside class="w-full lg:w-1/3 lg:sticky lg:top-24 flex-shrink-0 z-20">
        <?php require_once __DIR__ . '/_review-form.php'; ?>
    </aside>
</main>

<!-- SwiperJS CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Initialize Swiper carousel for testimonials
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.testimonials-swiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            slidesPerView: 1,
            spaceBetween: 32,
            breakpoints: {
                768: {
                    slidesPerView: 1,
                },
                1024: {
                    slidesPerView: 1,
                }
            }
        });
    });
</script>