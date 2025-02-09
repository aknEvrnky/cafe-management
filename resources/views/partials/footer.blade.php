<footer class="bg-dark text-white py-4 mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <h5 class="mb-3">{{ config('app.name') }}</h5>
                <p class="mb-0 text-muted">
                    Lezzetli yemekler ve keyifli anlar için doğru adres.
                    Menümüzü inceleyin ve favori lezzetlerinizi keşfedin.
                </p>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <h5 class="mb-3">Hızlı Linkler</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-muted text-decoration-none hover-white">
                            <i class="bi bi-chevron-right"></i> Menü
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-muted text-decoration-none hover-white">
                            <i class="bi bi-chevron-right"></i> Kategoriler
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-muted text-decoration-none hover-white">
                            <i class="bi bi-chevron-right"></i> Hakkımızda
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-muted text-decoration-none hover-white">
                            <i class="bi bi-chevron-right"></i> İletişim
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="mb-3">İletişim</h5>
                <ul class="list-unstyled text-muted">
                    <li class="mb-2">
                        <i class="bi bi-geo-alt me-2"></i> Örnek Mahallesi, Örnek Sokak No:1
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone me-2"></i> +90 555 555 55 55
                    </li>
                    <li>
                        <i class="bi bi-envelope me-2"></i> info@example.com
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-4">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <small class="text-muted">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. Tüm hakları saklıdır.
                </small>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-muted text-decoration-none me-3">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" class="text-muted text-decoration-none me-3">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="#" class="text-muted text-decoration-none">
                    <i class="bi bi-twitter"></i>
                </a>
            </div>
        </div>
    </div>
</footer>

<style>
.hover-white:hover {
    color: white !important;
    transition: color 0.2s ease-in-out;
}
</style>
