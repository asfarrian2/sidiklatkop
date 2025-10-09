<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="field-3" class="form-label">Kategori</label>
            <input type="hidden" name="id" value="{{ Crypt::encrypt($kdiklat->id_kdiklat) }}">
             <div class="col-md-10">
                <select class="form-control" name="kategori" required>
                <option value="">-- Pilih Kategori Diklat --</option>
                @foreach ($kategori as $d)
                    <option {{ $kdiklat->id_kategori == $d->id_kategori ? 'selected' : '' }} value="{{ $d->id_kategori }}">{{ $d->kategori }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
