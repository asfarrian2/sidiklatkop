<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="field-3" class="form-label">Jenis Koperasi</label>
             <input type="hidden" name="id" value="{{ Crypt::encrypt($jkoperasi->id_jkoperasi) }}">
            <input type="text" value="{{ $jkoperasi->jenis}}" class="form-control" id="field-3" name="nama" placeholder="Jenis Koperasi" required>
        </div>
    </div>
</div>
