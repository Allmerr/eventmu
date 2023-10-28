@extends('studio.layouts.main')
@section('content')

@push('css')
    <style>

    </style>
@endpush

<h1>Create Post</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('studio.servers.posts.store', $server->code) }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-3">
                <label for="caption" class="form-label">caption</label>
                <input type="text" name="caption" id="caption"
                 class="form-control @error('caption') is-invalid @enderror"
                 placeholder="caption" value="{{ old('caption') }}">
                @error('caption')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <img class="img-preview img-fluid mb-3">
                <label for="image" class="form-label">image</label>
                <input type="file" name="image" id="image"
                 class="form-control @error('image') is-invalid @enderror"
                 accept=".png, .jpg, .jpeg" value="{{ old('image') }}" onchange="previewphoto()">
                 <small class="form-text text-muted">dokumen extensions yang diijinkan : .jpeg .jpg .png</small>
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>

@push('js')
<script>
$(document).ready( function () {
    $('#table').DataTable({
        responsive: true
    });
} );
</script>
<script>
function previewphoto(){
    const photo = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(photo.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }

    imgPreview.style.width = '300px';
}
</script>

@endpush

@endsection
