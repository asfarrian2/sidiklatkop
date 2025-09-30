<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="field-3" class="form-label">Tahun Anggaran</label>
             <input type="hidden" name="id" value="{{ Crypt::encrypt($tahunanggaran->id_tahunanggaran) }}">
            <input type="text" value="{{ $tahunanggaran->tahun}}" class="form-control" id="field-3" name="nama" placeholder="Tahun Anggaran" required>
        </div>
    </div>
</div>
