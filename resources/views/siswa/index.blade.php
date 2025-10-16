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
<body class="bg-gradient-to-br from-pink-50 via-white to-pink-100">

    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                    <div>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-pink-600 to-pink-500 bg-clip-text text-transparent mb-2">Data Siswa</h1>
                        <p class="text-gray-600">Kelola data siswa dengan mudah dan efisien</p>
                    </div>
                    <a href="{{ route('siswa.create') }}"
                       class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-700 hover:to-pink-600 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 whitespace-nowrap">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Siswa
                    </a>
                </div>
            </div>

            <!-- Search & Filter Card -->
            <div class="bg-white rounded-2xl shadow-md border border-pink-100 p-6 mb-6">
                <form action="{{ route('siswa.index') }}" method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Siswa</label>
                            <div class="relative">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Cari nama, NIS, atau kelas..."
                                       class="w-full pl-11 pr-4 py-2.5 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200">
                                <i class="fas fa-search absolute left-3.5 top-3.5 text-pink-400"></i>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Filter Status</label>
                            <select name="status"
                                    class="w-full px-4 py-2.5 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-2 justify-end">
                        <button type="submit"
                                class="px-6 py-2 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-lg transition-all duration-200">
                            <i class="fas fa-search mr-2"></i>
                            Cari
                        </button>
                        @if(request('search') || request('status'))
                        <a href="{{ route('siswa.index') }}"
                           class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition-colors duration-200">
                            <i class="fas fa-redo mr-2"></i>
                            Reset
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Stats Card -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-xl shadow-sm border border-pink-100 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Total Siswa</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $siswa->total() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-pink-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-pink-100 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Halaman</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $siswa->currentPage() }} / {{ $siswa->lastPage() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bookmark text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-pink-100 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Per Halaman</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $siswa->count() }} data</p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-list text-emerald-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Cards Grid -->
            @if($siswa->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($siswa as $item)
                <div class="bg-white rounded-2xl shadow-md border border-pink-100 overflow-hidden hover:shadow-lg hover:border-pink-300 transition-all duration-300">
                    <!-- Card Header with Background -->
                    <div class="h-20 bg-gradient-to-r from-pink-400 to-pink-300"></div>

                    <!-- Card Body -->
                    <div class="px-6 pb-6 -mt-10 relative">
                        <!-- Avatar -->
                        <div class="flex justify-center mb-4">
                            <img src="{{ $item->foto ? asset('storage/siswa/'.$item->foto) : 'https://ui-avatars.com/api/?name='.urlencode($item->nama).'&background=ec4899&color=fff&size=100' }}"
                                 alt="{{ $item->nama }}"
                                 class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md">
                        </div>

                        <!-- Info -->
                        <div class="text-center mb-4">
                            <h3 class="text-lg font-bold text-gray-900">{{ $item->nama }}</h3>
                            <p class="text-sm text-gray-600 mt-1">NIS: <span class="font-semibold">{{ $item->nis }}</span></p>
                            <p class="text-xs text-gray-500 mt-1">{{ $item->email ?? '-' }}</p>
                        </div>

                        <!-- Details Grid -->
                        <div class="grid grid-cols-2 gap-3 mb-4 p-3 bg-gray-50 rounded-lg">
                            <div>
                                <p class="text-xs text-gray-600 font-medium">Kelas</p>
                                <p class="text-sm font-bold text-gray-900">{{ $item->kelas ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 font-medium">Kelamin</p>
                                <p class="text-sm font-bold text-gray-900">{{ $item->jenis_kelamin == 'L' ? 'L' : 'P' }}</p>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div class="mb-4">
                            @if($item->status == 'aktif')
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 w-full justify-center">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full mr-1.5 animate-pulse"></span>
                                Aktif
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-red-100 text-red-800 w-full justify-center">
                                <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>
                                Tidak Aktif
                            </span>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <a href="{{ route('siswa.show', $item->id) }}"
                               class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-pink-100 hover:bg-pink-200 text-pink-700 font-semibold rounded-lg transition-all duration-200"
                               title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('siswa.edit', $item->id) }}"
                               class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 font-semibold rounded-lg transition-all duration-200"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')"
                                        class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-100 hover:bg-red-200 text-red-700 font-semibold rounded-lg transition-all duration-200"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
            @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-md border border-pink-100 p-12">
                <div class="flex flex-col items-center justify-center text-center">
                    <div class="w-20 h-20 bg-pink-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-inbox text-pink-400 text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Data Tidak Ditemukan</h3>
                    <p class="text-gray-500 mb-6">Belum ada data siswa yang tersedia.</p>
                    <a href="{{ route('siswa.create') }}"
                       class="px-6 py-2 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-lg transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Data Siswa
                    </a>
                </div>
            </div>
            @endif

            <!-- Pagination -->
            @if($siswa->hasPages())
            <div class="mt-8">
                {{ $siswa->links() }}
            </div>
            @endif

            <!-- Footer Info -->
            <div class="mt-12 text-center text-sm text-gray-500">
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
