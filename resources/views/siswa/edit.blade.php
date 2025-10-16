<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Siswa - {{ $siswa->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-pink-50 via-white to-pink-100">

    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">

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
                <h1 class="text-4xl font-bold bg-gradient-to-r from-pink-600 to-pink-500 bg-clip-text text-transparent mb-2">Edit Data Siswa</h1>
                <p class="text-gray-600">Perbarui informasi siswa <span class="font-semibold text-gray-900">{{ $siswa->nama }}</span></p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-3xl shadow-lg border border-pink-100 overflow-hidden">

                <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Photo Upload Section -->
                    <div class="px-8 py-8 bg-gradient-to-r from-pink-50 via-white to-pink-50 border-b border-pink-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-image mr-3 text-pink-600 text-xl"></i>
                            Foto Profil Siswa
                        </h3>
                        <div class="flex flex-col sm:flex-row items-start gap-8">
                            <!-- Preview Image -->
                            <div class="flex-shrink-0">
                                <img id="preview"
                                     src="{{ $siswa->foto ? asset('storage/siswa/'.$siswa->foto) : 'https://ui-avatars.com/api/?name='.urlencode($siswa->nama).'&size=150&background=fce7f3&color=ec4899' }}"
                                     alt="{{ $siswa->nama }}"
                                     class="w-32 h-32 rounded-2xl object-cover border-4 border-pink-200 shadow-md">
                            </div>
                            <!-- Upload Input -->
                            <div class="flex-1">
                                <label class="block text-sm font-bold text-gray-700 mb-3">Upload Foto Baru (Opsional)</label>
                                <input type="file"
                                       name="foto"
                                       id="foto"
                                       accept="image/*"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 transition-all duration-200">
                                <p class="mt-3 text-xs text-gray-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Format: JPG, JPEG, PNG | Maksimal 2MB
                                </p>
                                @if($siswa->foto)
                                <p class="mt-2 text-xs text-gray-600">
                                    <i class="fas fa-check-circle mr-1 text-emerald-500"></i>
                                    Foto saat ini akan diganti jika Anda upload foto baru
                                </p>
                                @endif
                                @error('foto')
                                <p class="mt-2 text-sm text-red-600">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="p-8 space-y-8">

                        <!-- Informasi Pribadi -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-user-circle mr-3 text-pink-600 text-xl"></i>
                                Informasi Pribadi
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- NIS -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        NIS <span class="text-pink-600">*</span>
                                    </label>
                                    <input type="text"
                                           name="nis"
                                           value="{{ old('nis', $siswa->nis) }}"
                                           placeholder="Masukkan NIS"
                                           class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 @error('nis') border-red-300 @enderror">
                                    @error('nis')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <!-- Nama Lengkap -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nama Lengkap <span class="text-pink-600">*</span>
                                    </label>
                                    <input type="text"
                                           name="nama"
                                           value="{{ old('nama', $siswa->nama) }}"
                                           placeholder="Masukkan Nama Lengkap"
                                           class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 @error('nama') border-red-300 @enderror">
                                    @error('nama')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <!-- Jenis Kelamin -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Jenis Kelamin <span class="text-pink-600">*</span>
                                    </label>
                                    <select name="jenis_kelamin"
                                            class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 @error('jenis_kelamin') border-red-300 @enderror">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <!-- Tempat Lahir -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tempat Lahir <span class="text-pink-600">*</span>
                                    </label>
                                    <input type="text"
                                           name="tempat_lahir"
                                           value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}"
                                           placeholder="Masukkan Tempat Lahir"
                                           class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 @error('tempat_lahir') border-red-300 @enderror">
                                    @error('tempat_lahir')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <!-- Tanggal Lahir -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tanggal Lahir <span class="text-pink-600">*</span>
                                    </label>
                                    <input type="date"
                                           name="tanggal_lahir"
                                           value="{{ old('tanggal_lahir', $siswa->tanggal_lahir->format('Y-m-d')) }}"
                                           class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 @error('tanggal_lahir') border-red-300 @enderror">
                                    @error('tanggal_lahir')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <!-- Alamat -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Alamat <span class="text-pink-600">*</span>
                                    </label>
                                    <textarea name="alamat"
                                              rows="3"
                                              placeholder="Masukkan Alamat Lengkap"
                                              class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 @error('alamat') border-red-300 @enderror">{{ old('alamat', $siswa->alamat) }}</textarea>
                                    @error('alamat')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="border-t border-pink-100"></div>

                        <!-- Informasi Akademik -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-book mr-3 text-pink-600 text-xl"></i>
                                Informasi Akademik
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- Kelas -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Kelas
                                    </label>
                                    <input type="text"
                                           name="kelas"
                                           value="{{ old('kelas', $siswa->kelas) }}"
                                           placeholder="Contoh: X IPA 1"
                                           class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 @error('kelas') border-red-300 @enderror">
                                    @error('kelas')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Status <span class="text-pink-600">*</span>
                                    </label>
                                    <select name="status"
                                            class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 @error('status') border-red-300 @enderror">
                                        <option value="">Pilih Status</option>
                                        <option value="aktif" {{ old('status', $siswa->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="tidak_aktif" {{ old('status', $siswa->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('status')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="border-t border-pink-100"></div>

                        <!-- Informasi Orang Tua & Kontak -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-phone mr-3 text-pink-600 text-xl"></i>
                                Informasi Orang Tua & Kontak
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- Nama Orang Tua -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nama Orang Tua / Wali <span class="text-pink-600">*</span>
                                    </label>
                                    <input type="text"
                                           name="nama_orang_tua"
                                           value="{{ old('nama_orang_tua', $siswa->nama_orang_tua) }}"
                                           placeholder="Masukkan Nama Orang Tua / Wali"
                                           class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 @error('nama_orang_tua') border-red-300 @enderror">
                                    @error('nama_orang_tua')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <!-- Nomor Telepon -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nomor Telepon
                                    </label>
                                    <input type="text"
                                           name="telepon"
                                           value="{{ old('telepon', $siswa->telepon) }}"
                                           placeholder="08123456789"
                                           class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 @error('telepon') border-red-300 @enderror">
                                    @error('telepon')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Email
                                    </label>
                                    <input type="email"
                                           name="email"
                                           value="{{ old('email', $siswa->email) }}"
                                           placeholder="contoh@email.com"
                                           class="w-full px-4 py-3 border border-pink-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 @error('email') border-red-300 @enderror">
                                    @error('email')
                                    <p class="mt-1 text-sm text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Form Actions -->
                    <div class="px-8 py-6 bg-gradient-to-r from-pink-50/50 to-white border-t border-pink-100 flex items-center justify-end gap-4">
                        <a href="{{ route('siswa.show', $siswa->id) }}"
                           class="px-6 py-3 bg-white hover:bg-pink-50 text-gray-700 font-bold rounded-lg border border-pink-200 transition-all duration-200">
                            <i class="fas fa-times mr-2"></i>
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-pink-600 to-pink-500 hover:from-pink-700 hover:to-pink-600 text-white font-bold rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                            <i class="fas fa-save mr-2"></i>
                            Update Data
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!-- Image Preview Script -->
    <script>
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>
</html>
