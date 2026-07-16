<?php require 'views/layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="<?= BASE_URL ?>?page=groups" class="back-link"><i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Kelompok</a>
    
    <div>
        <a href="<?= BASE_URL ?>?page=groups&action=export_excel&id=<?= $group['id'] ?>" class="btn btn-outline-success btn-sm rounded-pill shadow-sm me-2">
            <i class="bi bi-file-earmark-excel-fill me-1"></i> Download Laporan Excel
        </a>
        <a href="<?= BASE_URL ?>?page=groups&action=export_pdf&id=<?= $group['id'] ?>" class="btn btn-outline-danger btn-sm rounded-pill shadow-sm">
            <i class="bi bi-file-earmark-pdf-fill me-1"></i> Download Laporan PDF
        </a>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <span class="badge bg-primary mb-2"><?= escape($group['subject_name']) ?></span>
                <h2 class="fw-bold mb-1"><?= escape($group['name']) ?></h2>
                <p class="text-muted">Dibuat oleh <?= escape($group['creator_name']) ?> &bull; <?= $group['member_count'] ?>/<?= $group['max_members'] ?> Anggota</p>
            </div>
            <div>
                <?php if($is_creator || $is_admin): ?>
                    <a href="<?= BASE_URL ?>?page=groups&action=edit&id=<?= $group['id'] ?>" class="btn btn-outline-primary me-2"><i class="bi bi-pencil"></i> Edit</a>
                    <form action="<?= BASE_URL ?>?page=groups&action=delete" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin membubarkan kelompok ini? Semua jadwal, materi, dan komentar akan terhapus.');">
                        <input type="hidden" name="id" value="<?= $group['id'] ?>">
                        <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Hapus</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <hr>
        <div class="mt-4">
            <h5 class="fw-bold d-flex align-items-center"><i class="bi bi-info-circle-fill text-primary me-2"></i>Tentang Kelompok</h5>
            <?php 
                require_once 'library/Parsedown/Parsedown.php';
                $parsedown = new Parsedown();
                $parsedown->setSafeMode(true); // Protect against XSS
            ?>
            <div class="text-secondary markdown-content" style="line-height: 1.6;">
                <?= $parsedown->text($group['description']) ?>
            </div>
        </div>
        <div class="mt-4">
            <?php if(!$is_member): ?>
                <?php if($group['member_count'] < $group['max_members']): ?>
                    <form action="<?= BASE_URL ?>?page=groups&action=join" method="POST">
                        <input type="hidden" name="id" value="<?= $group['id'] ?>">
                        <button type="submit" class="btn btn-success"><i class="bi bi-box-arrow-in-right me-1"></i> Bergabung dengan Kelompok</button>
                    </form>
                <?php else: ?>
                    <button class="btn btn-secondary" disabled>Kelompok Penuh</button>
                <?php endif; ?>
            <?php else: ?>
                <div class="d-flex align-items-center">
                    <span class="badge bg-success p-2 fs-6 me-3"><i class="bi bi-check-circle me-1"></i> Anda adalah anggota</span>
                    <?php if(!$is_creator): ?>
                    <form action="<?= BASE_URL ?>?page=groups&action=leave" method="POST" onsubmit="return confirm('Yakin ingin keluar dari kelompok ini?');">
                        <input type="hidden" name="id" value="<?= $group['id'] ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm">Keluar Kelompok</button>
                    </form>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if($is_member || $is_admin): ?>
<!-- Tab Navigation -->
<ul class="nav nav-tabs nav-tabs-custom mb-4" id="groupTabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active fw-bold px-4 py-3" id="schedules-tab" data-bs-toggle="tab" data-bs-target="#schedules" type="button" role="tab" aria-controls="schedules" aria-selected="true"><i class="bi bi-calendar-event me-2"></i>Jadwal Belajar</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link fw-bold px-4 py-3" id="materials-tab" data-bs-toggle="tab" data-bs-target="#materials" type="button" role="tab" aria-controls="materials" aria-selected="false"><i class="bi bi-file-earmark-text me-2"></i>Materi & Catatan</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link fw-bold px-4 py-3" id="members-tab" data-bs-toggle="tab" data-bs-target="#members" type="button" role="tab" aria-controls="members" aria-selected="false"><i class="bi bi-people me-2"></i>Anggota (<?= count($members) ?>)</button>
  </li>
</ul>

<!-- Tab Content -->
<div class="tab-content" id="groupTabsContent">
  <!-- Schedules Tab -->
  <div class="tab-pane fade show active" id="schedules" role="tabpanel" aria-labelledby="schedules-tab">
      <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="mb-0">Jadwal Belajar</h4>
          <a href="<?= BASE_URL ?>?page=schedules&action=create&group_id=<?= $group['id'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus-circle me-1"></i> Buat Jadwal</a>
      </div>
      
      <?php if(empty($schedules)): ?>
          <div class="empty-state">
              <i class="bi bi-calendar-x fs-1 text-muted mb-3 d-block"></i>
              <h5 class="fw-bold">Belum Ada Jadwal</h5>
              <p class="mb-0">Tidak ada jadwal belajar dalam waktu dekat untuk kelompok ini.</p>
          </div>
      <?php else: ?>
          <div class="row">
              <?php foreach($schedules as $sch): ?>
              <div class="col-md-6 mb-3">
                  <div class="card h-100 border-start border-4 <?= strtotime($sch['start_time']) > time() ? 'border-primary' : 'border-secondary' ?>">
                      <div class="card-body">
                          <h5 class="fw-bold"><?= escape($sch['title']) ?></h5>
                          <p class="text-muted small mb-2">
                              <i class="bi bi-clock me-1"></i> <?= date('d M Y, H:i', strtotime($sch['start_time'])) ?> - <?= date('H:i', strtotime($sch['end_time'])) ?>
                          </p>
                          <?php if($sch['location']): ?>
                              <p class="small mb-1"><i class="bi bi-geo-alt me-1"></i> <?= escape($sch['location']) ?></p>
                          <?php endif; ?>
                          <?php if($sch['meeting_link']): ?>
                              <p class="small mb-2"><i class="bi bi-camera-video me-1"></i> <a href="<?= escape($sch['meeting_link']) ?>" target="_blank">Join Meeting</a></p>
                          <?php endif; ?>
                          <p class="small mt-2"><?= nl2br(escape($sch['description'])) ?></p>
                      </div>
                      <div class="card-footer bg-white border-0 text-end">
                          <a href="<?= BASE_URL ?>?page=schedules&action=edit&id=<?= $sch['id'] ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                          <?php if($sch['created_by'] == $_SESSION['user_id'] || $is_admin || $is_creator): ?>
                          <form action="<?= BASE_URL ?>?page=schedules&action=delete" method="POST" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?');">
                              <input type="hidden" name="id" value="<?= $sch['id'] ?>">
                              <input type="hidden" name="group_id" value="<?= $group['id'] ?>">
                              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                          </form>
                          <?php endif; ?>
                      </div>
                  </div>
              </div>
              <?php endforeach; ?>
          </div>
      <?php endif; ?>
  </div>
  
  <!-- Materials Tab -->
  <div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="materials-tab">
      <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="mb-0">Materi & Catatan</h4>
          <a href="<?= BASE_URL ?>?page=materials&action=create&group_id=<?= $group['id'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-upload me-1"></i> Upload Materi</a>
      </div>
      
      <?php if(empty($materialsWithComments)): ?>
          <div class="empty-state">
              <i class="bi bi-folder-x fs-1 text-muted mb-3 d-block"></i>
              <h5 class="fw-bold">Belum Ada Materi</h5>
              <p class="mb-0">Materi atau catatan belum dibagikan di kelompok ini.</p>
          </div>
      <?php else: ?>
          <div class="accordion" id="materialsAccordion">
              <?php foreach($materialsWithComments as $index => $mat): ?>
              <div class="accordion-item mb-3 border rounded shadow-sm">
                  <h2 class="accordion-header" id="heading<?= $mat['id'] ?>">
                      <button class="accordion-button <?= $index === 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $mat['id'] ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $mat['id'] ?>">
                          <div class="d-flex w-100 justify-content-between align-items-center me-3">
                              <span class="fw-bold"><?= escape($mat['title']) ?></span>
                              <span class="badge bg-secondary rounded-pill"><?= count($mat['comments']) ?> Komentar</span>
                          </div>
                      </button>
                  </h2>
                  <div id="collapse<?= $mat['id'] ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $mat['id'] ?>" data-bs-parent="#materialsAccordion">
                      <div class="accordion-body">
                          <p class="text-muted small">Diunggah oleh <?= escape($mat['uploader_name']) ?> pada <?= date('d M Y, H:i', strtotime($mat['created_at'])) ?></p>
                          <p><?= nl2br(escape($mat['description'])) ?></p>
                          
                          <div class="mb-3">
                              <a href="<?= BASE_URL ?>uploads/materials/<?= escape($mat['file_path']) ?>" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-download me-1"></i> Download/Preview File</a>
                              
                              <?php if($mat['uploaded_by'] == $_SESSION['user_id'] || $is_admin || $is_creator): ?>
                              <form action="<?= BASE_URL ?>?page=materials&action=delete" method="POST" class="d-inline ms-2" onsubmit="return confirm('Hapus materi ini beserta semua komentarnya?');">
                                  <input type="hidden" name="id" value="<?= $mat['id'] ?>">
                                  <input type="hidden" name="group_id" value="<?= $group['id'] ?>">
                                  <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> Hapus Materi</button>
                              </form>
                              <?php endif; ?>
                          </div>
                          
                          <hr>
                          <h6 class="fw-bold"><i class="bi bi-chat-text me-1"></i> Diskusi</h6>
                          
                          <div class="comments-list mt-3">
                              <?php foreach($mat['comments'] as $c): ?>
                                  <div class="d-flex mb-3">
                                      <div class="flex-shrink-0">
                                          <?php if(!empty($c['profile_photo']) && file_exists('uploads/profiles/' . $c['profile_photo'])): ?>
                                              <img src="uploads/profiles/<?= escape($c['profile_photo']) ?>" alt="Profile Photo" class="rounded-circle object-fit-cover shadow-sm border border-2 border-white" style="width: 40px; height: 40px;">
                                          <?php else: ?>
                                              <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm border border-2 border-white" style="width: 40px; height: 40px;">
                                                  <?= strtoupper(substr($c['user_name'], 0, 1)) ?>
                                              </div>
                                          <?php endif; ?>
                                      </div>
                                      <div class="flex-grow-1 ms-3">
                                          <div class="bg-light p-2 rounded">
                                              <div class="d-flex justify-content-between align-items-center mb-1">
                                                  <span class="fw-bold small"><?= escape($c['user_name']) ?></span>
                                                  <small class="text-muted" style="font-size: 0.75rem;"><?= date('d M H:i', strtotime($c['created_at'])) ?></small>
                                              </div>
                                              <p class="mb-0 small"><?= nl2br(escape($c['comment_text'])) ?></p>
                                          </div>
                                          <?php if($c['user_id'] == $_SESSION['user_id'] || $is_admin): ?>
                                              <div class="mt-1 text-end">
                                                  <form action="<?= BASE_URL ?>?page=comments&action=delete" method="POST" class="d-inline" onsubmit="return confirm('Hapus komentar?');">
                                                      <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                                      <input type="hidden" name="group_id" value="<?= $group['id'] ?>">
                                                      <button type="submit" class="btn btn-link text-danger p-0 small text-decoration-none" style="font-size: 0.75rem;">Hapus</button>
                                                  </form>
                                              </div>
                                          <?php endif; ?>
                                      </div>
                                  </div>
                              <?php endforeach; ?>
                              
                              <form action="<?= BASE_URL ?>?page=comments&action=create" method="POST" class="mt-3 d-flex">
                                  <input type="hidden" name="material_id" value="<?= $mat['id'] ?>">
                                  <input type="hidden" name="group_id" value="<?= $group['id'] ?>">
                                  <input type="text" class="form-control me-2" name="comment_text" placeholder="Tulis komentar..." required>
                                  <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i></button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
              <?php endforeach; ?>
          </div>
      <?php endif; ?>
  </div>
  
  <!-- Members Tab -->
  <div class="tab-pane fade" id="members" role="tabpanel" aria-labelledby="members-tab">
      <div class="card shadow-sm border-0">
          <ul class="list-group list-group-flush">
              <?php foreach($members as $m): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <div class="d-flex align-items-center">
                      <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                          <?= strtoupper(substr($m['user_name'], 0, 1)) ?>
                      </div>
                      <div>
                          <h6 class="mb-0"><?= escape($m['user_name']) ?></h6>
                          <small class="text-muted"><?= escape($m['user_email']) ?></small>
                      </div>
                  </div>
                  <div>
                      <?php if($m['user_id'] == $group['created_by']): ?>
                          <span class="badge bg-primary">Pembuat</span>
                      <?php elseif($m['role_in_group'] == 'mentor'): ?>
                          <span class="badge bg-info">Mentor</span>
                      <?php else: ?>
                          <span class="badge bg-light text-dark border">Anggota</span>
                      <?php endif; ?>
                  </div>
              </li>
              <?php endforeach; ?>
          </ul>
      </div>
  </div>
</div>
<?php else: ?>
<div class="alert alert-info border-0 shadow-sm text-center p-5 mt-4">
    <i class="bi bi-lock-fill fs-1 text-info mb-3 d-block"></i>
    <h4 class="fw-bold">Konten Kelompok Terkunci</h4>
    <p class="mb-0">Anda harus bergabung dengan kelompok ini untuk melihat jadwal, materi, dan ikut berdiskusi.</p>
</div>
<?php endif; ?>

<?php require 'views/layouts/footer.php'; ?>
