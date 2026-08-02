@extends('adminlte::page')

@section('title', 'Edit Pelanggan')

@section('content_header')
<h1>Edit Pelanggan</h1>
@stop

@section('content')

<div class="card">

<div class="card-body">

<form action="{{ route('customers.update',$customer->id) }}" method="POST">

@csrf
@method('PUT')

<div class="form-group mb-3">
<label>Kode Pelanggan</label>
<input
type="text"
name="customer_code"
class="form-control"
value="{{ $customer->customer_code }}"
required>
</div>

<div class="form-group mb-3">
<label>Nama</label>
<input
type="text"
name="name"
class="form-control"
value="{{ $customer->name }}"
required>
</div>

<div class="form-group mb-3">
<label>Nomor HP</label>
<input
type="text"
name="phone"
class="form-control"
value="{{ $customer->phone }}">
</div>

<div class="form-group mb-3">
<label>Email</label>
<input
type="email"
name="email"
class="form-control"
value="{{ $customer->email }}">
</div>

<div class="form-group mb-3">
<label>Alamat</label>

<textarea
name="address"
class="form-control">{{ $customer->address }}</textarea>

</div>

<div class="form-group mb-3">

<label>Status</label>

<select name="status" class="form-control">

<option value="Active"
{{ $customer->status=='Active'?'selected':'' }}>
Active
</option>

<option value="Inactive"
{{ $customer->status=='Inactive'?'selected':'' }}>
Inactive
</option>

<option value="Suspend"
{{ $customer->status=='Suspend'?'selected':'' }}>
Suspend
</option>

</select>

</div>

<button class="btn btn-success">

Update

</button>

<a
href="{{ route('customers.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

@stop
