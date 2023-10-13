@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('create') }}" class="btn btn-md btn-warning mb-3">Tambah Data</a>
                    <table class="table table-bordered table-striped">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">Nama Tugas</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Status</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tugas as $task)
                                <tr>
                                    <td>{{ $task->nama }}</td>
                                      <td>{!! htmlspecialchars($task->deskripsi) !!}</td>
                                    <td>
                                        @if($task->status == 1)
                                            Selesai
                                        @else
                                            Belum Selesai
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{ Storage::url('public/tasks/' . $task->image) }}" class="rounded" style="width: 150px">
                                    </td>
                                 
                                     <td>
                                        <button class="btn btn-sm btn-success mark-as-done-button" data-task-id="{{ $task->id }}">Selesai</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data Tugas belum Tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    //message with toastr
    @if(session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 
    @elseif(session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!'); 
    @endif
</script>
<script>
    $(document).ready(function () {
        $('.mark-as-done-button').click(function () {
            if (confirm('Anda yakin ingin menandai tugas ini sebagai selesai?')) {
                // Jika pengguna menekan "OK," lakukan tindakan yang diperlukan di sini.
                var taskId = $(this).data('task-id'); // Ambil ID tugas dari atribut data-task-id
                // Lakukan permintaan AJAX atau tindakan lain sesuai kebutuhan
                // Contoh permintaan AJAX:
                $.ajax({
                    url: '/mark-as-done/' + taskId,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        // Tindakan sukses setelah menandai tugas sebagai selesai
                        location.reload(); // Refresh halaman untuk memperbarui data tugas
                    }
                });
            }
        });
    });
</script>



@endsection
