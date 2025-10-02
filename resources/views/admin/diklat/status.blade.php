<h4>Apakah Anda Yakin Mengubah Status Data Ini ?</h4> <br>
<span>Sektor Usaha "{{ $diklat->judul}}"</span>
    <form action="/adm/diklat/status" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ Crypt::encrypt($diklat->id_diklat) }}">
        <div class="m-t-20"> <a href="#" class="btn btn-white" data-bs-dismiss="modal">Batal</a>
	    <button type="submit" class="btn btn-warning">Ya, Ubah</button>
    </form>
</div>
