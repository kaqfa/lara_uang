@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Beranda Aplikasi</h1>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ route('add-trans') }}" 
                            class="btn btn-primary btn-lg btn-block">
                            Tambah Transaksi</a>
                        </div>
                    
                        <div class="col-md-4">
                            <a href="{{ route('show-trans') }}" 
                            class="btn btn-warning btn-lg btn-block">
                            Tampilkan Transaksi</a>
                        </div>
                    
                        <div class="col-md-4">
                            <a href="{{ route('edit-profile') }}" 
                            class="btn btn-danger btn-lg btn-block">
                            Edit Profil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
