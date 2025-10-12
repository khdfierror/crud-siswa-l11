<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Siswa - {{ $siswa->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50">

    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">

            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('siswa.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 font-medium rounded-lg border border-gray-200 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Daftar Siswa
                </a>
            </div>

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Detail Siswa</h1>
                <p class="text-gray-600">Informasi lengkap data siswa</p>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left Column - Photo Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                        <!-- Photo Section -->
                        <div class="p-6">
                            <div class="relative">
                                <img src="{{ $siswa->foto ? asset('storage/siswa/'.$siswa->foto) : 'https://ui-avatars.com/api/?name='.urlencode($siswa->nama).'&size=400&background=random' }}"
                                     alt="{{ $siswa->nama }}"
                                     class="w-full aspect-square object-cover rounded-xl border-4 border-gray-100">

                                <!-- Status Badge on Photo -->
                                <div class="absolute top-3 right-3">
                                    @if($siswa->status == 'aktif')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-green-500 text-white shadow-lg">
                                        <span class="w-2 h-2 bg-white rounded-full mr-1.5 animate-pulse"></span>
                                        Aktif
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-red-500 text-white shadow-lg">
                                        <span class="w-2 h-2 bg-white rounded-full mr-1.5"></span>
                                        Tidak Aktif
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Student Name & NIS -->
                        <div class="px-6 pb-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-1 text-center">{{ $siswa->nama }}</h2>
                            <div class="flex items-center justify-center gap-2 text-gray-600 mb-4">
                                <i class="fas fa-id-card text-sm"></i>
                                <span class="font-medium">{{ $siswa->nis }}</span>
                            </div>

                            <!-- Quick Info -->
                            <div class="space-y-2 pt-4 border-t border-gray-100">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Jenis Kelamin</span>
                                    <span class="font-semibold text-gray-900">
                                        {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Kelas</span>
                                    <span class="font-semibold text-gray-900">{{ $siswa->kelas ?? '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Umur</span>
                                    <span class="font-semibold text-gray-900">{{ $siswa->tanggal_lahir->age }} Tahun</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="px-6 pb-6 flex gap-2">
                            <a href="{{ route('siswa.edit', $siswa->id) }}"
                               class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </a>
                            <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')"
                                        class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Details -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Personal Information -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-user mr-2 text-blue-600"></i>
                                Informasi Pribadi
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">Nama Lengkap</label>
                                    <p class="text-gray-900 font-medium">{{ $siswa->nama }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">NIS</label>
                                    <p class="text-gray-900 font-medium">{{ $siswa->nis }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">Jenis Kelamin</label>
                                    <p class="text-gray-900 font-medium">
                                        {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </p>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">Tempat Lahir</label>
                                    <p class="text-gray-900 font-medium">{{ $siswa->tempat_lahir }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">Tanggal Lahir</label>
                                    <p class="text-gray-900 font-medium">{{ $siswa->tanggal_lahir->format('d F Y') }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">Umur</label>
                                    <p class="text-gray-900 font-medium">{{ $siswa->tanggal_lahir->age }} Tahun</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">Alamat</label>
                                    <p class="text-gray-900 font-medium leading-relaxed">{{ $siswa->alamat }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-graduation-cap mr-2 text-blue-600"></i>
                                Informasi Akademik
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">Kelas</label>
                                    <p class="text-gray-900 font-medium">{{ $siswa->kelas ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">Status</label>
                                    @if($siswa->status == 'aktif')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                        Aktif
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                        Tidak Aktif
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Parent & Contact Information -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-users mr-2 text-blue-600"></i>
                                Informasi Orang Tua & Kontak
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">Nama Orang Tua</label>
                                    <p class="text-gray-900 font-medium">{{ $siswa->nama_orang_tua }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">Nomor Telepon</label>
                                    <p class="text-gray-900 font-medium">
                                        @if($siswa->telepon)
                                        <a href="tel:{{ $siswa->telepon }}" class="text-blue-600 hover:text-blue-700 hover:underline">
                                            {{ $siswa->telepon }}
                                        </a>
                                        @else
                                        -
                                        @endif
                                    </p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">Email</label>
                                    <p class="text-gray-900 font-medium">
                                        @if($siswa->email)
                                        <a href="mailto:{{ $siswa->email }}" class="text-blue-600 hover:text-blue-700 hover:underline">
                                            {{ $siswa->email }}
                                        </a>
                                        @else
                                        -
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                                Informasi Sistem
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">Dibuat Pada</label>
                                    <p class="text-gray-900 font-medium">{{ $siswa->created_at->format('d F Y, H:i') }} WIB</p>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1 block">Terakhir Diupdate</label>
                                    <p class="text-gray-900 font-medium">{{ $siswa->updated_at->format('d F Y, H:i') }} WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</body>
</html>
