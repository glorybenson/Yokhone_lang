@extends('layouts.app')
@section('content')
<div class="content container-fluid">
    @if(isset($mode) && $mode == "edit")
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">Edit Invoice Data</h4>
                    <div class="text-right">
                        <a href="{{ route('invoices') }}" class="btn btn-secondary p-2">Back to Invoices</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('edit.invoice',  $invoice->id) }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $invoice->id }}">
                        <div class="row">
                            <label for="client_name" class="col-md-4 col-form-label text-md-end">Client Name</label>
                            <div class="col-md-8 mb-3">
                                <select class="form-control @error('client_name') is-invalid @enderror" name="client_name" required>
                                    <option value="">Select an Client</option>
                                    @if(isset($clients))
                                    @foreach($clients as $client)
                                    <option value="{{$client->id}}" {{ $invoice->client_id == $client->id ? 'selected' : '' }}>{{$client->client_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('client_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Date') }}</label>
                            <div class="col-md-8">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" required name="date" value="{{ $invoice->date }}">
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="desc" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                            <div class="col-md-8">
                                <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc" required>{{ $invoice->desc }}</textarea>
                                @error('desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="quantity" class="col-md-4 col-form-label text-md-end">{{ __('Quantity') }}</label>
                            <div class="col-md-8">
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $invoice->quantity }}" autocomplete="" required>
                                @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="unit_price" class="col-md-4 col-form-label text-md-end">{{ __('Unit Price') }}</label>
                            <div class="col-md-8">
                                <input id="unit_price" type="number" class="form-control @error('unit_price') is-invalid @enderror" name="unit_price" value="{{ $invoice->unit_price }}" autocomplete="date" required>
                                @error('unit_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="total_price_before_discount" class="col-md-4 col-form-label text-md-end">{{ __('Total Price before discount') }}</label>
                            <div class="col-md-8">
                                <input id="total_price_before_discount" type="number" class="form-control @error('total_price_before_discount') is-invalid @enderror" name="total_price_before_discount" required value="{{ $invoice->total_price_before_discount }}" autocomplete="">
                                @error('total_price_before_discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="discount" class="col-md-4 col-form-label text-md-end">{{ __('Discount') }}</label>
                            <div class="col-md-8">
                                <input id="discount" type="number" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ $invoice->discount }}" autocomplete="date" required>
                                @error('discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="total_price_after_discount" class="col-md-4 col-form-label text-md-end">{{ __('Total Price after discount') }}</label>
                            <div class="col-md-8">
                                <input id="total_price_after_discount" type="number" class="form-control @error('total_price_after_discount') is-invalid @enderror" name="total_price_after_discount" value="{{ $invoice->total_price_after_discount }}" required autocomplete="date">
                                @error('total_price_after_discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="row">
                            <label for="farm" class="col-md-4 col-form-label text-md-end">Farm</label>
                            <div class="col-md-8 mb-3">
                                <select class="form-control @error('farm') is-invalid @enderror" name="farm" required>
                                    <option value="">Select an Farm</option>
                                    @if(isset($farms))
                                    @foreach($farms as $farm)
                                    <option value="{{$farm->id}}" {{ $invoice->farm_id == $farm->id ? 'selected' : '' }}>{{$farm->farm_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('farm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to submit this form?')">
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
                    <h4 class="card-title float-left">Create Invoice</h4>
                    <div class="text-right">
                        <a href="{{ route('invoices') }}" class="btn btn-secondary p-2">Back to Invoices</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('create.invoice') }}">
                        @csrf
                        <div class="row">
                            <label for="client_name" class="col-md-4 col-form-label text-md-end">Client Name</label>
                            <div class="col-md-8 mb-3">
                                <select class="form-control @error('client_name') is-invalid @enderror" name="client_name" required>
                                    <option value="">Select an Client</option>
                                    @if(isset($clients))
                                    @foreach($clients as $client)
                                    <option value="{{$client->id}}" {{ old('client_name') == $client->id ? 'selected' : '' }}>{{$client->client_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('client_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Date') }}</label>
                            <div class="col-md-8">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" required name="date" value="{{ old('date') }}">
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="desc" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                            <div class="col-md-8">
                                <textarea id="desc" class="form-control @error('desc') is-invalid @enderror" required name="desc">{{ old('desc') }}</textarea>
                                @error('desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="quantity" class="col-md-4 col-form-label text-md-end">{{ __('Quantity') }}</label>
                            <div class="col-md-8">
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" autocomplete="" required>
                                @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="unit_price" class="col-md-4 col-form-label text-md-end">{{ __('Unit Price') }}</label>
                            <div class="col-md-8">
                                <input id="unit_price" type="number" class="form-control @error('unit_price') is-invalid @enderror" name="unit_price" value="{{ old('unit_price') }}" required>
                                @error('unit_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="total_price_before_discount" class="col-md-4 col-form-label text-md-end">{{ __('Total Price before discount') }}</label>
                            <div class="col-md-8">
                                <input id="total_price_before_discount" type="number" class="form-control @error('total_price_before_discount') is-invalid @enderror" name="total_price_before_discount" value="{{ old('total_price_before_discount') }}" required>
                                @error('total_price_before_discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="discount" class="col-md-4 col-form-label text-md-end">{{ __('Discount') }}</label>
                            <div class="col-md-8">
                                <input id="discount" type="number" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ old('discount') }}" required>
                                @error('discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="total_price_after_discount" class="col-md-4 col-form-label text-md-end">{{ __('Total Price after discount') }}</label>
                            <div class="col-md-8">
                                <input id="total_price_after_discount" type="number" class="form-control @error('total_price_after_discount') is-invalid @enderror" name="total_price_after_discount" value="{{ old('total_price_after_discount') }}" required>
                                @error('total_price_after_discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="row">
                            <label for="farm" class="col-md-4 col-form-label text-md-end">Farm</label>
                            <div class="col-md-8 mb-3">
                                <select class="form-control @error('farm') is-invalid @enderror" name="farm" required>
                                    <option value="">Select an Farm</option>
                                    @if(isset($farms))
                                    @foreach($farms as $farm)
                                    <option value="{{$farm->id}}" {{ old('farm') == $farm->id ? 'selected' : '' }}>{{$farm->farm_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('farm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to submit this form?')">
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

<script type="text/javascript">
    function referred(id) {
        switch (id) {
            case "employee":
                document.getElementById('employee_div').style.display = 'block';
                document.getElementById('other_div').style.display = 'none';
                break;

            case "other":
                document.getElementById('other_div').style.display = 'block';
                document.getElementById('employee_div').style.display = 'none';
                break;

            default:
                document.getElementById('other_div').style.display = 'none';
                document.getElementById('employee_div').style.display = 'none';
                break;
        }

    }
    document.onreadystatechange = function() {
        referred_by_id = document.getElementById('referred_by_id').value
        referred(referred_by_id)
    }
    window.onload = referred(id);
</script>
@endsection