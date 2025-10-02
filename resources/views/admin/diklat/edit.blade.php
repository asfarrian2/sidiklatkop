<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="field-3" class="form-label">Judul</label>
             <input type="hidden" name="id" value="{{ Crypt::encrypt($diklat->id_diklat) }}">
            <input type="text" value="{{ $diklat->judul}}" class="form-control" id="field-3" name="nama" placeholder="Judul Diklat" required>
        </div>
        <div class="mb-3">
            <label for="field-3" class="form-label">Tanggal Dimulai</label>
            <input type="date" value="{{ $diklat->tgl_mulai}}" class="form-control" id="field-3" name="tgl_mulai" placeholder="Tanggal Diklat" required>
        </div>
        <div class="mb-3">
            <label for="field-3" class="form-label">Tanggal Berakhir</label>
            <input type="date" value="{{ $diklat->tgl_akhir}}" class="form-control" id="field-3" name="tgl_akhir" placeholder="Tanggal Diklat" required>
        </div>
        <div class="mb-3">
            <label for="field-3" class="form-label">Lokasi</label>
            <input type="text" value="{{ $diklat->lokasi}}" class="form-control" id="field-3" name="lokasi" placeholder="Lokasi Diklat" required>
        </div>
        <div class="mb-3">
            <label for="field-3" class="form-label">Seksi / Bidang</label>
             <div class="col-md-10">
                <select class="form-control" name="seksi" required>
                <option value="">-- Pilih Seksi / Bidang --</option>
                @foreach ($seksi as $d)
                    <option {{ $diklat->id_seksi == $d->id_seksi ? 'selected' : '' }} value="{{ $d->id_seksi }}">{{ $d->nama_seksi }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
