@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Input Transaksi Baru
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Nama Transaksi</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="nama transaksi">
                        </div>
                        <div class="form-group">
                            <label for="amount">Jumlah Pengeluaran</label>
                            <input type="text" class="form-control" id="amount" name="amount" >
                        </div>
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <input type="text" id="description" name="description" class="form-control">
                            <p class="help-block">Keterangan tambahan tentang transaksi</p>
                        </div>
                        <div class="form-group">
                            <label for="type">Tipe</label>
                            <select name="type" id="type" class="form-control">
                                <option value="1">Pengeluaran</option>
                                <option value="2">Pemasukan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection