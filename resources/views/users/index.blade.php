@extends('layouts.app')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="d-flex align-items-center">
                    <h5 class="page-title">{{ trans('greetings.dashboard')}}</h5>
                    <ul class="breadcrumb ml-2">
                        <li class="breadcrumb-item active">Users</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">{{ trans('greetings.users')}}</h4>
                    <div class="text-right">
                        <a href="{{ route('create.user') }}" class="btn btn-dark p-2">Add New User</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 table-striped border-0 data-table" id="datatable">
                            <thead class="thead-light">
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Created By</th>
                                <th>Created On</th>
                                <th>Last Login</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @if(isset($users))
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$sn++}}</td>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->last_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_user->first_name ?? ""}} {{$user->created_user->last_name ?? ""}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        {{$user->last_login}}
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            @if(!in_array(1, $user->roles))
                                            <a href="{{ route('edit.user', $user->id) }}" class="btn btn-sm p-2" title="Edit"><i class="fa fa-edit"></i></a>
                                            @endif

                                            @if(in_array(1, Auth::user()->roles))
                                            @if(!in_array(1, $user->roles))
                                            <a href="{{ route('delete.user', $user->id) }}" onclick="return confirm('Are you sure you want to delete this user?')" title="Delete" class="btn btn-sm p-2" title="Edit"><i class="fa fa-trash"></i></a>
                                            @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection