<h4>Apakah Anda Yakin Ingin Menghapus Data Ini ?</h4> <br>
<span> "{{ $skpd->nama_skpd}}"</span>
    <form action="/adm/skpd/delete" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ Crypt::encrypt($skpd->id_skpd) }}">
        <div class="m-t-20"> <a href="#" class="btn btn-white" data-bs-dismiss="modal">Batal</a>
	    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
    </form>
</div>
