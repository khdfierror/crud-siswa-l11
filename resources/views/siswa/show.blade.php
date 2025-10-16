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
<body class="bg-gradient-to-br from-pink-50 via-white to-pink-100">

    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">

            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('siswa.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-white hover:bg-pink-50 text-gray-700 font-medium rounded-lg border border-pink-200 transition-all duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Daftar Siswa
                </a>
            </div>

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-pink-600 to-pink-500 bg-clip-text text-transparent mb-2">Detail Siswa</h1>
                <p class="text-gray-600">Informasi lengkap data siswa</p>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left Column - Photo Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl shadow-lg border border-pink-100 overflow-hidden sticky top-6">
                        <!-- Photo Section -->
                        <div class="h-24 bg-gradient-to-r from-pink-400 to-pink-300"></div>

                        <div class="px-6 pb-6 -mt-12 relative">
                            <!-- Photo -->
                            <div class="flex justify-center mb-4">
                                <img src="{{ $siswa->foto ? asset('storage/siswa/'.$siswa->foto) : 'https://ui-avatars.com/api/?name='.urlencode($siswa->nama).'&size=150&background=ec4899&color=fff' }}"
                                     alt="{{ $siswa->nama }}"
                                     class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md">
                            </div>

                            <!-- Student Name & NIS -->
                            <h2 class="text-2xl font-bold text-gray-900 mb-1 text-center">{{ $siswa->nama }}</h2>
                            <div class="flex items-center justify-center gap-2 text-gray-600 mb-6">
                                <i class="fas fa-id-card text-sm"></i>
                                <span class="font-semibold">{{ $siswa->nis }}</span>
                            </div>

                            <!-- Status Badge -->
                            <div class="mb-6">
                                @if($siswa->status == 'aktif')
                                <span class="inline-flex items-center justify-center w-full px-3 py-2 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full mr-1.5 animate-pulse"></span>
                                    Aktif
                                </span>
                                @else
                                <span class="inline-flex items-center justify-center w-full px-3 py-2 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                    <span class="w-2 h-2 bg-red-500 rounded-full mr-1.5"></span>
                                    Tidak Aktif
                                </span>
                                @endif
                            </div>

                            <!-- Quick Info -->
                            <div class="space-y-3 p-4 bg-pink-50 rounded-lg mb-6">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 font-medium">Jenis Kelamin</span>
                                    <span class="font-bold text-gray-900">
                                        {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 font-medium">Kelas</span>
                                    <span class="font-bold text-gray-900">{{ $siswa->kelas ?? '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 font-medium">Umur</span>
                                    <span class="font-bold text-gray-900">{{ $siswa->tanggal_lahir->age }} Tahun</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2">
                                <a href="{{ route('siswa.edit', $siswa->id) }}"
                                   class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-700 hover:to-pink-600 text-white font-bold rounded-lg transition-all duration-200">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit
                                </a>
                                <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')"
                                            class="w-full inline-flex items-center justify-center px-4 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition-all duration-200">
                                        <i class="fas fa-trash mr-2"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Details -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Personal Information -->
                    <div class="bg-white rounded-3xl shadow-lg border border-pink-100 overflow-hidden">
                        <div class="px-8 py-5 bg-gradient-to-r from-pink-50 to-white border-b border-pink-100">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <i class="fas fa-user-circle mr-3 text-pink-600 text-xl"></i>
                                Informasi Pribadi
                            </h3>
                        </div>
                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">Nama Lengkap</label>
                                    <p class="text-gray-900 font-semibold">{{ $siswa->nama }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">NIS</label>
                                    <p class="text-gray-900 font-semibold">{{ $siswa->nis }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">Jenis Kelamin</label>
                                    <p class="text-gray-900 font-semibold">
                                        {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </p>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">Tempat Lahir</label>
                                    <p class="text-gray-900 font-semibold">{{ $siswa->tempat_lahir }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">Tanggal Lahir</label>
                                    <p class="text-gray-900 font-semibold">{{ $siswa->tanggal_lahir->format('d F Y') }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">Umur</label>
                                    <p class="text-gray-900 font-semibold">{{ $siswa->tanggal_lahir->age }} Tahun</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">Alamat</label>
                                    <p class="text-gray-900 font-semibold leading-relaxed">{{ $siswa->alamat }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="bg-white rounded-3xl shadow-lg border border-pink-100 overflow-hidden">
                        <div class="px-8 py-5 bg-gradient-to-r from-pink-50 to-white border-b border-pink-100">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <i class="fas fa-book mr-3 text-pink-600 text-xl"></i>
                                Informasi Akademik
                            </h3>
                        </div>
                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">Kelas</label>
                                    <p class="text-gray-900 font-semibold">{{ $siswa->kelas ?? '-' }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">Status</label>
                                    @if($siswa->status == 'aktif')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span>
                                        Aktif
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                        Tidak Aktif
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Parent & Contact Information -->
                    <div class="bg-white rounded-3xl shadow-lg border border-pink-100 overflow-hidden">
                        <div class="px-8 py-5 bg-gradient-to-r from-pink-50 to-white border-b border-pink-100">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <i class="fas fa-phone mr-3 text-pink-600 text-xl"></i>
                                Informasi Orang Tua & Kontak
                            </h3>
                        </div>
                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">Nama Orang Tua</label>
                                    <p class="text-gray-900 font-semibold">{{ $siswa->nama_orang_tua }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">Nomor Telepon</label>
                                    <p class="text-gray-900 font-semibold">
                                        @if($siswa->telepon)
                                        <a href="tel:{{ $siswa->telepon }}" class="text-pink-600 hover:text-pink-700 hover:underline">
                                            {{ $siswa->telepon }}
                                        </a>
                                        @else
                                        -
                                        @endif
                                    </p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">Email</label>
                                    <p class="text-gray-900 font-semibold">
                                        @if($siswa->email)
                                        <a href="mailto:{{ $siswa->email }}" class="text-pink-600 hover:text-pink-700 hover:underline">
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
                    <div class="bg-white rounded-3xl shadow-lg border border-pink-100 overflow-hidden">
                        <div class="px-8 py-5 bg-gradient-to-r from-pink-50 to-white border-b border-pink-100">
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <i class="fas fa-info-circle mr-3 text-pink-600 text-xl"></i>
                                Informasi Sistem
                            </h3>
                        </div>
                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">Dibuat Pada</label>
                                    <p class="text-gray-900 font-semibold">{{ $siswa->created_at->format('d F Y, H:i') }} WIB</p>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-pink-600 uppercase tracking-wider mb-2 block">Terakhir Diupdate</label>
                                    <p class="text-gray-900 font-semibold">{{ $siswa->updated_at->format('d F Y, H:i') }} WIB</p>
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
