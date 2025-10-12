<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Siswa - Aplikasi CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50">

    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Sistem Informasi Siswa</h1>
                <p class="text-gray-600">Kelola data siswa dengan mudah dan efisien</p>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <!-- Card Header -->
                <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <h2 class="text-xl font-semibold text-gray-800">Data Siswa</h2>
                        <a href="{{ route('siswa.create') }}"
                           class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Siswa
                        </a>
                    </div>
                </div>

                <!-- Search & Filter Section -->
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                    <form action="{{ route('siswa.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Cari nama, NIS, atau kelas..."
                                       class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                            </div>
                        </div>
                        <div class="sm:w-48">
                            <select name="status"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                        <button type="submit"
                                class="px-6 py-2.5 bg-gray-800 hover:bg-gray-900 text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-filter mr-2"></i>
                            Filter
                        </button>
                        @if(request('search') || request('status'))
                        <a href="{{ route('siswa.index') }}"
                           class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i>
                            Reset
                        </a>
                        @endif
                    </form>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NIS</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kelas</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Kelamin</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($siswa as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <img src="{{ $item->foto ? asset('storage/siswa/'.$item->foto) : 'https://ui-avatars.com/api/?name='.urlencode($item->nama).'&background=random' }}"
                                         alt="{{ $item->nama }}"
                                         class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900">{{ $item->nis }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900">{{ $item->kelas ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900">{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($item->status == 'aktif')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                        Aktif
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                        Tidak Aktif
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('siswa.show', $item->id) }}"
                                           class="inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors duration-200"
                                           title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('siswa.edit', $item->id) }}"
                                           class="inline-flex items-center px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm font-medium rounded-lg transition-colors duration-200"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 text-sm font-medium rounded-lg transition-colors duration-200"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                                        <h3 class="text-lg font-medium text-gray-900 mb-1">Data Tidak Ditemukan</h3>
                                        <p class="text-gray-500">Belum ada data siswa yang tersedia.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($siswa->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-sm text-gray-600">
                            Menampilkan <span class="font-medium">{{ $siswa->firstItem() }}</span>
                            sampai <span class="font-medium">{{ $siswa->lastItem() }}</span>
                            dari <span class="font-medium">{{ $siswa->total() }}</span> data
                        </div>
                        <div>
                            {{ $siswa->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Footer Info -->
            <div class="mt-6 text-center text-sm text-gray-500">
                <p>Sistem Informasi Manajemen Siswa &copy; 2025</p>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Success & Error Messages
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session("error") }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        @endif
    </script>

</body>
</html>
