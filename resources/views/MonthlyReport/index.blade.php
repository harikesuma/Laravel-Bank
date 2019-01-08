@extends('layouts.main')
@section('title','Monthly Report')
@section('action', route('monthlyReport.searchByMember'))
@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <h5>Monthly Report</h5>
            </div>
        </div>
        <form action={{route('monthlyReport.search') }} method="post">
            @csrf
            <div class="row mt-5">
                <div class="col-4">
                    <div class="form-group d-flex">
                        <label for="date">Date</label>
                        <input type="month" name="date" class="form-control dark  mx-3" id="date">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group d-flex">
                        <button type="submit" class="btn btn-md lavender">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row mt-3">
            <table class="table dark table-borderless">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>No anggota</th>
                        <th>jenis transaksi</th>
                        <th>debet</th>
                        <th>kredit</th>
                        <th>Saldo</th>
                        <th>date</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    @foreach ($deposits->sortByDesc('date') as $transaction)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$transaction->member->name}}</td>
                            <td>{{$transaction->member->member_number}}</td>
                            <td>{{$transaction->deposit_type->transaction_name}}</td>
                            <td>{{$transaction->_Debit()}}</td>
                            <td>{{$transaction->_Kredit()}}</td>
                            <td>{{$transaction->member->_BalanceAt($transaction->id)}}</td>
                            <td>{{$transaction->date}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                {!! $deposits->links() !!}
            </div>
        </div>
    </div>
@endsection