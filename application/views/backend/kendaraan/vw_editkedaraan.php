  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Kendaraan</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Beranda</li>
              <li class="breadcrumb-item active" aria-current="page">Tambah Kendaraan</li>
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
                      <input type="text" class="form-control" id="nama" aria-describedby="nama" name="nama" value="<?= $kendaraan['nama_kendaraan'];?>"
                        placeholder="Masukkan Nama Kendaraan">
                        <?=form_error('nama', '<small class="text-danger pl-3">', '</small>')?>
                    </div>
                    <div class="form-group">
                      <label for="jenis">Jenis</label>
                      <select class="form-control" name="jenis">
                        <option value="">Pilih Jenis Kendaraan</option>
                        <option value="Roda Dua" <?php if($kendaraan['jenis_kendaraan']=='Roda Dua'){ echo "selected";}?>>Roda Dua</option>
                        <option value="Roda Empat" <?php if($kendaraan['jenis_kendaraan']=='Roda Empat'){ echo "selected";}?>>Roda Empat</option>
                      </select>
                      <?=form_error('jenis', '<small class="text-danger pl-3">', '</small>')?>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
