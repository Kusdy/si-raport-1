    <?= $this->extend('layouts/auth/main-login'); ?>
    <?= $this->section('content'); ?>

    <!-- Content -->
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-4">
                <a href="#" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="<?= base_url() ?>template/assets/img/school.png" alt="" style="width: 80px;">
                  </span>
                  <!-- <span class="demo text-body fw-bolder" style="font-size: 25px;">SI Raport</span> -->
                </a>
              </div>
              <!-- /Logo -->
              <h4 align="center" class="mb-2">Selamat Datang!</h4>
              <p align="center" class="mb-4">Silahkan lakukan proses login terlebih dahulu</p>

              <form id="formAuthentication" class="mb-3" action="<?= base_url('login') ?>" method="post">
                <?= $this->include('components/alerts') ?>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="Masukkan email anda"
                  autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="auth-forgot-password-basic.html">
                      <!-- <small>Forgot Password?</small> -->
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>

              <p class="text-center">
                <span>&copy; 2023</span>
                <a href="#">
                  <span>SMK Tugas Perkasa Siliwangi</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
    <!-- / Content -->

    <?= $this->endSection(); ?>