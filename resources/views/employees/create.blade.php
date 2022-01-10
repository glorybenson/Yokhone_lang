@extends('layouts.app')
@section('content')
<div class="content container-fluid">
    @if(isset($mode) && $mode == "edit")
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">Edit Employee</h4>
                    <div class="text-right">
                        <a href="{{ route('employees') }}" class="btn btn-secondary p-2">Back to Employees</a>
                    </div>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('edit.user', $user->id) }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" autocomplete="first name" autofocus>

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autocomplete="last name" autofocus>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('User Role') }}</label>

                            <div class="col-md-6">
                                <select class="form-control @error('role') is-invalid @enderror" name="role">
                                    <option value="">Select Role</option>
                                    @if(isset($roles))
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->user_role->id == $role->id ? 'selected' : ''}} >{{$role->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(isset($mode) && $mode == "create")
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">Create Employee</h4>
                    <div class="text-right">
                        <a href="{{ route('employees') }}" class="btn btn-secondary p-2">Back to Employees</a>
                    </div>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('create.employee') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="name" autofocus>

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}"  autocomplete="name" autofocus>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="employee_id" class="col-md-4 col-form-label text-md-end">{{ __('Employee ID') }}</label>

                            <div class="col-md-6">
                                <input id="employee_id" type="number" class="form-control @error('employee_id') is-invalid @enderror" name="employee_id" value="{{ old('employee_id') }}" >

                                @error('employee_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="hiring_date" class="col-md-4 col-form-label text-md-end">{{ __('Hiring Date') }}</label>

                            <div class="col-md-6">
                                <input id="hiring_date" type="date" class="form-control @error('hiring_date') is-invalid @enderror" name="hiring_date" value="{{ old('hiring_date') }}" >

                                @error('hiring_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="end_date" class="col-md-4 col-form-label text-md-end">{{ __('End Date') }}</label>

                            <div class="col-md-6">
                                <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}">

                                @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="CIN" class="col-md-4 col-form-label text-md-end">{{ __('CIN') }}</label>

                            <div class="col-md-6">
                                <input id="CIN" type="text" class="form-control @error('CIN') is-invalid @enderror" name="CIN" value="{{ old('CIN') }}">

                                @error('CIN')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="CIN_proof" class="col-md-4 col-form-label text-md-end">{{ __('CIN Proof') }}</label>

                            <div class="col-md-6">
                                <input id="CIN_proof" type="file" accept="" class="form-control @error('CIN_proof') is-invalid @enderror" name="CIN_proof" value="{{ old('CIN_proof') }}">

                                @error('CIN_proof')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cell_1" class="col-md-4 col-form-label text-md-end">{{ __('Cell1') }}</label>

                            <div class="col-md-6">
                                <input id="cell_1" type="text" class="form-control @error('cell_1') is-invalid @enderror" name="cell_1" value="{{ old('cell_1') }}" >

                                @error('cell_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cell_2" class="col-md-4 col-form-label text-md-end">{{ __('Cell2') }}</label>

                            <div class="col-md-6">
                                <input id="cell_2" type="text" class="form-control @error('cell_2') is-invalid @enderror" name="cell_2" value="{{ old('cell_2') }}">

                                @error('cell_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" >{{ old('address') }}</textarea>

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="contact_full_name" class="col-md-4 col-form-label text-md-end">{{ __('Contact 1 Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="contact_full_name" type="text" class="form-control @error('contact_full_name') is-invalid @enderror" name="contact_full_name"  value="{{ old('contact_full_name') }}">

                                @error('contact_full_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="contact_1_cell" class="col-md-4 col-form-label text-md-end">{{ __('Contact 1 Cell') }}</label>

                            <div class="col-md-6">
                                <input id="contact_1_cell" type="text" class="form-control @error('contact_1_cell') is-invalid @enderror" name="contact_1_cell"  value="{{ old('contact_1_cell') }}">

                                @error('contact_1_cell')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="contact_1_cell2" class="col-md-4 col-form-label text-md-end">{{ __('Contact 1 Cell2') }}</label>

                            <div class="col-md-6">
                                <input id="contact_1_cell2" type="text" class="form-control @error('contact_1_cell2') is-invalid @enderror" name="contact_1_cell2"  value="{{ old('contact_1_cell2') }}">

                                @error('contact_1_cell2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection