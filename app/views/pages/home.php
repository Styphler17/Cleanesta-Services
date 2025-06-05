<?php include_once __DIR__ . '/../components/_home-hero.php'; ?>
<?php include_once __DIR__ . '/../components/_promo.php'; ?>

<script>
    // Hide footer on home page
    document.addEventListener('DOMContentLoaded', function() {
        const footer = document.querySelector('footer');
        if (footer) {
            footer.style.display = 'none';
        }
    });
</script> 