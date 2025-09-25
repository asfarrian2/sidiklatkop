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
				<li class="breadcrumb-item"><a href="/adm/instruktur">Pengajar</a></li>
                <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                <li class="breadcrumb-item active">Profile</li>
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
								<h3>Profile Pengajar</h3>
							</div>
						</div>
					</div>
				</div>
				<!-- /Table Header -->

				<div class="card-box profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"><img class="avatar" src="/assets/img/instruktur/Default-Instruktur.png" alt=""></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $instruktur->nama }}</h3>
                                                <small class="text-muted">NIK {{ $instruktur->nik }}</small>
                                                <div class="staff-id">Instansi : {{ $instruktur->instansi }}</div>
                                                <div class="staff-msg"><a href="chat.html" class="btn btn-primary">Edit Profile</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Tempat/Tanggal Lahir</span>
                                                    <span class="text">{{ $instruktur->tmp_lahir }}, {{ date('d-m-Y', strtotime($instruktur->tgl_lahir)) }}</span>
                                                </li>
                                                <br>
                                                <li>
                                                    <span class="title">Alamat</span>
                                                    <span class="text">{{ $instruktur->alamat_rmh }}</span>
                                                </li>
                                                <br>
                                                <li>
                                                    <span class="title">Jenis Kelamin</span>
                                                    <span class="text">{{ $instruktur->jk }}</span>
                                                </li>
                                                <br>
                                                <li>
                                                    <span class="title">Agama</span>
                                                    <span class="text">{{ $instruktur->agama }}</span>
                                                </li>
                                                <br>
                                                <li>
                                                    <span class="title">Pendidikan</span>
                                                    <span class="text">{{ $instruktur->pendidikan }}</span>
                                                </li>
                                                <br>
                                                <li>
                                                    <span class="title">No. HP/WA</span>
                                                    <span class="text">{{ $instruktur->no_hp }}</span>
                                                </li>
                                                <br>
                                                <li>
                                                    <span class="title">Email</span>
                                                    <span class="text">{{ $instruktur->email }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-table show-entire">
			<div class="card-body">
                <!-- Table Header -->
				<div class="page-table-header mb-2">
					<div class="row align-items-center">
						<div class="col">
							<div class="doctor-table-blk">
								<h3>Riwayat Mengajar</h3>
							</div>
						</div>
					</div>
				</div>
				<!-- /Table Header -->
                <div class="table-responsive">
					<table class="table border-0 custom-table comman-table datatable mb-0">
						<thead>
							<tr>
								<th style="text-align:center;">No</th>
                                <th style="text-align:center;">Kegiatan Diklat</th>
                                <th style="text-align:center;">Tanggal</th>
                                <th style="text-align:center;">Lokasi</th>
							</tr>
						</thead>

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
                            <form action="/adm/instruktur/update" method="POST" id="formStore">
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
                <!-- / Modal Edit Data -->
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
    var id_instruktur = $(this).attr('data-id');
    $.ajax({
             type: 'POST',
             url: '/adm/instruktur/edit',
             cache: false,
             data: {
                 _token: "{{ csrf_token() }}",
                 id_instruktur: id_instruktur
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

@endpush
