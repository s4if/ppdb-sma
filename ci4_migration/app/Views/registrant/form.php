<div class="container-fluid main-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Formulir Pendaftaran
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Silakan lengkapi data diri Anda dengan benar. Data yang telah disimpan dapat diedit kembali sebelum finalisasi.</p>
                    
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold">Progress Pengisian</span>
                            <span class="fw-bold" id="progress-text">0%</span>
                        </div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar" id="progress-bar" role="progressbar" 
                                 style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                0%
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form with HTMX -->
                    <form id="registration-form" 
                          hx-post="<?= site_url('registrant/save/'.$id) ?>" 
                          hx-target="#form-result" 
                          hx-indicator="#loading-indicator"
                          class="needs-validation" 
                          novalidate>
                        
                        <!-- Personal Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-user me-2"></i>Informasi Pribadi
                                </h6>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="<?= esc($registrant->getName() ?? '') ?>" required>
                                <div class="invalid-feedback">
                                    Nama lengkap harus diisi.
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="nisn" class="form-label">NISN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nisn" name="nisn" 
                                       value="<?= esc($registrant->getNisn() ?? '') ?>" 
                                       pattern="[0-9]{10}" maxlength="10" required>
                                <div class="invalid-feedback">
                                    NISN harus 10 digit angka.
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" <?= ($registrant->getGender() ?? '') === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="P" <?= ($registrant->getGender() ?? '') === 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Jenis kelamin harus dipilih.
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="previous_school" class="form-label">Asal Sekolah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="previous_school" name="previous_school" 
                                       value="<?= esc($registrant->getPreviousSchool() ?? '') ?>" required>
                                <div class="invalid-feedback">
                                    Asal sekolah harus diisi.
                                </div>
                            </div>
                        </div>
                        
                        <!-- Program Selection -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-graduation-cap me-2"></i>Pilihan Program
                                </h6>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="program" class="form-label">Program Studi <span class="text-danger">*</span></label>
                                <select class="form-select" id="program" name="program" required>
                                    <option value="">Pilih Program</option>
                                    <option value="Reguler IPA" <?= ($registrant->getProgram() ?? '') === 'Reguler IPA' ? 'selected' : '' ?>>Reguler IPA</option>
                                    <option value="Reguler IPS" <?= ($registrant->getProgram() ?? '') === 'Reguler IPS' ? 'selected' : '' ?>>Reguler IPS</option>
                                    <option value="Tahfidz IPA" <?= ($registrant->getProgram() ?? '') === 'Tahfidz IPA' ? 'selected' : '' ?>>Tahfidz IPA</option>
                                    <option value="Tahfidz IPS" <?= ($registrant->getProgram() ?? '') === 'Tahfidz IPS' ? 'selected' : '' ?>>Tahfidz IPS</option>
                                </select>
                                <div class="invalid-feedback">
                                    Program studi harus dipilih.
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="selection_path" class="form-label">Jalur Seleksi <span class="text-danger">*</span></label>
                                <select class="form-select" id="selection_path" name="selection_path" required>
                                    <option value="">Pilih Jalur Seleksi</option>
                                    <option value="Reguler" <?= ($registrant->getSelectionPath() ?? '') === 'Reguler' ? 'selected' : '' ?>>Reguler</option>
                                    <option value="Prestasi" <?= ($registrant->getSelectionPath() ?? '') === 'Prestasi' ? 'selected' : '' ?>>Prestasi</option>
                                    <option value="Beasiswa" <?= ($registrant->getSelectionPath() ?? '') === 'Beasiswa' ? 'selected' : '' ?>>Beasiswa</option>
                                </select>
                                <div class="invalid-feedback">
                                    Jalur seleksi harus dipilih.
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-phone me-2"></i>Informasi Kontak
                                </h6>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="cp" class="form-label">No. HP/WhatsApp <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="cp" name="cp" 
                                       value="<?= esc($registrant->getCp() ?? '') ?>" 
                                       pattern="[0-9]{10,13}" required>
                                <div class="invalid-feedback">
                                    No. HP harus 10-13 digit angka.
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= esc($registrant->getEmail() ?? '') ?>">
                                <div class="invalid-feedback">
                                    Format email tidak valid.
                                </div>
                            </div>
                        </div>
                        
                        <!-- Submit Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </button>
                                    
                                    <div>
                                        <button type="button" class="btn btn-outline-primary me-2" onclick="saveAsDraft()">
                                            <i class="fas fa-save me-2"></i>Simpan Draft
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-check me-2"></i>Simpan Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Loading Indicator -->
                        <div id="loading-indicator" class="htmx-indicator">
                            <div class="text-center mt-3">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2">Menyimpan data...</p>
                            </div>
                        </div>
                        
                        <!-- Form Result -->
                        <div id="form-result" class="mt-3"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    updateProgress();
    
    // Update progress on form change
    const formInputs = document.querySelectorAll('#registration-form input, #registration-form select');
    formInputs.forEach(input => {
        input.addEventListener('change', updateProgress);
        input.addEventListener('input', updateProgress);
    });
});

function updateProgress() {
    const form = document.getElementById('registration-form');
    const inputs = form.querySelectorAll('input[required], select[required]');
    let filled = 0;
    
    inputs.forEach(input => {
        if (input.value.trim() !== '') {
            filled++;
        }
    });
    
    const progress = Math.round((filled / inputs.length) * 100);
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');
    
    progressBar.style.width = progress + '%';
    progressBar.setAttribute('aria-valuenow', progress);
    progressBar.textContent = progress + '%';
    progressText.textContent = progress + '%';
    
    // Update progress bar color based on progress
    progressBar.className = 'progress-bar';
    if (progress === 100) {
        progressBar.classList.add('bg-success');
    } else if (progress >= 50) {
        progressBar.classList.add('bg-info');
    } else {
        progressBar.classList.add('bg-warning');
    }
}

function saveAsDraft() {
    const form = document.getElementById('registration-form');
    
    // Remove required attributes for draft save
    const requiredInputs = form.querySelectorAll('[required]');
    requiredInputs.forEach(input => {
        input.removeAttribute('required');
    });
    
    // Submit form
    htmx.trigger(form, 'submit');
    
    // Restore required attributes
    setTimeout(() => {
        requiredInputs.forEach(input => {
            input.setAttribute('required', '');
        });
    }, 100);
}

// Handle HTMX response
document.body.addEventListener('htmx:afterRequest', function(evt) {
    if (evt.detail.successful) {
        const response = evt.detail.xhr.response;
        if (response.includes('success')) {
            showToast('Data berhasil disimpan!', 'success');
            updateProgress();
        }
    }
});
</script>