@extends('Layout.Dashboard.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-back pl-2">
                <a href="{{ route('dashboard.posts.create') }}" class="btn btn-icon btn-primary" title="Add Data Pegawai"><i
                        class="fa fa-plus"></i> Add</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session()->has('delete'))
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('delete') }}
                </div>
            </div>
        @endif
        @if (session()->has('edit'))
            <div class="alert alert-warning alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('edit') }}
                </div>
            </div>
        @endif
        <div class="section-body">
            <h2 class="section-title">Table Posts</h2>
            <p class="section-lead pt-1">
            <form>
                <div class="ml-4">
                    <label for="show_entries" class="form-label">Show :</label>
                    <select name="show_entries" id="show_entries" class="form-actions">
                        <option value="10" {{ request()->input('show_entries') == '10' ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request()->input('show_entries') == '20' ? 'selected' : '' }}>20</option>
                        <option value="50" {{ request()->input('show_entries') == '50' ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request()->input('show_entries') == '100' ? 'selected' : '' }}>100
                        </option>
                    </select>
                    <label for=""> Entries</label>
                </div>
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Post yang Dihapus</h4>
                    <div>
                        <a href="{{ route('dashboard.posts.deleted') }}" class="btn btn-info">Lihat Post Terhapus</a>
                    </div>
                                <div class="card-header-form">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
            </form>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>
                        <div class="custom-checkbox custom-control">
                            <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                class="custom-control-input" id="checkbox-all">
                            <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                        </div>
                    </th>
                    <th width='10'>No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Label</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                @foreach ($posts as $key => $post)
                    <tr>
                        <td class="p-0 text-center">
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                                    id="checkbox-3">
                                <label for="checkbox-3" class="custom-control-label">&nbsp;</label>
                            </div>
                        </td>
                        <td>{{ $posts->firstItem() + $key }}</td>

                        @if ($post->image)
                            <td><img src="{{ asset('storage/' . $post->image) }}" height="35px" alt="Foto Pegawai"
                                    class="rounded-circle mr-1"></td>
                        @else
                            <td class="badge badge-warning">Image is empty</td>
                        @endif
                        <td>
                            {{ $post->title }}
                        </td>
                        <td> @php
                            // Menentukan jumlah kata maksimal
                            $maxWords = 10;
                            // Menghitung jumlah kata
                            $wordCount = str_word_count($post->content);
                            // Memotong konten jika lebih dari $maxWords
                            $shortContent = implode(' ', array_slice(explode(' ', $post->content), 0, $maxWords));
                            // Jika lebih banyak kata, tambahkan '...'
                            if ($wordCount > $maxWords) {
                                $shortContent .= '...';
                            }
                        @endphp

                            <p>{{ $shortContent }}</p>
                        </td>
                        <td>{{ $post->label }}</td>
                        <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d-M-Y') }}</td>
                        <td>
                            <div class="form-group row">
                                @if (Auth::user()->role == 'admin')
                                    <a href="{{ route('news.show', $post->slug) }}"
                                        class="btn btn-primary btn-sm mr-1 btn-small"> <i class="fas fa-eye"></i></a>
                                    <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning btn-sm ">
                                        <i class="fas fa-edit"></i></a>
                                    <form action="{{ route('dashboard.posts.edit', $post->slug, 'edit') }}"
                                        class="align-content-center btn-sm">
                                    </form>
                                    <form action="{{ route('dashboard.posts.destroy', $post->slug) }}" method="POST"
                                        class="d-inline ml-3 mt-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm mr-3" id="delete-button">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="/dashboard/posts/{{ $post->slug }}" class="btn btn-primary btn-sm ml-3"> <i
                                            class="fas fa-eye"></i></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
    <div class="card-footer text-right">
        <div class="text-left">
            <i> Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} Entires</i>
        </div>
        <nav class="pull-right d-lg-inline-block">
            <ul class="pagination mb-0">
                <li class="page-item{{ $posts->onFirstPage() ? ' disabled' : '' }}">
                    <a class="page-link" href="{{ $posts->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                </li>

                @if ($posts->lastPage() > 1)
                    @for ($i = 1; $i <= $posts->lastPage(); $i++)
                        <li class="page-item{{ $posts->currentPage() === $i ? ' active' : '' }}">
                            <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                @endif

                <li class="page-item{{ $posts->hasMorePages() ? '' : ' disabled' }}">
                    <a class="page-link" href="{{ $posts->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
    </div>
    </div>
    </div>
    </div>

    </div>
    <script>
        // Menangani konfirmasi SweetAlert sebelum penghapusan
        document.addEventListener('click', function(event) {
            if (event.target && event.target.id === 'delete-button') {
                event.preventDefault(); // Mencegah penghapusan langsung

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika konfirmasi 'Yes', submit form untuk hapus data
                        event.target.closest('form').submit();
                    }
                });
            }
        });
    </script>
@endsection
