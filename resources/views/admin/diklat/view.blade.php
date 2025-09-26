@extends('layouts.admin')

@section('content')

<!-- Page Header -->
<div class="page-header">
	<div class="row">
        @csrf
        @php
        $messagewarning = Session::get('warning');
        $messagesuccess = Session::get('success');
        @endphp
        @if (Session::get('warning'))
        <div class="card-body">
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Gagal !</strong> {{ $messagewarning }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
        </div>
        @endif
        @if (Session::get('success'))
        <div class="card-body">
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Sukses !</strong> {{ $messagesuccess }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
        </div>
        @endif

		<div class="col-sm-12">
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Dashboard </a></li>
				<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
				<li class="breadcrumb-item active">Diklat</li>
			</ul>
		</div>
	</div>
</div>
<!-- /Page Header -->


<div class="row">
	<div class="col-sm-12">

		<div class="card card-table show-entire">
			<div class="card-body">

				<!-- Table Header -->
				<div class="page-table-header mb-2">
					<div class="row align-items-center">
						<div class="col">
							<div class="doctor-table-blk">
								<h3>Data Pendidikan dan Pelatihan</h3>
								<div class="doctor-search-blk">
									<div class="add-group">
										<a type="button" href=""  data-bs-toggle="modal" data-bs-target="#tambahdata" class="btn btn-primary add-pluss ms-2"><img src="/assets/img/icons/plus.svg" alt=""></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Table Header -->

                <!-- Modal Tambah Data -->
                <div id="tambahdata" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Input Data</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/adm/diklat/store" method="POST" id="formStore">
                            @csrf
                            <div class="modal-body p-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">Kategori Diklat</label>
                                            <input type="text" class="form-control" id="field-3" name="nama" placeholder="Kategori Diklat">
                                        </div>
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">Seksi / Bidang</label>
                                            <div class="col-md-12">
                                                <select class="form-control" name="seksi" required>
                                                    <option value="">-- Pilih Seksi / Bidang --</option>
                                                     @foreach ($seksi as $d)
                                                    <option value="{{ $d->id_seksi }}">{{ $d->nama_seksi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- / Modal Tambah Data -->

				<div class="table-responsive">
					<table class="table border-0 custom-table comman-table datatable mb-0">
						<thead>
							<tr>
								<th style="text-align:center;">No</th>
								<th style="text-align:center;">Judul</th>
                                <th style="text-align:center;">Tanggal Pelaksanaan</th>
                                <th style="text-align:center;">Lokasi</th>
                                <th style="text-align:center;">Seksi / Bidang</th>
								<th style="text-align:center;">Status</th>
								<th ></th>
							</tr>
						</thead>
						<tbody>
                            @foreach ($tabeldata as $d)
							<tr>
								<td style="text-align:center;">{{ $loop->iteration }}</td>
								<td>{{ $d->judul}}</td>
                                <td>{{ $d->tgl_mulai}} s.d. {{ $d->tgl_akhir }}</td>
                                <td>{{ $d->lokasi}}</td>
                                <td>{{ $d->nama_seksi}}</td>
                                @if ($d->status == 1)
								<td style="text-align:center;"><button class="custom-badge status-green">Selesai</button></td>
                                @else
                                <td style="text-align:center;"><button class="custom-badge status-yellow">Belum Dilaksanakan / Proses</button></td>
                                @endif
								<td class="text-end">
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
										<div class="dropdown-menu dropdown-menu-end">
                                            @if ($d->status == 0)
                                            <a type="button" data-id="{{ Crypt::encrypt($d->id_diklat) }}" data-bs-toggle="modal" data-bs-target="#statusdata" class="dropdown-item stat"><i class="fa-solid fa-check m-r-5"></i> Aktifkan</a>
                                            @else
                                            <a type="button" data-id="{{ Crypt::encrypt($d->id_diklat) }}" data-bs-toggle="modal" data-bs-target="#statusdata" class="dropdown-item stat"><i class="fa-solid fa-ban m-r-5"></i> Nonaktifkan</a>
                                            @endif
											<a type="button" href="" data-id="{{ Crypt::encrypt($d->id_diklat) }}" data-bs-toggle="modal" data-bs-target="#editdata" class="dropdown-item edit"><i class="fa-solid fa-pen-to-square m-r-5"></i> Edit</a>
                                            <a type="button" href="" data-id="{{ Crypt::encrypt($d->id_diklat) }}" data-bs-toggle="modal" data-bs-target="#hapusdata" class="dropdown-item hapus"><i class="fa fa-trash-alt m-r-5"></i> Hapus</a>
                                            </div>
										</div>
									</div>
								</td>
							</tr>
                             @endforeach
						</tbody>
					</table>
				</div>
                <!-- Modal Edit Data -->
                <div id="editdata" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Data</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/adm/diklat/update" method="POST" id="formStore">
                            @csrf
                            <div class="modal-body p-4" id="loadedit">
                                {{-- Isi Modal Edit --}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- / Modal Status Data -->
                <!-- Modal Status Data -->
                <div id="statusdata" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><img src="/assets/img/quest.png" alt="" width="30" height="26"> Konfirmasi</h4>
                            </div>
                            <div class="modal-body p-4" id="loadstatus">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Modal Status Data -->
                 <!-- Modal Hapus Data -->
                <div id="hapusdata" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><img src="/assets/img/sent.png" alt="" width="30" height="26"> Peringatan</h4>
                            </div>
                            <div class="modal-body p-4" id="loadhapus">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Modal Hapus Data -->
			</div>
		</div>
	</div>
</div>


@endsection

@push('myscript')


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Button Edit -->
<script>
$('.edit').click(function(){
    var id_diklat = $(this).attr('data-id');
    $.ajax({
             type: 'POST',
             url: '/adm/diklat/edit',
             cache: false,
             data: {
                 _token: "{{ csrf_token() }}",
                 id_diklat: id_diklat
             },
             success: function(respond) {
                 $("#loadedit").html(respond);
                 $('.pagu').mask("#.##0", {
                            reverse:true
                        });
             }
         });
     $("#editdata").modal("show");

});
var span = document.getElementsByClassName("close")[0];
</script>
<!-- END Button Edit -->

<!-- Button Status -->
<script>
$('.stat').click(function(){
    var id_diklat = $(this).attr('data-id');
    $.ajax({
             type: 'POST',
             url: '/adm/diklat/stat',
             cache: false,
             data: {
                 _token: "{{ csrf_token() }}",
                 id_diklat: id_diklat
             },
             success: function(respond) {
                 $("#loadstatus").html(respond);
                 $('.pagu').mask("#.##0", {
                            reverse:true
                        });
             }
         });
     $("#statusdata").modal("show");

});
var span = document.getElementsByClassName("close")[0];
</script>
<!-- END Button Status -->

<!-- Button Hapus -->
<script>
$('.hapus').click(function(){
    var id_diklat = $(this).attr('data-id');
    $.ajax({
             type: 'POST',
             url: '/adm/diklat/hapus',
             cache: false,
             data: {
                 _token: "{{ csrf_token() }}",
                 id_diklat: id_diklat
             },
             success: function(respond) {
                 $("#loadhapus").html(respond);
                 $('.pagu').mask("#.##0", {
                            reverse:true
                        });
             }
         });
     $("#hapusdata").modal("show");

});
var span = document.getElementsByClassName("close")[0];
</script>
<!-- END Button Hapus -->

@endpush
