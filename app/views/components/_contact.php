    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-gradient-to-br from-[var(--color-neutral)]/60 to-[var(--color-neutral)]/20 min-h-[60vh]">
        <div class="container mx-auto px-4 flex flex-col items-center justify-center">
            <div class="max-w-2xl w-full mx-auto">
                <div class="bg-white/80 rounded-2xl shadow-xl border border-[var(--color-primary)]/20 p-8 flex flex-col items-center">
                    <h2 class="text-3xl font-bold text-primary mb-6 text-center">Contact Us</h2>
                    <div class="w-full flex flex-col md:flex-row md:justify-between gap-8 mb-8">
                        <div class="flex-1 flex flex-col gap-6">
                            <!-- WhatsApp -->
                            <div class="flex items-center gap-4">
                                <div class="bg-green-100 text-green-600 rounded-full p-3">
                                    <i class="fa-brands fa-whatsapp text-2xl"></i>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-gray-800">WhatsApp</h5>
                                    <?php if (!empty($contactInfo['whatsapp_link'])): ?>
                                        <a href="<?php echo $contactInfo['whatsapp_link']; ?>" target="_blank" class="text-gray-600 hover:text-[var(--color-primary)] underline text-lg">
                                            <?php echo preg_replace('/^https:\/\/wa\.me\//', '+', $contactInfo['whatsapp_link']); ?>
                                        </a>
                                    <?php else: ?>
                                        <p class="text-gray-600">Not available</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="flex items-center gap-4">
                                <div class="bg-orange-100 text-orange-600 rounded-full p-3">
                                    <i class="fas fa-envelope text-2xl"></i>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-gray-800">Email</h5>
                                    <?php if (!empty($contactInfo['email'])): ?>
                                        <a href="mailto:<?php echo $contactInfo['email']; ?>" class="text-gray-600 hover:text-[var(--color-primary)] underline text-lg">
                                            <?php echo $contactInfo['email']; ?>
                                        </a>
                                    <?php else: ?>
                                        <p class="text-gray-600">Not available</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full mt-4">
                        <h5 class="font-semibold text-gray-800 mb-3 text-center">Available Hours</h5>
                        <div class="flex flex-col md:flex-row md:justify-center md:gap-8">
                            <?php if (!empty($businessHours) && is_array($businessHours)): ?>
                                <div class="flex flex-col gap-1 text-center md:text-left">
                                    <?php foreach ($businessHours as $hour): ?>
                                        <p class="text-gray-700 mb-1">
                                            <span class="font-medium text-gray-900"><?php echo $hour['day']; ?>:</span>
                                            <?php if ($hour['is_closed']): ?>
                                                <span class="text-red-500 font-semibold">Closed</span>
                                            <?php else: ?>
                                                <span><?php echo date('g:i A', strtotime($hour['open_time'])) . ' - ' . date('g:i A', strtotime($hour['close_time'])); ?></span>
                                            <?php endif; ?>
                                        </p>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-gray-600">Business hours not available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>