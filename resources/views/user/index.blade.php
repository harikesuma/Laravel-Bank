@extends('layouts.main')
@section('title','Data Users')
@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-2 text-center dark shadow-sm p-3">
                <h5>{{$users->where('status_aktif','0')->count()}}</h5>
                <p>User Get Fired</p>
                <a href={{route('users.showFired')}} class="btn btn-md mt-5 lavender">See List</a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6 text-center">
                <h5>Data User</h5>
            </div>
            <div class="col-6 text-center">
                <a href={{route('register')}} class="btn btn-md btn-lavender">New User</a>
            </div>
        </div>
        <div class="row mt-3">
            <table class="table dark table-borderless mx-3">
                <thead>
                    <tr>
                        <th></th>
                        <th>nama</th>
                        <th>Email</th>
                        <th>User  Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users->where('status_aktif','1') as $user)
                       <tr>
                            <td>
                                <a  href="{{ asset('/storage/users/'.$user->profile_picture) }}" target="_blank">
                                    <img src="{{ asset('/storage/users/'.$user->profile_picture)  }}"  class="rounded-circle" alt=""  width="35px" height="35px">
                                </a>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->userRole->role}}</td>
                            <td>
                                <a href={{route('users.fired', ['id'=>$user->id] )}} class="btn btn-sm btn-danger">Fired</a>
                            </td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection