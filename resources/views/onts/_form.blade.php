@csrf

@if(isset($ont))
    @method('PUT')
@endif

<div class="row">

    <div class="col-md-6">

        <div class="form-group">
            <label>Kode ONT</label>

            <input
                type="text"
                name="code"
                class="form-control @error('code') is-invalid @enderror"
                value="{{ old('code', $ont->code ?? $code ?? '') }}"
                readonly
            >

            @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">
            <label>Vendor</label>

            <input
                type="text"
                name="vendor"
                class="form-control @error('vendor') is-invalid @enderror"
                value="{{ old('vendor', $ont->vendor ?? '') }}"
                placeholder="Contoh: Huawei"
            >

            @error('vendor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-6">

        <div class="form-group">
            <label>Model</label>

            <input
                type="text"
                name="model"
                class="form-control @error('model') is-invalid @enderror"
                value="{{ old('model', $ont->model ?? '') }}"
                placeholder="Contoh: HG8145V5"
            >

            @error('model')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">
            <label>Serial Number</label>

            <input
                type="text"
                name="serial_number"
                class="form-control @error('serial_number') is-invalid @enderror"
                value="{{ old('serial_number', $ont->serial_number ?? '') }}"
            >

            @error('serial_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-6">

        <div class="form-group">
            <label>Firmware</label>

            <input
                type="text"
                name="firmware"
                class="form-control @error('firmware') is-invalid @enderror"
                value="{{ old('firmware', $ont->firmware ?? '') }}"
            >

            @error('firmware')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">
            <label>Device ID GenieACS</label>

            <input
                type="text"
                name="genieacs_device_id"
                class="form-control @error('genieacs_device_id') is-invalid @enderror"
                value="{{ old('genieacs_device_id', $ont->genieacs_device_id ?? '') }}"
            >

            @error('genieacs_device_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

</div>

<div class="form-group">

    <label>Catatan</label>

    <textarea
        name="notes"
        rows="4"
        class="form-control @error('notes') is-invalid @enderror"
    >{{ old('notes', $ont->notes ?? '') }}</textarea>

    @error('notes')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>

<div class="form-group">

    <div class="custom-control custom-switch">

        <input
            type="checkbox"
            class="custom-control-input"
            id="status"
            name="status"
            value="1"
            {{ old('status', $ont->status ?? true) ? 'checked' : '' }}
        >

        <label class="custom-control-label" for="status">
            ONT Aktif
        </label>

    </div>

</div>

<div class="mt-4">

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i>
        Simpan
    </button>

    <a href="{{ route('onts.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Batal
    </a>

</div>