<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="field-3" class="form-label">Sektor Usaha</label>
             <input type="hidden" name="id" value="{{ Crypt::encrypt($jukm->id_jukm) }}">
            <input type="text" value="{{ $jukm->jenis}}" class="form-control" id="field-3" name="nama" placeholder="Sektor Usaha" required>
        </div>
    </div>
</div>
