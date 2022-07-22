
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Staff</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Staff</a></li>
              <li class="breadcrumb-item active" aria-current="page">Beranda</li>
              <li class="breadcrumb-item" aria-current="page">Staff</li>
            </ol>
          </div>
          <?=$this->session->flashdata('message')?>

        <div class="row">
        <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <a class="m-0 font-weight-bold text-primary" href="<?= base_url();?>staff/tambah"><button type="button" class="btn btn-primary mb-1">Tambah Staff</button></a>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Hp</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                          foreach($staff as $s){
                        ?>
                      <tr>
                        <td><?= $s['id_staff'];?></td>
                        <td><?= $s['nama_staff'];?></td>
                        <td><?= $s['alamat_staff'];?></td>
                        <td><?= $s['nohp_staff'];?></td>
                        <td>
                            <a href="<?= base_url('staff/edit');?>/<?= $s['id_staff'];?>" style="margin:1px"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></button></a>
                            <a href="<?= base_url('staff/hapus');?>/<?= $s['id_staff'];?>" style="margin:1px"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></a>
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
