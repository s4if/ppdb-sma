<div class="container-fluid main-wrapper">
    <div class="row">
        <div class="col-12">
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Pendaftar
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_registrants ?? 0 ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Pembayaran Terverifikasi
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $verified_payments ?? 0 ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Menunggu Verifikasi
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pending_verifications ?? 0 ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Data Lengkap
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $complete_profiles ?? 0 ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Registrants -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pendaftar Terbaru</h6>
                    <a href="<?= site_url('admin/lihat') ?>" class="btn btn-sm btn-primary">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="recent-registrants">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Program</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($recent_registrants) && count($recent_registrants) > 0): ?>
                                    <?php $no = 1; foreach($recent_registrants as $registrant): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($registrant->getName() ?? '-') ?></td>
                                        <td><?= esc($registrant->getProgram() ?? '-') ?></td>
                                        <td>
                                            <span class="badge bg-<?= $registrant->getFinalized() ? 'success' : 'warning' ?>">
                                                <?= $registrant->getFinalized() ? 'Lengkap' : 'Belum' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="<?= site_url('admin/detail/'.$registrant->getId()) ?>" 
                                                   class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?= site_url('admin/edit/'.$registrant->getId()) ?>" 
                                                   class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data pendaftar</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Info -->
        <div class="col-lg-4 mb-4">
            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?= site_url('admin/lihat') ?>" class="btn btn-primary">
                            <i class="fas fa-users me-2"></i>Daftar Pendaftar
                        </a>
                        <a href="<?= site_url('admin/pembayaran') ?>" class="btn btn-success">
                            <i class="fas fa-money-bill-wave me-2"></i>Verifikasi Pembayaran
                        </a>
                        <a href="<?= site_url('admin/prestasi') ?>" class="btn btn-info">
                            <i class="fas fa-trophy me-2"></i>Data Prestasi
                        </a>
                        <a href="<?= site_url('admin/export') ?>" class="btn btn-warning">
                            <i class="fas fa-download me-2"></i>Export Data
                        </a>
                    </div>
                </div>
            </div>

            <!-- System Info -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Sistem</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="small text-gray-500">Tahun Ajaran</div>
                        <div class="fw-bold"><?= esc($tahun_ajaran ?? '-') ?></div>
                    </div>
                    <div class="mb-3">
                        <div class="small text-gray-500">Gelombang</div>
                        <div class="fw-bold"><?= esc($nama_gelombang ?? '-') ?></div>
                    </div>
                    <div class="mb-3">
                        <div class="small text-gray-500">Status Pendaftaran</div>
                        <div class="fw-bold">
                            <span class="badge bg-success">Aktif</span>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">Server Time</div>
                        <div class="fw-bold"><?= date('d-m-Y H:i:s') ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize DataTable for recent registrants
    $('#recent-registrants').DataTable({
        responsive: true,
        pageLength: 5,
        lengthChange: false,
        searching: false,
        info: false,
        language: {
            emptyTable: "Belum ada data pendaftar",
            zeroRecords: "Tidak ada data yang cocok",
            paginate: {
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        }
    });
});
</script>