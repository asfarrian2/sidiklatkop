<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="field-3" class="form-label">Kategori Diklat</label>
             <input type="hidden" name="id" value="{{ Crypt::encrypt($diklat->id_diklat) }}">
             <div class="col-md-10">
                <select class="form-control" name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                     @foreach ($kategori as $d)
                    <option value="{{ $d->id_kategori }}">{{ $d->kategori }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
