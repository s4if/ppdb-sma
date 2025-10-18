<div class="container-fluid main-wrapper">
    <div class="row">
        <div class="col-12">
            <!-- Welcome Card -->
            <div class="card mb-4 fade-in">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-home me-2"></i>Selamat Datang, <?= esc($registrant->getName() ?? $username) ?>
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Selamat datang di Sistem Penerimaan Peserta Didik Baru SMAIT Ihsanul Fikri Mungkid.
                        Silakan lengkapi data diri Anda untuk melanjutkan proses pendaftaran.
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama:</strong> <?= esc($registrant->getName() ?? '-') ?></p>
                            <p><strong>Username:</strong> <?= esc($username) ?></p>
                            <p><strong>Program:</strong> <?= esc($registrant->getProgram() ?? '-') ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong> 
                                <span class="badge bg-<?= $status === 'Lengkap' ? 'success' : 'warning' ?>">
                                    <?= esc($status) ?>
                                </span>
                            </p>
                            <p><strong>Tahun Ajaran:</strong> <?= esc($tahun_ajaran) ?></p>
                            <p><strong>Gelombang:</strong> <?= esc($nama_gelombang) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Registration Status -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Status Pendaftaran
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Data Diri</span>
                        <span class="badge bg-<?= $registrant->getName() ? 'success' : 'secondary' ?>">
                            <?= $registrant->getName() ? 'Lengkap' : 'Belum' ?>
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Data Orang Tua</span>
                        <span class="badge bg-secondary">Belum</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Pembayaran</span>
                        <span class="badge bg-<?= $registrant->getPaymentData() ? 'success' : 'secondary' ?>">
                            <?= $registrant->getPaymentData() ? 'Lengkap' : 'Belum' ?>
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Finalisasi</span>
                        <span class="badge bg-<?= $registrant->getFinalized() ? 'success' : 'secondary' ?>">
                            <?= $registrant->getFinalized() ? 'Selesai' : 'Belum' ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-tasks me-2"></i>Aksi Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <?php if((!$registrant->getFinalized())&&(!is_null($registrant->getPaymentData()))):?>
                        <div class="col-md-4">
                            <a href="<?= site_url($id.'/formulir') ?>" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-edit fa-2x mb-2"></i>
                                Isi Data Diri
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= site_url($id.'/wali') ?>" class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                Isi Data Wali
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= site_url($id.'/surat') ?>" class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-file-contract fa-2x mb-2"></i>
                                Surat Pernyataan
                            </a>
                        </div>
                        <?php endif;?>
                        <div class="col-md-4">
                            <a href="<?= site_url($id.'/rekap') ?>" class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-list fa-2x mb-2"></i>
                                Lihat Rekap
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= site_url($id.'/password') ?>" class="btn btn-outline-secondary w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-key fa-2x mb-2"></i>
                                Ubah Password
                            </a>
                        </div>
                        <div class="col-md-4">
                            <button onclick="printElement('print-area')" class="btn btn-outline-dark w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-print fa-2x mb-2"></i>
                                Cetak Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Information Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-bullhorn me-2"></i>Pengumuman Penting
                    </h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Informasi:</strong> Pastikan semua data yang Anda masukkan sudah benar dan dapat dipertanggung jawabkan.
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Perhatian:</strong> Batas akhir pendaftaran adalah tanggal 31 Juli 2024.
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Hidden Print Area -->
    <div id="print-area" class="d-none">
        <h3>Data Pendaftaran</h3>
        <p><strong>Nama:</strong> <?= esc($registrant->getName() ?? '-') ?></p>
        <p><strong>Username:</strong> <?= esc($username) ?></p>
        <p><strong>Program:</strong> <?= esc($registrant->getProgram() ?? '-') ?></p>
        <p><strong>Status:</strong> <?= esc($status) ?></p>
        <p><strong>Tahun Ajaran:</strong> <?= esc($tahun_ajaran) ?></p>
        <p><strong>Gelombang:</strong> <?= esc($nama_gelombang) ?></p>
    </div>
</div>