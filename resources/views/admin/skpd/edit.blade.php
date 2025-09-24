<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="field-3" class="form-label">Nama SKPD</label>
             <input type="hidden" name="id" value="{{ Crypt::encrypt($skpd->id_skpd) }}">
            <input type="text" value="{{ $skpd->nama_skpd}}" class="form-control" id="field-3" name="nama" placeholder="Nama SKPD" required>
        </div>
        <div class="mb-3">
            <label for="field-3" class="form-label">Alamat</label>
            <input type="text" value="{{ $skpd->alamat_skpd}}" class="form-control" id="field-3" name="alamat" placeholder="Alamat SKPD" required>
        </div>
        <div class="mb-3">
            <label for="field-3" class="form-label">Kab./Kota</label>
            <div class="col-md-10">
            <select class="form-control" name="kabupaten" required>
            <option value="">-- Pilih Kab./Kota --</option>
            @foreach ($kota as $d)
                <option {{ $skpd->id_kota == $d->id_kota ? 'selected' : '' }} value="{{ $d->id_kota }}">{{ $d->nama_kota }}</option>
            @endforeach
            </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="field-3" class="form-label">Nomor Telepon</label>
            <input type="text" value="{{ $skpd->telp_skpd}}" class="form-control" id="field-3" name="telepon" placeholder="Nomor Telepon SKPD" required>
        </div>
        <div class="mb-3">
            <label for="field-3" class="form-label">Email</label>
            <input type="text" value="{{ $skpd->email_skpd}}" class="form-control" id="field-3" name="email" placeholder="Email SKPD" required>
        </div>
    </div>
</div>
