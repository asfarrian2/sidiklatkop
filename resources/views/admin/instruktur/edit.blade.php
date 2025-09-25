<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="field-3" class="form-label">Nama</label>
            <input type="hidden" name="id" value="{{ Crypt::encrypt($instruktur->id_instruktur) }}">
            <input type="text" value="{{ $instruktur->nama}}" class="form-control" id="field-3" name="nama" placeholder="Nama Pengajar" required>
        </div>
        <div class="mb-3">
            <label for="field-3" class="form-label">NIK</label>
            <input type="text" value="{{ $instruktur->nik}}" class="form-control" id="field-3" name="nik" placeholder="Nomor Induk Kependudukan" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="field-3" class="form-label">Tempat Lahir</label>
            <input type="text" value="{{ $instruktur->tmp_lahir}}" class="form-control" id="field-3" name="tmp" placeholder="Tempat Lahir" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="field-3" class="form-label">Tanggal Lahir</label>
            <input type="date" value="{{ $instruktur->tgl_lahir}}" class="form-control" id="field-3" name="tgl" placeholder="Tanggal Lahir" required>
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label for="field-3" class="form-label">Alamat</label>
            <input type="text" value="{{ $instruktur->alamat_rmh}}" class="form-control" id="field-3" name="alamat" placeholder="Alamat Rumah" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="field-3" class="form-label">Jenis Kelamin</label>
            <div class="col-md-10">
                <select class="form-control" name="jk" required>
                    <option value="">-Pilih Jenis Kelamin-</option>
                    <option value="Laki-Laki" {{ $instruktur->jk == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ $instruktur->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="field-3" class="form-label">Agama</label>
            <div class="col-md-10">
                <select class="form-control" name="agama" required>
                    <option value="">-Pilih Agama-</option>
                    <option value="Islam" {{ $instruktur->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ $instruktur->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Hindu" {{ $instruktur->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Budha" {{ $instruktur->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                    <option value="Konghucu" {{ $instruktur->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="field-3" class="form-label">Pendidikan</label>
            <div class="col-md-10">
                <select class="form-control" name="pendidikan" required>
                    <option value="">-Pilih Pendidikan-</option>
                    <option value="SD" {{ $instruktur->pendidikan == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SLTP" {{ $instruktur->pendidikan == 'SLTP' ? 'selected' : '' }}>SLTP</option>
                    <option value="SLTA" {{ $instruktur->pendidikan == 'SLTA' ? 'selected' : '' }}>SLTA</option>
                    <option value="D-III" {{ $instruktur->pendidikan == 'D-III' ? 'selected' : '' }}>D-III</option>
                    <option value="S1 / D-IV" {{ $instruktur->pendidikan == 'S1 / D-IV' ? 'selected' : '' }}>S1 / D-IV</option>
                    <option value="S2" {{ $instruktur->pendidikan == 'S2' ? 'selected' : '' }}>S2</option>
                    <option value="S3" {{ $instruktur->pendidikan == 'S3' ? 'selected' : '' }}>S3</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="field-3" class="form-label">Nomor HP/WA</label>
            <input type="text" value="{{ $instruktur->no_hp}}" class="form-control" id="field-3" name="telp" placeholder="Nomor Handphone / Whatsapp" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="field-3" class="form-label">Email</label>
            <input type="text" value="{{ $instruktur->email}}" class="form-control" id="field-3" name="email" placeholder="Email" required>
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label for="field-3" class="form-label">Instansi</label>
            <input type="text" value="{{ $instruktur->instansi}}" class="form-control" id="field-3" name="instansi" placeholder="Instansi" required>
        </div>
    </div>
</div>
