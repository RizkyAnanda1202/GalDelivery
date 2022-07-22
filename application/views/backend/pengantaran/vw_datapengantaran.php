
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Pengantaran</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Pengantaran</a></li>
              <li class="breadcrumb-item active" aria-current="page">Beranda</li>
              <li class="breadcrumb-item" aria-current="page">Pengantaran</li>
            </ol>
          </div>
          <?=$this->session->flashdata('message')?>

        <div class="row">
        <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <a class="m-0 font-weight-bold text-primary" href="<?= base_url();?>pengantaran/tambah"><button type="button" class="btn btn-primary mb-1">Tambah Pengantaran</button></a>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Staff</th>
                        <th>Kendaraan</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                        <?php
                          foreach($pengiriman as $s){
                            $kendaraan = $this->Pengantaran_model->kendaraan($s['id_kendaraan']);
                            $staff = $this->Pengantaran_model->staff($s['id_staff']);
                        ?>
                      <tr>
                        <td><?= $s['id_pengiriman'];?></td>
                        <td><?= $s['tgl_pengiriman'];?></td>
                        <td><?= $staff['nama_staff'];?></td>
                        <td><?= $kendaraan['nama_kendaraan'];?></td>
                        <td><?= $s['jumlah_galon'];?></td>
                        <td>
                            <a href="<?= base_url('pengantaran/hapus');?>/<?= $s['id_pengiriman'];?>" style="margin:1px"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></a>
                        </td>
                      </tr>
                      <?php
                          }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
