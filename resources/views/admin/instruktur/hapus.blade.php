<h4>Apakah Anda Yakin Ingin Menghapus Data Ini ?</h4> <br>
<span> "{{ $instruktur->nama}}"</span>
    <form action="/adm/instruktur/delete" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ Crypt::encrypt($instruktur->id_instruktur) }}">
        <div class="m-t-20"> <a href="#" class="btn btn-white" data-bs-dismiss="modal">Batal</a>
	    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
    </form>
</div>
