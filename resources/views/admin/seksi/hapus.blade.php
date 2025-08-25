<h4>Apakah Anda Yakin Ingin Menghapus Data Ini ?</h4> <br>
<span> "{{ $seksi->nama_seksi}}"</span>
    <form action="/adm/seksi/delete" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ Crypt::encrypt($seksi->id_seksi) }}">
        <div class="m-t-20"> <a href="#" class="btn btn-white" data-bs-dismiss="modal">Batal</a>
	    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
    </form>
</div>
