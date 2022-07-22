  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Pengantaran</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Beranda</li>
              <li class="breadcrumb-item active" aria-current="page">Tambah Pengantaran</li>
            </ol>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-body">
                  <?php echo form_open_multipart('');?>
                  <div class="form-group">
                      <label for="staff">Staff</label>
                      <select class="form-control" name="staff">
                        <option value="">Pilih Staff</option>
                        <?php
                        foreach($staff as $s){5
                        ?>
                        <option value="<?= $s['id_staff'];?>"><?= $s['nama_staff'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                      <?=form_error('staff', '<small class="text-danger pl-3">', '</small>')?>
                    </div>
                    <div class="form-group">
                      <label for="kendaraan">Kendaraan</label>
                      <select class="form-control" name="kendaraan">
                        <option value="">Pilih Jenis Kendaraan</option>
                        <?php
                        foreach($kendaraan as $k){5
                        ?>
                        <option value="<?= $k['id_kendaraan'];?>"><?= $k['nama_kendaraan'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                      <?=form_error('kendaraan', '<small class="text-danger pl-3">', '</small>')?>
                    </div>
                    
                    <div class="form-group">
                      <label for="jumlah">Jumlah</label>
                      <input type="number" class="form-control" id="jumlah" aria-describedby="jumlah" name="jumlah" value="<?=set_value('jumlah')?>"
                        placeholder="Masukkan Jumlah Barang">
                        <?=form_error('jumlah', '<small class="text-danger pl-3">', '</small>')?>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
