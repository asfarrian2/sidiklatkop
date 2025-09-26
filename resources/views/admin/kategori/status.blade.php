<h4>Apakah Anda Yakin Mengubah Status Data Ini ?</h4> <br>
<span>Sektor Usaha "{{ $kategori->kategori}}"</span>
    <form action="/adm/kategoridiklat/status" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ Crypt::encrypt($kategori->id_kategori) }}">
        <div class="m-t-20"> <a href="#" class="btn btn-white" data-bs-dismiss="modal">Batal</a>
	    <button type="submit" class="btn btn-warning">Ya, Ubah</button>
    </form>
</div>
