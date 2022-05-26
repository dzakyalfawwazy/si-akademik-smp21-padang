  <!-- general form elements -->
  <!-- form start -->

  <div class="row">
    <div class="col-md-4 offset-md-4">
          <form method="get" target="_blank" name="form1" action="cetak.php">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Silahkan Pilih</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <input type="hidden" name="p" value="5">
            <div class="form-group">
              <div class="form-row">
                <label class="col-md-12"></label>
              <div class="form-inline col-md-6">
                <label>
                <!-- <input type="radio" class="form-check" required name="jenis" value="KTSP">KTSP</label> -->
                <input type="radio" class="form-check" required name="jenis" value="K13">K13</label>
              </div>
              <div class="form-inline col-md-6">
                <label>
              </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <label class="col-md-12">Pilih</label>
              <div class="form-inline col-md-6">
                <label>
                <input type="radio" class="form-check" required name="tipe" value="MID">MID</label>
              </div>
              <div class="form-inline col-md-6">
                <label>
                <input type="radio" class="form-check" required name="tipe" value="Semester">Semester</label>
              </div>
              </div>
            </div>
            <div class="form-group">
              <label for="semester">Semester</label>
              <select type="text" class="form-control" required id="semester" required name="semester">
                <?= $option1 ?>
                <option value="1">1</option>
                <option value="2">2</option>
              </select>
            </div>
            <div class="form-group">
              <label for="tahunajaran">Tahun Ajaran</label>
              <select type="text" class="form-control" required id="tahunajaran" required name="tahunajaran">
                <?= $option2 ?>
                <?php 
                for ($i=date('Y'); $i > 2010 ; $i--) { 
                  $thnk=$i+1;
                  $tha=$i."/".$thnk;
                  echo"<option value='$tha'>$tha</option>";
                }
                ?>
              </select>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit"  class="btn btn-success" required><i class="fas fa-print"></i> Cetak Nilai</button>
        </div>
      </div>
          </form>
      <!-- /.card -->
    </div>
  </div>