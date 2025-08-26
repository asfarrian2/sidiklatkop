<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="field-3" class="form-label">Nama Seksi</label>
             <input type="hidden" name="id" value="{{ Crypt::encrypt($seksi->id_seksi) }}">
            <input type="text" value="{{ $seksi->nama_seksi}}" class="form-control" id="field-3" name="nama" placeholder="Nama Seksi" required>
        </div>
    </div>
</div>
