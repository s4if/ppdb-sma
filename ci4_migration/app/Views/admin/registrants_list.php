<div class="container-fluid main-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-users me-2"></i>Daftar Pendaftar
                    </h5>
                    <div>
                        <button onclick="exportTableToCSV('registrants-table', 'pendaftar.csv')" 
                                class="btn btn-light btn-sm me-2" data-bs-toggle="tooltip" title="Export CSV">
                            <i class="fas fa-file-csv me-1"></i>Export
                        </button>
                        <button onclick="printElement('print-area')" 
                                class="btn btn-light btn-sm" data-bs-toggle="tooltip" title="Cetak">
                            <i class="fas fa-print me-1"></i>Cetak
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="filter-program" class="form-label">Filter Program</label>
                            <select class="form-select form-select-sm" id="filter-program" onchange="filterTable()">
                                <option value="">Semua Program</option>
                                <option value="Reguler IPA">Reguler IPA</option>
                                <option value="Reguler IPS">Reguler IPS</option>
                                <option value="Tahfidz IPA">Tahfidz IPA</option>
                                <option value="Tahfidz IPS">Tahfidz IPS</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filter-status" class="form-label">Filter Status</label>
                            <select class="form-select form-select-sm" id="filter-status" onchange="filterTable()">
                                <option value="">Semua Status</option>
                                <option value="Lengkap">Lengkap</option>
                                <option value="Belum">Belum Lengkap</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filter-payment" class="form-label">Filter Pembayaran</label>
                            <select class="form-select form-select-sm" id="filter-payment" onchange="filterTable()">
                                <option value="">Semua Pembayaran</option>
                                <option value="Sudah">Sudah Bayar</option>
                                <option value="Belum">Belum Bayar</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="search-input" class="form-label">Cari</label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="search-input" 
                                       placeholder="Nama atau NISN..." onkeyup="searchTable()">
                                <button class="btn btn-outline-secondary" type="button" onclick="clearSearch()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover data-table" id="registrants-table">
                            <thead class="table-light">
                                <tr>
                                    <th class="no-sort">No</th>
                                    <th>ID Pendaftaran</th>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Program</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Asal Sekolah</th>
                                    <th>Status</th>
                                    <th>Pembayaran</th>
                                    <th class="no-sort text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="registrants-tbody">
                                <?php if(isset($registrants) && count($registrants) > 0): ?>
                                    <?php $no = 1; foreach($registrants as $registrant): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($registrant->getRegistrationId() ?? 'REG-' . str_pad($registrant->getId(), 5, '0', STR_PAD_LEFT)) ?></td>
                                        <td>
                                            <strong><?= esc($registrant->getName() ?? '-') ?></strong>
                                            <br>
                                            <small class="text-muted"><?= esc($registrant->getCp() ?? '-') ?></small>
                                        </td>
                                        <td><?= esc($registrant->getNisn() ?? '-') ?></td>
                                        <td>
                                            <span class="badge bg-info text-dark"><?= esc($registrant->getProgram() ?? '-') ?></span>
                                        </td>
                                        <td><?= ($registrant->getGender() ?? '') === 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                        <td><?= esc($registrant->getPreviousSchool() ?? '-') ?></td>
                                        <td>
                                            <?php if($registrant->getFinalized()): ?>
                                                <span class="badge bg-success">Lengkap</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">Belum</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($registrant->getPaymentData()): ?>
                                                <?php if($registrant->getPaymentData()->getVerified()): ?>
                                                    <span class="badge bg-success">Terverifikasi</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning">Menunggu</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Belum</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="<?= site_url('admin/detail/'.$registrant->getId()) ?>" 
                                                   class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?= site_url('admin/edit/'.$registrant->getId()) ?>" 
                                                   class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <?php if($registrant->getPaymentData() && !$registrant->getPaymentData()->getVerified()): ?>
                                                <button onclick="verifyPayment(<?= $registrant->getId() ?>)" 
                                                        class="btn btn-outline-success" data-bs-toggle="tooltip" title="Verifikasi Pembayaran">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <?php endif; ?>
                                                <button onclick="deleteRegistrant(<?= $registrant->getId() ?>, '<?= esc($registrant->getName()) ?>')" 
                                                        class="btn btn-outline-danger" data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="10" class="text-center py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada data pendaftar</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Hidden Print Area -->
    <div id="print-area" class="d-none">
        <h3>Daftar Pendaftar PPDB SMAIT Ihsanul Fikri</h3>
        <p>Tanggal Cetak: <?= date('d-m-Y H:i:s') ?></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pendaftaran</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Program</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($registrants) && count($registrants) > 0): ?>
                    <?php $no = 1; foreach($registrants as $registrant): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($registrant->getRegistrationId() ?? 'REG-' . str_pad($registrant->getId(), 5, '0', STR_PAD_LEFT)) ?></td>
                        <td><?= esc($registrant->getName() ?? '-') ?></td>
                        <td><?= esc($registrant->getNisn() ?? '-') ?></td>
                        <td><?= esc($registrant->getProgram() ?? '-') ?></td>
                        <td><?= $registrant->getFinalized() ? 'Lengkap' : 'Belum' ?></td>
                        <td>
                            <?php if($registrant->getPaymentData()): ?>
                                <?php if($registrant->getPaymentData()->getVerified()): ?>
                                    Terverifikasi
                                <?php else: ?>
                                    Menunggu
                                <?php endif; ?>
                            <?php else: ?>
                                Belum
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for Payment Verification -->
<div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifyModalLabel">Verifikasi Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin memverifikasi pembayaran pendaftar ini?</p>
                <form id="verify-form" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" id="registrant-id" name="registrant_id">
                    <div class="mb-3">
                        <label for="verification-notes" class="form-label">Catatan Verifikasi</label>
                        <textarea class="form-control" id="verification-notes" name="notes" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" onclick="submitVerification()">
                    <i class="fas fa-check me-2"></i>Verifikasi
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    initializeDataTables();
});

function filterTable() {
    const program = document.getElementById('filter-program').value;
    const status = document.getElementById('filter-status').value;
    const payment = document.getElementById('filter-payment').value;
    const table = $('#registrants-table').DataTable();
    
    // Apply custom filtering
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        const programMatch = !program || data[4] === program;
        const statusMatch = !status || (status === 'Lengkap' ? data[7].includes('Lengkap') : data[7].includes('Belum'));
        const paymentMatch = !payment || (
            payment === 'Sudah' ? (data[8].includes('Terverifikasi') || data[8].includes('Menunggu')) : 
            payment === 'Belum' ? data[8].includes('Belum') : true
        );
        
        return programMatch && statusMatch && paymentMatch;
    });
    
    table.draw();
}

function searchTable() {
    const searchValue = document.getElementById('search-input').value.toLowerCase();
    const table = $('#registrants-table').DataTable();
    table.search(searchValue).draw();
}

function clearSearch() {
    document.getElementById('search-input').value = '';
    const table = $('#registrants-table').DataTable();
    table.search('').draw();
}

function verifyPayment(registrantId) {
    document.getElementById('registrant-id').value = registrantId;
    const modal = new bootstrap.Modal(document.getElementById('verifyModal'));
    modal.show();
}

function submitVerification() {
    const form = document.getElementById('verify-form');
    const formData = new FormData(form);
    
    fetch('<?= site_url('admin/verifyPayment') ?>', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Pembayaran berhasil diverifikasi!', 'success');
            bootstrap.Modal.getInstance(document.getElementById('verifyModal')).hide();
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showToast('Gagal memverifikasi pembayaran: ' + data.message, 'error');
        }
    })
    .catch(error => {
        showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
        console.error('Error:', error);
    });
}

function deleteRegistrant(registrantId, registrantName) {
    confirmAction(
        `Apakah Anda yakin ingin menghapus data pendaftar "${registrantName}"? Tindakan ini tidak dapat dibatalkan.`,
        function() {
            fetch('<?= site_url('admin/deleteRegistrant') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    registrant_id: registrantId,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Data pendaftar berhasil dihapus!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showToast('Gagal menghapus data: ' + data.message, 'error');
                }
            })
            .catch(error => {
                showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
                console.error('Error:', error);
            });
        }
    );
}
</script>