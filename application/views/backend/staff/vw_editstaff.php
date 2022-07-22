  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Staff</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Beranda</li>
              <li class="breadcrumb-item active" aria-current="page">Edit Staff</li>
            </ol>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-body">
                  <?php echo form_open_multipart('');?>

                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" id="nama" aria-describedby="nama" name="nama" value="<?=$staff['nama_staff'];?>"
                        placeholder="Masukkan Nama Staff">
                        <?=form_error('nama', '<small class="text-danger pl-3">', '</small>')?>
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <input type="text" class="form-control" id="alamat" aria-describedby="alamat" name="alamat" value="<?= $staff['alamat_staff'];?>"
                        placeholder="Masukkan Alamat">
                        <?=form_error('alamat', '<small class="text-danger pl-3">', '</small>')?>
                    </div>
                    <div class="form-group">
                      <label for="nohp">No Hp</label>
                      <input type="number" class="form-control" id="nohp" aria-describedby="nohp" name="nohp" value="<?=$staff['nohp_staff'];?>"
                        placeholder="Masukkan No Hp Staff">
                        <?=form_error('nohp', '<small class="text-danger pl-3">', '</small>')?>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
