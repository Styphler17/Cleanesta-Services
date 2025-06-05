<!-- Services Section -->
<section id="services" class="py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-primary mb-8">
            Our Services
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($services as $service): ?>
                <div class="relative group flex flex-col h-full overflow-hidden rounded-2xl">
                    <div class="absolute inset-0 z-0 bg-gradient-to-br from-white/60 to-white/20 rounded-2xl border border-white/30 group-hover:border-accent/60 backdrop-blur-lg transition-all duration-300 shadow-xl group-hover:shadow-2xl"></div>
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="flex justify-center items-center h-48">
                            <?php
                            $icon = 'fa-broom'; // default
                            $name = strtolower($service['name']);
                            if (strpos($name, 'regular') !== false) $icon = 'fa-home';
                            elseif (strpos($name, 'deep') !== false) $icon = 'fa-soap';
                            elseif (strpos($name, 'move') !== false) $icon = 'fa-truck-moving';
                            elseif (strpos($name, 'office') !== false) $icon = 'fa-building';
                            elseif (strpos($name, 'carpet') !== false) $icon = 'fa-rug';
                            elseif (strpos($name, 'vacuum') !== false) $icon = 'fa-wind';
                            elseif (strpos($name, 'tenancy') !== false) $icon = 'fa-key';
                            ?>
                            <div class="w-24 h-24 rounded-full bg-secondary/30 flex items-center justify-center shadow-md">
                                <i class="fas <?php echo $icon; ?> text-4xl text-secondary"></i>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h4 class="text-xl font-semibold text-accent mb-2 flex items-center gap-2">
                                <?php echo $service['name']; ?>
                            </h4>
                            <p class="text-gray-700 mb-4 flex-grow">
                                <?php echo $service['description']; ?>
                            </p>
                            <ul class="text-sm text-gray-600 space-y-1 mb-6">
                                <li><span class="font-semibold">Duration:</span> <?php echo $service['duration_minutes']; ?> minutes</li>
                                <li><span class="font-semibold">Price:</span> $<?php echo number_format($service['base_price'], 2); ?></li>
                            </ul>
                            <div class="mt-auto">
                                <a href="./index.php?page=booking&service=<?php echo $service['id']; ?>" class="block w-full text-center py-3 px-4 text-[var(--color-primary)] bg-secondary hover:bg-accent transition-colors duration-300 rounded-md shadow-md hover:shadow-lg">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>