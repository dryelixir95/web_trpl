@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin transparent">
            <div class="row">
                <div class="col-md-4 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Jumlah Artikel</p><br><br><br>
                            <p class="fs-30 mb-2">{{ $articleCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p>Jumlah Kunjungan</p>
                            <p class="mb-4">Dalam Satu Bulan</p><br><br>
                            <p class="fs-30 mb-2">{{ $visitCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Jumlah User</p><br><br><br>
                            <p class="fs-30 mb-2">{{ $userCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
