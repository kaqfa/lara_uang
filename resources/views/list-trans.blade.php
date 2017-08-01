@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Catatan Transaksi
                </div>
                <div class="panel-body">
                    <h2>Sisa Uang Dimiliki: Rp. {{ number_format($balance, 0, '.', ',') }}</h2>
                    <div class="row">
                        <div class="col-md-6">
                            @if(count($outTransactions))
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th colspan="3">Transaksi Pengeluaran</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($outTransactions as $trans)
                                        <tr>
                                            <td>{{ $trans->title }}</td>
                                            <td>{{ number_format($trans->amount, 0, '.', ',') }}</td>
                                            <td>
                                                <a href="{{ $trans->id }}" class="btn btn-info">tampil</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h3>Belum ada transaksi pengeluaran</h3>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if(count($inTransactions))
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th colspan="3">Transaksi Pengeluaran</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($inTransactions as $trans)
                                        <tr>
                                            <td>{{ $trans->title }}</td>
                                            <td>{{ $trans->amount }}</td>
                                            <td>
                                                <a href="{{ $trans->id }}" class="btn btn-info">tampil</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h3>Belum ada transaksi pemasukan</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection