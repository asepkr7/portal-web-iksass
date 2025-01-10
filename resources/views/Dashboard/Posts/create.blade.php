@extends('Layout.Dashboard.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <h1>Add News</h1>
            <div class="section-header-back pl-2">
                <a href="{{ route('dashboard.posts') }}" class="btn btn-icon btn-primary" title="Add Data Pegawai"><i
                        class="fa fa-arrow-left"></i></a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Table Posts</h2>
            <p class="section-lead">lorem</p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Full Summernote</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('dashboard.posts.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="title"
                                            class="form-control  @error('title') is-invalid @enderror" required
                                            value="{{ old('title') }}">
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="label"
                                            class="form-control  @error('label') is-invalid @enderror
                                            selectric">
                                            <option value="Rutinan">Rutinan</option>
                                            <option value="Pengajian">Pengajian</option>
                                            <option value="Safari Ramadhan">Safari Ramadhan</option>
                                        </select>
                                        @error('label')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" id="image" name="image"
                                            class="form-control  @error('image') is-invalid @enderror"
                                            onchange="previewImage()">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="mt-3">
                                            <img class="img-preview img-circle mb-3 col-sm-4">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="content" class="summernote-simple  @error('content') is-invalid @enderror">value="{{ old('content') }}"</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Publish</button>
                                        <button class="btn btn-secondary" type="reset"><i class="fa fa-recycle"
                                                aria-hidden="true"></i> Reset</button>
                                        <a href="{{ route('dashboard.posts') }}" class="btn btn-default"><i
                                                class="fa fa-arrow-circle-left" aria-hidden="true"></i> Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="/template/assets/js/custom.js"></script>
@endsection
