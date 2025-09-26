<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="field-3" class="form-label">Kategori Diklat</label>
             <input type="hidden" name="id" value="{{ Crypt::encrypt($kategori->id_kategori) }}">
            <input type="text" value="{{ $kategori->kategori}}" class="form-control" id="field-3" name="nama" placeholder="Kategori Diklat" required>
        </div>
        <div class="mb-3">
            <label for="field-3" class="form-label">Seksi / Bidang</label>
             <div class="col-md-10">
                <select class="form-control" name="seksi" required>
                <option value="">-- Pilih Seksi / Bidang --</option>
                @foreach ($seksi as $d)
                    <option {{ $kategori->id_seksi == $d->id_seksi ? 'selected' : '' }} value="{{ $d->id_seksi }}">{{ $d->nama_seksi }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
