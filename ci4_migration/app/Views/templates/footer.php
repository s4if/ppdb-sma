<!-- Footer -->
<footer class="bg-dark text-light py-4 mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h5>PPDB SMAIT Ihsanul Fikri Mungkid</h5>
                <p class="text-muted">Sistem Penerimaan Peserta Didik Baru</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="text-muted mb-0">
                    &copy; <?= date('Y') ?> SMAIT Ihsanul Fikri Mungkid. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- JavaScript with optimized loading -->
<!-- jQuery with version cache busting -->
<script src="<?= base_url('assets/js/jquery.min.js?v=3.7.1') ?>" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous"></script>

<!-- Bootstrap 5 JS with version cache busting -->
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js?v=5.3.2') ?>" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- DataTables JS with version cache busting -->
<script src="<?= base_url('assets/js/dataTables.min.js?v=2.0.3') ?>"></script>
<script src="<?= base_url('assets/js/dataTables.bootstrap5.min.js?v=2.0.3') ?>"></script>

<!-- Custom JavaScript with version cache busting -->
<script src="<?= base_url('assets/js/custom.js?v=1.0.0') ?>"></script>

<!-- Performance optimization script -->
<script>
// Use modern event listener with passive option for better performance
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all tooltips with optimized options
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl, {
            trigger: 'hover focus',
            delay: { show: 300, hide: 100 }
        });
    });
    
    // Initialize all popovers with optimized options
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    popoverTriggerList.forEach(function (popoverTriggerEl) {
        new bootstrap.Popover(popoverTriggerEl, {
            trigger: 'focus',
            delay: { show: 300, hide: 100 }
        });
    });
    
    // Lazy load images if browser supports Intersection Observer
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
});

// Service Worker registration for offline support (if available)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            })
            .catch(function(error) {
                console.log('ServiceWorker registration failed: ', error);
            });
    });
}
</script>

</body>
</html>