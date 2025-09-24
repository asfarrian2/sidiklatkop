<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="field-3" class="form-label">Nama Kabupaten / Kota</label>
             <input type="hidden" name="id" value="{{ Crypt::encrypt($kota->id_kota) }}">
            <input type="text" value="{{ $kota->nama_kota}}" class="form-control" id="field-3" name="nama" placeholder="Nama Kabupaten / Kota" required>
        </div>
    </div>
</div>
