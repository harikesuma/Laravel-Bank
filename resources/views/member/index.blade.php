@extends('layouts.main')
@section('title' , 'Member')
@section('action', route('member.search'))
@section('content')
    <div class = " container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-4 dark text-white px-5 pt-5 text-center">
                <div class="row border-bottom mb-5">
                    <div class="col-12">
                        <h5>Total Anggota</h5>
                        <h3 class="my-3">{{ $members->count() }}</h3>
                        <a href={{route('member.create')}} class="btn btn-md lavender mb-3">Create Member</a>
                    </div>
                </div>
               <div class="row">
                    <div class="col-6 border-right">
                        <h5>Total Anggota Aktif</h5>
                    </div>
                    <div class="col-6">
                        <h5>Total Anggota non-Aktif</h5>
                    </div>
               </div>
               <div class="row">
                    <div class="col-6 border-right">
                        <h4>{{ $members->where('aktive',1)->count()}}</h4>
                    </div>
                    <div class="col-6">
                        <h4>{{ $members->where('aktive',0)->count()}}</h4>
                    </div>
               </div>
               <div class="row">
                    <div class="col-6 border-right pt-2">
                        <a href={{route('member.active')}} class="btn btn-md lavender ">see list</a>
                    </div>
                    <div class="col-6 pt-2">
                        <a href={{route('member.nonActive')}} class="btn btn-md lavender ">see list</a>
                    </div>
               </div>
            </div>
            <div class="col-sm-12 col-md-8">
                <div class="bg-dark">
                    <canvas id="anggotaChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12 col-md-7">
                <div class="row mt-5 mb-3">
                    <div class="col-12">
                        <h5>List Anggota</h5>
                    </div>
                </div>
                <table class="table bg-dark text-white table-borderless">
                   <thead>
                       <tr>
                           <th></th>
                           <th>Nama</th>
                           <th>No Anggota</th>
                           <th>Saldo</th>
                           <th></th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($members->sortByDesc('id') as $member)
                           <tr>
                               <td>
                                    <a  href="{{ asset('/storage/members/'.$member->profile_picture) }}" target="_blank">
                                        <img src="{{ asset('/storage/members/'.$member->profile_picture) }}"  class="rounded-circle" alt="logo_simple"  width="35px" height="35px">
                                    </a>
                               </td>
                               <td>
                                   {{$member->name}}
                               </td>
                               <td>
                                    {{$member->member_number}}
                                </td>
                                <td>
                                    Rp. {{number_format($member->balance,0,',','.')}}
                                </td>
                                <td>
                                    <a class="text-white" href={{ route('member.show',['id'=>$member->id])}}> <i class="fas fa-external-link-square-alt fa-lg text-dark-blue"></i></a>
                                </td>
                           </tr>
                       @endforeach
                   </tbody>
                </table>
            </div>
            <div class="col-sm-12 col-md-5">
                <div class="row mt-5 mb-3">
                    <div class="col-12 text-right">
                        <h5>Rank Anggota</h5>
                    </div>
                </div>
                <table class="table table-borderless dark text-white">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nama</th>
                            <th>Saldo</th>
                            <th></th>
                        </tr>
                    </thead>
                    @foreach ($members->sortByDesc('balance')->take(10) as $member)
                        <tr>
                            <td>
                                <a  href="{{ asset('/storage/members/'.$member->profile_picture) }}" target="_blank">
                                    <img src="{{ asset('/storage/members/'.$member->profile_picture) }}"  class="rounded-circle" alt="logo_simple"  width="35px" height="35px">
                                </a>
                            </td>
                            <td>{{str_limit($member->name , 26 , '...')}}</td>
                            <td>  Rp. {{number_format($member->balance,0,',','.')}}</td>
                            <td>
                                <a class="text-white" href="{{route('member.show',['id'=>$member->id])}}"> <i class="fas fa-external-link-square-alt fa-lg text-dark-blue"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-12 text-center justify-content-center text-dark">
                {!! $members->links(); !!}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var labels = {!! json_encode($labels)  !!}
        var datas = {!! json_encode($datas) !!}
        var ctx = document.getElementById('anggotaChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: labels,
                datasets: [{
                    label: "Jumlah Member Baru",
                    backgroundColor: 'rgb(27,40,247)',
                    borderColor: 'rgb(27,40,247)',
                    data: datas,
                }]
            },

            // Configuration options go here
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection

