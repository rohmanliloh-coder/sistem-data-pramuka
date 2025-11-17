@csrf

<div class="row">
    <div class="col-md-8">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $anggota->nama ?? '') }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control">{{ old('alamat', $anggota->alamat ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control"
                value="{{ old('tanggal_lahir', isset($anggota->tanggal_lahir) ? $anggota->tanggal_lahir->format('Y-m-d') : '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Golongan</label>
            <select name="golongan_id" class="form-control">
                <option value="">-- Pilih --</option>
                @foreach ($golongans as $g)
                    <option value="{{ $g->id }}" @selected(old('golongan_id', $anggota->golongan_id ?? '') == $g->id)>
                        {{ $g->nama_golongan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ikut Kegiatan</label>
            <div class="border p-2">
                @foreach ($kegiatans as $k)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="kegiatan_id[]" value="{{ $k->id }}"
                            @if (isset($anggota) && $anggota->kegiatans->contains($k->id)) checked @endif>
                        <label class="form-check-label">
                            {{ $k->nama_kegiatan }} ({{ $k->tanggal }})
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Foto (opsional)</label>
            <input type="file" name="foto" class="form-control">

            @if (isset($anggota) && $anggota->foto)
                <img src="{{ asset('photos/' . $anggota->foto) }}" class="mt-2 w-100" alt="foto">
            @endif
        </div>

        <div class="d-grid">
            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('anggota.index') }}" class="btn btn-secondary mt-2">Batal</a>
        </div>
    </div>
</div>
