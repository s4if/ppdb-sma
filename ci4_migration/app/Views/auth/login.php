<div class="container-fluid vh-100">
    <div class="row h-100">
        <!-- Left Side - Background Image -->
        <div class="col-lg-6 d-none d-lg-block p-0">
            <div class="h-100 d-flex align-items-center justify-content-center" 
                 style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('<?= base_url('assets/images/header.jpg') ?>') center/cover;">
                <div class="text-center text-white px-4">
                    <h1 class="display-4 fw-bold mb-4">PPDB SMAIT Ihsanul Fikri</h1>
                    <p class="lead mb-4">Sistem Penerimaan Peserta Didik Baru Tahun Ajaran <?= esc($tahun_ajaran ?? '2024/2025') ?></p>
                    <div class="d-flex justify-content-center gap-3">
                        <div class="text-center">
                            <h3 class="fw-bold"><?= $total_registrants ?? '0' ?></h3>
                            <p>Pendaftar</p>
                        </div>
                        <div class="text-center">
                            <h3 class="fw-bold"><?= $programs_count ?? '4' ?></h3>
                            <p>Program</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Login Form -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center bg-light">
            <div class="w-100" style="max-width: 400px;">
                <div class="text-center mb-4">
                    <img src="<?= base_url('assets/images/default.png') ?>" alt="Logo" class="mb-3" style="height: 80px;">
                    <h2 class="fw-bold">Selamat Datang</h2>
                    <p class="text-muted">Silakan login untuk melanjutkan</p>
                </div>
                
                <!-- Alert Messages -->
                <?= view('templates/alert') ?>
                
                <!-- Login Form -->
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <!-- Tab Navigation -->
                        <ul class="nav nav-pills nav-justified mb-4" id="loginTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active w-100" id="registrant-tab" data-bs-toggle="pill" 
                                        data-bs-target="#registrant" type="button" role="tab">
                                    <i class="fas fa-user me-2"></i>Pendaftar
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link w-100" id="admin-tab" data-bs-toggle="pill" 
                                        data-bs-target="#admin" type="button" role="tab">
                                    <i class="fas fa-user-shield me-2"></i>Admin
                                </button>
                            </li>
                        </ul>
                        
                        <!-- Tab Content -->
                        <div class="tab-content" id="loginTabContent">
                            <!-- Registrant Login -->
                            <div class="tab-pane fade show active" id="registrant" role="tabpanel">
                                <form action="<?= site_url('auth/loginRegistrant') ?>" method="POST" 
                                      class="needs-validation" novalidate>
                                    <?= csrf_field() ?>
                                    
                                    <div class="mb-3">
                                        <label for="reg-username" class="form-label">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="reg-username" name="username" 
                                                   placeholder="Masukkan username" required>
                                            <div class="invalid-feedback">
                                                Username harus diisi.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="reg-password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="reg-password" name="password" 
                                                   placeholder="Masukkan password" required>
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('reg-password')">
                                                <i class="fas fa-eye" id="reg-password-icon"></i>
                                            </button>
                                            <div class="invalid-feedback">
                                                Password harus diisi.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="reg-remember" name="remember">
                                        <label class="form-check-label" for="reg-remember">
                                            Ingat saya
                                        </label>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-sign-in-alt me-2"></i>Login sebagai Pendaftar
                                        </button>
                                    </div>
                                    
                                    <div class="text-center mt-3">
                                        <small class="text-muted">
                                            Belum punya akun? 
                                            <a href="<?= site_url('auth/register') ?>">Daftar di sini</a>
                                        </small>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Admin Login -->
                            <div class="tab-pane fade" id="admin" role="tabpanel">
                                <form action="<?= site_url('auth/loginAdmin') ?>" method="POST" 
                                      class="needs-validation" novalidate>
                                    <?= csrf_field() ?>
                                    
                                    <div class="mb-3">
                                        <label for="admin-username" class="form-label">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-user-shield"></i>
                                            </span>
                                            <input type="text" class="form-control" id="admin-username" name="username" 
                                                   placeholder="Masukkan username admin" required>
                                            <div class="invalid-feedback">
                                                Username harus diisi.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="admin-password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="admin-password" name="password" 
                                                   placeholder="Masukkan password admin" required>
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('admin-password')">
                                                <i class="fas fa-eye" id="admin-password-icon"></i>
                                            </button>
                                            <div class="invalid-feedback">
                                                Password harus diisi.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-sign-in-alt me-2"></i>Login sebagai Admin
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer Links -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        <a href="<?= site_url('auth/forgot') ?>" class="text-decoration-none">Lupa password?</a> |
                        <a href="<?= site_url('auth/help') ?>" class="text-decoration-none">Bantuan</a>
                    </small>
                </div>
                
                <!-- Copyright -->
                <div class="text-center mt-3">
                    <small class="text-muted">
                        &copy; <?= date('Y') ?> SMAIT Ihsanul Fikri Mungkid. All rights reserved.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const forms = document.querySelectorAll('.needs-validation');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        });
    });
    
    // Auto-focus on first input
    document.getElementById('reg-username').focus();
    
    // Switch tab focus
    document.getElementById('registrant-tab').addEventListener('shown.bs.tab', function() {
        document.getElementById('reg-username').focus();
    });
    
    document.getElementById('admin-tab').addEventListener('shown.bs.tab', function() {
        document.getElementById('admin-username').focus();
    });
});

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(inputId + '-icon');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Add keyboard navigation
document.addEventListener('keydown', function(event) {
    // Alt + 1 for Registrant tab
    if (event.altKey && event.key === '1') {
        document.getElementById('registrant-tab').click();
    }
    // Alt + 2 for Admin tab
    if (event.altKey && event.key === '2') {
        document.getElementById('admin-tab').click();
    }
});
</script>

<style>
.vh-100 {
    min-height: 100vh;
}

.nav-pills .nav-link {
    border-radius: 0.5rem;
}

.nav-pills .nav-link.active {
    background-color: #0d6efd;
}

.card {
    border: none;
    border-radius: 0.5rem;
}

.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
}

.form-control:focus + .input-group-text {
    border-color: #86b7fe;
}

.form-control:focus {
    border-left: none;
}

.btn-outline-secondary:hover {
    border-color: #6c757d;
}

@media (max-width: 991.98px) {
    .container-fluid {
        padding: 2rem 1rem;
    }
    
    .card {
        margin-bottom: 2rem;
    }
}
</style>