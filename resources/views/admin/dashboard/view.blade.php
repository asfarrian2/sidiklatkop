@extends('layouts.admin')

@section('content')

<!-- Page Header -->
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Dashboard </a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /Page Header -->

<div class="good-morning-blk">
	<div class="row">
		<div class="col-md-6">
			<div class="morning-user">
				<h2>Selamat Datang, <span>Asfar Rian</span></h2>
				<p>Have a nice day at work</p>
			</div>
		</div>
		<div class="col-md-6 position-blk">
			<div class="morning-img">
				<img src="/assets/img/morning-img-01.png" alt="">
			</div>
		</div>
	</div>
</div>


@endsection

@push('myscript')

@endpush
