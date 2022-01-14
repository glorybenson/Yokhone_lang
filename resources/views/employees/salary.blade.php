@extends('layouts.app')
@section('content')
<div class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">Employee's Salary History</h4>
                    <div class="text-right">
                        <a href="{{ route('employees') }}" class="btn btn-secondary p-2">Back to Employees</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6"><a href="{{ route('view.employee', $employee->id) }}" class="btn btn-dark">{{$employee->first_name}} {{$employee->last_name }}</a>
                        </div>
                        <div class="col-md-6"><a href="#" class="btn btn-primary">Salary History</a>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add New Salary
                        </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add New Salary</h5>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="salary_amount" class="col-md-4 col-form-label text-md-end">{{ __('Salary Amount') }}</label>
                                            <div class="col-md-6">
                                                <input id="salary_amount" type="number
                                                " class="form-control @error('salary_amount') is-invalid @enderror" name="salary_amount" value="{{ old('salary_amount') }}" autocomplete="first name" autofocus>

                                                @error('salary_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="salary_start_date" class="col-md-4 col-form-label text-md-end">{{ __('Salary Start Date') }}</label>
                                            <div class="col-md-6">
                                                <input id="salary_start_date" type="date" class="form-control @error('salary_start_date') is-invalid @enderror" name="salary_start_date" value="{{ old('salary_start_date') }}" autocomplete="first name" autofocus>

                                                @error('salary_start_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="current_salary" class="col-md-4 col-form-label text-md-end">{{ __('Current Salary') }}</label>
                                            <div class="col-md-6">
                                                <input id="current_salary" type="number" class="form-control @error('current_salary') is-invalid @enderror" name="current_salary" value="{{ old('current_salary') }}" autocomplete="first name" autofocus>

                                                @error('current_salary')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 table-striped border-0 data-table" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Salary Amount</th>
                                    <th>Salary Start Date</th>
                                    <th>Current Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{$employee->first_name}}</td>
                                    <td>{{$employee->first_name}}</td>
                                    <td>{{$employee->first_name}}</td>
                                    <td>
                                            <a href="" class="btn btn-sm p-2" title="Edit"><i class="fa fa-edit"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection