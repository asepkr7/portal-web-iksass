@extends('Layout.Dashboard.main')
@section('container')
    <div class="section">
        <div class="section-header">
            <h1>Post Terhapus</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Daftar Post yang Dihapus</h4>
                        <div class="d-flex">
                            <!-- Restore All Form -->
                            <form id="restore-all-form" action="{{ route('dashboard.posts.restoreAll') }}" method="POST"
                                class="mr-2">
                                @csrf
                                <button type="submit" class="btn btn-warning">Pulihkan Semua</button>
                            </form>

                            <!-- Force Delete All Form -->
                            <form action="{{ route('dashboard.posts.forceDeleteAll') }}" method="POST" id="deleteAllForm">
                                @csrf
                                {{-- @method('DELETE') --}}
                                <button type="button" class="btn btn-danger" onclick="confirmDeleteAll()">
                                    Hapus Permanen Semua
                                </button>
                            </form>




                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Label</th>
                                    <th>Tanggal Dihapus</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($deletedPosts as $key => $post)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->label }}</td>
                                        <td>{{ $post->deleted_at->format('d-M-Y') }}</td>
                                        <td>
                                            <!-- Restore Form -->
                                            <form class="d-inline"
                                                action="{{ route('dashboard.posts.restore', $post->slug) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm">Pulihkan</button>
                                            </form>

                                            <!-- Force Delete Form -->
                                            <form class="d-inline delete-form"
                                                action="{{ route('dashboard.posts.forceDelete', $post->slug) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmSingleDelete(this)">
                                                    Hapus Permanen
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pastikan SweetAlert2 dimasukkan sebelum script kita -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Function untuk konfirmasi hapus single item
        function confirmSingleDelete(button) {
            const form = button.closest('form');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        // Function untuk konfirmasi hapus semua
        function confirmDeleteAll() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Semua post akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus semua!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('deleteAllForm');
                    // Jika form menggunakan POST method, pastikan @method('DELETE') bekerja
                    form.submit();
                }
            });
        }


        // Tambahkan ini untuk debug
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Script loaded');

            // Test SweetAlert
            window.testSweetAlert = function() {
                Swal.fire('Test', 'SweetAlert is working!', 'success');
            }
        });
    </script>
@endsection
