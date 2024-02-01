<div class="mb-3">
    <label for="file-input">
        Foto
    </label>
    <div class="d-flex justify-content-center mt-2">
        <div class="card" style="background-color: #f5f5f5; max-width: 75%;">
            <div class="card-body d-flex align-items-center flex-column">
                <img id="image-preview" src="" alt="Image Preview" class="img-fluid rounded image-preview mb-3" />
                <input type="file" name="foto" id="file-input" class="form-control" accept="image/*" onchange="previewImage()" />
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <label for="file-input-edit-{{$siswa->id}}">
        Foto
    </label>
    <div class="d-flex justify-content-center mt-2">
        <div class="card" style="background-color: #f5f5f5; max-width: 75%;">
            <div class="card-body d-flex align-items-center flex-column edit-modal" id="up-preview-image-{{$siswa->id}}" data-foto-url="{{$siswa->foto}}">
                <img id="image-preview-edit-{{$siswa->id}}" src="" alt="Image Preview" class="img-fluid rounded image-preview-edit mb-3"  />
                <input type="file" name="foto" id="file-input-edit-{{$siswa->id}}" class="form-control" accept="image/*" onchange="previewImageEdit({{$siswa->id}})" />
            </div>
        </div>
    </div>
</div>

