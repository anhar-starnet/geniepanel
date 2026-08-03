<div class="row">

    <div class="col-md-6">

        <div class="form-group">
            <label>Kode</label>
            <input
                type="text"
                name="code"
                class="form-control"
                value="{{ old('code', $package->code ?? '') }}">
        </div>

        <div class="form-group">
            <label>Nama Paket</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name', $package->name ?? '') }}">
        </div>

        <div class="form-group">
            <label>Download (Kbps)</label>
            <input
                type="number"
                name="download_kbps"
                class="form-control"
                value="{{ old('download_kbps', $package->download_kbps ?? '') }}">
        </div>

        <div class="form-group">
            <label>Upload (Kbps)</label>
            <input
                type="number"
                name="upload_kbps"
                class="form-control"
                value="{{ old('upload_kbps', $package->upload_kbps ?? '') }}">
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">
            <label>Harga</label>
            <input
                type="number"
                name="price"
                class="form-control"
                value="{{ old('price', $package->price ?? '') }}">
        </div>

        <div class="form-group">
            <label>PPN (%)</label>
            <input
                type="number"
                name="ppn"
                class="form-control"
                value="{{ old('ppn', $package->ppn ?? 11) }}">
        </div>

        <div class="form-group">
            <label>Status</label>

            <select name="status" class="form-control">

                <option value="1">Aktif</option>
                <option value="0">Non Aktif</option>

            </select>

        </div>

        <div class="form-group">

            <label>Deskripsi</label>

            <textarea
                name="description"
                class="form-control"
                rows="4">{{ old('description', $package->description ?? '') }}</textarea>

        </div>

    </div>

</div>