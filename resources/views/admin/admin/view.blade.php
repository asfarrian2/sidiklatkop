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
				<li class="breadcrumb-item active">Admin</li>
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
								<h3>Data Admin</h3>
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
                                <h4 class="modal-title">Input Data Admin</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/adm/admin/store" method="POST" id="formStore">
                            @csrf
                            <div class="modal-body p-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="field-3" name="nama" placeholder="Nama Admin" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">NIP</label>
                                            <input type="text" class="form-control" id="field-3" name="nip" placeholder="Nomor Induk Pegawai" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="field-3" name="username" placeholder="Username" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="field-3" name="tmp" placeholder="Tempat Lahir" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="field-3" name="tgl" placeholder="Tanggal Lahir" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" id="field-3" name="alamat" placeholder="Alamat Rumah" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">Jenis Kelamin</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="jk" required>
                                                    <option value="">-Pilih Jenis Kelamin-</option>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">Agama</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="agama" required>
                                                    <option value="">-Pilih Agama-</option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Kristen">Kristen</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Budha">Budha</option>
                                                    <option value="Konghucu">Konghucu</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">Pendidikan</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="pendidikan" required>
                                                    <option value="">-Pilih Pendidikan-</option>
                                                    <option value="SD">SD</option>
                                                    <option value="SLTP">SLTP</option>
                                                    <option value="SLTA">SLTA</option>
                                                    <option value="D-III">D-III</option>
                                                    <option value="S1 / D-IV">S1 / D-IV</option>
                                                    <option value="S2">S2</option>
                                                    <option value="S3">S3</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">Nomor HP/WA</label>
                                            <input type="text" class="form-control" id="field-3" name="telp" placeholder="Nomor Handphone / Whatsapp" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">Jabatan</label>
                                            <input type="text" class="form-control" id="field-3" name="jabatan" placeholder="Jabatan Pegawai" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="field-3" class="form-label">Seksi / Bidang</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="kabupaten" required>
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
                                <th style="text-align:center;">Nama</th>
                                <th style="text-align:center;">Username</th>
                                <th style="text-align:center;">Seksi/Bidang</th>
                                <th style="text-align:center;">No. HP</th>
                                <th style="text-align:center;">Status</th>
								<th ></th>
							</tr>
						</thead>
						<tbody>
                            @foreach ($admin as $d)
							<tr>
								<td style="text-align:center;">{{ $loop->iteration }}</td>
								<td class="profile-image"><a href="/adm/admin/profile/{{ Crypt::encrypt($d->id_admins) }}"> {{$d->nama}}</a></td>
                                <td>{{ $d->username}}</td>
                                <td>{{ $d->id_seksi}}</td>
                                <td style="text-align:center;">{{ $d->no_hp}}</td>
                                @if ($d->status == 1)
								<td style="text-align:center;"><button class="custom-badge status-green">Aktif</button></td>
                                @else
                                <td style="text-align:center;"><button class="custom-badge status-red">Nonaktif</button></td>
                                @endif
								<td class="text-end">
									<div class="dropdown dropdown-action">
										<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
										<div class="dropdown-menu dropdown-menu-end">
                                            @if ($d->status == 0)
                                            <a type="button" data-id="{{ Crypt::encrypt($d->id_admins) }}" data-bs-toggle="modal" data-bs-target="#statusdata" class="dropdown-item stat"><i class="fa-solid fa-check m-r-5"></i> Aktifkan</a>
                                            @else
                                            <a type="button" data-id="{{ Crypt::encrypt($d->id_admins) }}" data-bs-toggle="modal" data-bs-target="#statusdata" class="dropdown-item stat"><i class="fa-solid fa-ban m-r-5"></i> Nonaktifkan</a>
                                            @endif
											<a type="button" href="" data-id="{{ Crypt::encrypt($d->id_admins) }}" data-bs-toggle="modal" data-bs-target="#editdata" class="dropdown-item edit"><i class="fa-solid fa-pen-to-square m-r-5"></i> Edit</a>
                                            <a type="button" href="" data-id="{{ Crypt::encrypt($d->id_admins) }}" data-bs-toggle="modal" data-bs-target="#hapusdata" class="dropdown-item hapus"><i class="fa fa-trash-alt m-r-5"></i> Hapus</a>
                                            </div>
										</div>
									</div>
								</td>
							</tr>
                             @endforeach
						</tbody>
					</table>
				</div>

                <!-- Modal Profile Data -->
                <div id="profiledata" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Profil Data</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/adm/admin/update" method="POST" id="formStore">
                            @csrf
                            <div class="modal-body p-4" id="loadprofile">
                                {{-- Isi Profile Edit --}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- / Modal Profile Data -->

                <!-- Modal Edit Data -->
                <div id="editdata" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Data</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/adm/admin/update" method="POST" id="formStore">
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
$('.profile').click(function(){
    var id_admins = $(this).attr('data-id');
    $.ajax({
             type: 'POST',
             url: '/adm/admin/profile',
             cache: false,
             data: {
                 _token: "{{ csrf_token() }}",
                 id_admins: id_admins
             },
             success: function(respond) {
                 $("#loadedit").html(respond);
                 $('.pagu').mask("#.##0", {
                            reverse:true
                        });
             }
         });
     $("#profiledata").modal("show");

});
var span = document.getElementsByClassName("close")[0];
</script>
<!-- END Button Edit -->

<!-- Button Edit -->
<script>
$('.edit').click(function(){
    var id_admins = $(this).attr('data-id');
    $.ajax({
             type: 'POST',
             url: '/adm/admin/edit',
             cache: false,
             data: {
                 _token: "{{ csrf_token() }}",
                 id_admins: id_admins
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
    var id_admins = $(this).attr('data-id');
    $.ajax({
             type: 'POST',
             url: '/adm/admin/stat',
             cache: false,
             data: {
                 _token: "{{ csrf_token() }}",
                 id_admins: id_admins
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
    var id_admins = $(this).attr('data-id');
    $.ajax({
             type: 'POST',
             url: '/adm/admin/hapus',
             cache: false,
             data: {
                 _token: "{{ csrf_token() }}",
                 id_admins: id_admins
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
