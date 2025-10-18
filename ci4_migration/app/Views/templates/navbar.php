<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand" href="<?= site_url() ?>">
            <strong>PPDB SMAIT Ihsanul Fikri Mungkid</strong>
        </a>
        
        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left side menu -->
            <ul class="navbar-nav me-auto">
                <?php if(!empty($registrant)) :?>
                <li class="nav-item" id="navHome">
                    <a class="nav-link" href="<?= site_url($id.'/beranda') ?>">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>
                <?php if((!$registrant->getFinalized())&&(!is_null($registrant->getPaymentData()))):?>
                <li class="nav-item" id="navFormulir">
                    <a class="nav-link" href="<?= site_url($id.'/formulir') ?>">
                        <i class="fas fa-edit me-1"></i> Isi Data
                    </a>
                </li>
                <li class="nav-item" id="navWali">
                    <a class="nav-link" href="<?= site_url($id.'/wali') ?>">
                        <i class="fas fa-users me-1"></i> Isi Wali
                    </a>
                </li>
                <li class="nav-item" id="navLetter">
                    <a class="nav-link" href="<?= site_url($id.'/surat') ?>">
                        <i class="fas fa-file-contract me-1"></i> Surat Pernyataan
                    </a>
                </li>
                <?php endif;?>
                <li class="nav-item" id="navRecap">
                    <a class="nav-link" href="<?= site_url($id.'/rekap') ?>">
                        <i class="fas fa-list me-1"></i> Rekap
                    </a>
                </li>
                <?php endif;?>
                
                <?php if(!empty($admin)) :?>
                <li class="nav-item" id="navHomeAdmin">
                    <a class="nav-link" href="<?= site_url('admin/beranda') ?>">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item" id="navRegistrantAdmin">
                    <a class="nav-link" href="<?= site_url('admin/lihat') ?>">
                        <i class="fas fa-users me-1"></i> Lihat Pendaftar
                    </a>
                </li>
                <li class="nav-item" id="navPaymentAdmin">
                    <a class="nav-link" href="<?= site_url('admin/pembayaran') ?>">
                        <i class="fas fa-money-bill-wave me-1"></i> Lihat Pembayaran
                    </a>
                </li>
                <li class="nav-item" id="navAchievementAdmin">
                    <a class="nav-link" href="<?= site_url('admin/prestasi') ?>">
                        <i class="fas fa-trophy me-1"></i> Lihat Prestasi
                    </a>
                </li>
                <?php endif;?>
            </ul>
            
            <!-- Right side menu -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i> 
                        <strong><?= esc($username ?? 'User') ?></strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <?php if(!empty($registrant)) :?>
                        <li>
                            <a class="dropdown-item" href="<?= site_url($id.'/password') ?>">
                                <i class="fas fa-key me-1"></i> Kata Sandi
                            </a>
                        </li>
                        <?php endif;?>
                        <?php if(!empty($admin)) :?>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('admin/password') ?>">
                                <i class="fas fa-key me-1"></i> Kata Sandi
                            </a>
                        </li>
                        <?php endif;?>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('login/do_logout') ?>">
                                <i class="fas fa-sign-out-alt me-1"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set active nav item
    const activeNavId = 'nav<?= ucfirst($nav_pos ?? 'Home') ?>';
    const activeNav = document.getElementById(activeNavId);
    if (activeNav) {
        activeNav.classList.add('active');
    }
});
</script>