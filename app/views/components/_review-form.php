<!-- Review Submission Form -->
<div class="max-w-lg mx-auto mb-12">
    <div class="relative group">
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-[var(--color-neutral)]/60 to-[var(--color-neutral)]/20 rounded-2xl border border-[var(--color-primary)]/30 group-hover:border-[var(--color-accent)]/60 backdrop-blur-lg transition-all duration-300 shadow-xl group-hover:shadow-2xl"></div>
        <div class="relative z-10 p-8">
            <h3 class="text-2xl font-semibold mb-2 text-center">Share Your Experience</h3>
            <p class="text-gray-600 mb-6 text-center">We'd love to hear about your experience with Cleanesta Cleaning!</p>
            <form action="./index.php?page=testimonials/submit" method="POST" autocomplete="off">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]" required>
                </div>
                <div class="mb-4">
                    <label for="rating" class="block text-gray-700 font-medium mb-2">Rating</label>
                    <select id="rating" name="rating" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]" required>
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="comment" class="block text-gray-700 font-medium mb-2">Comment</label>
                    <textarea id="comment" name="comment" rows="4" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]" required></textarea>
                </div>
                <button type="submit" class="w-full px-6 py-3 text-white bg-[var(--color-primary)] hover:bg-[var(--color-secondary)] transition-colors duration-300 rounded-md font-semibold">
                    Submit Review
                </button>
            </form>
        </div>
    </div>
</div>