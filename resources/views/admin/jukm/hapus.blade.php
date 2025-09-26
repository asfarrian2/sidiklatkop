<h4>Apakah Anda Yakin Ingin Menghapus Data Ini ?</h4> <br>
<span> "{{ $jukm->jenis}}"</span>
    <form action="/adm/sektorusaha/delete" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ Crypt::encrypt($jukm->id_jukm) }}">
        <div class="m-t-20"> <a href="#" class="btn btn-white" data-bs-dismiss="modal">Batal</a>
	    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
    </form>
</div>
