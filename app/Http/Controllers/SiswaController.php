<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SiswaController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request): View
    {
        // get all siswa with search and filter
        $query = Siswa::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhere('kelas', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $siswa = $query->latest()->paginate(10);

        // render view with siswa
        return view('siswa.index', compact('siswa'));
    }

    /**
     * create
     */
    public function create(): View
    {
        return view('siswa.create');
    }

    /**
     * store
     *
     * @param  mixed  $request
     */
    public function store(Request $request): RedirectResponse
    {
        // validate form
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'nis' => 'required|unique:siswa,nis|max:20',
            'nama' => 'required|min:3|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|min:10',
            'nama_orang_tua' => 'required|max:255',
            'telepon' => 'nullable|max:15',
            'email' => 'nullable|email|max:255',
            'kelas' => 'nullable|max:50',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        // check if foto is uploaded
        if ($request->hasFile('foto')) {
            // upload foto
            $foto = $request->file('foto');
            $foto->storeAs('public/siswa', $foto->hashName());
            $fotoName = $foto->hashName();
        } else {
            $fotoName = null;
        }

        // create siswa
        Siswa::create([
            'foto' => $fotoName,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nama_orang_tua' => $request->nama_orang_tua,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'kelas' => $request->kelas,
            'status' => $request->status,
        ]);

        // redirect to index
        return redirect()->route('siswa.index')->with(['success' => 'Data Siswa Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed  $id
     */
    public function show(string $id): View
    {
        // get siswa by ID
        $siswa = Siswa::findOrFail($id);

        // render view with siswa
        return view('siswa.show', compact('siswa'));
    }

    /**
     * edit
     *
     * @param  mixed  $id
     */
    public function edit(string $id): View
    {
        // get siswa by ID
        $siswa = Siswa::findOrFail($id);

        // render view with siswa
        return view('siswa.edit', compact('siswa'));
    }

    /**
     * update
     *
     * @param  mixed  $request
     * @param  mixed  $id
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // validate form
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'nis' => 'required|max:20|unique:siswa,nis,'.$id,
            'nama' => 'required|min:3|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|min:10',
            'nama_orang_tua' => 'required|max:255',
            'telepon' => 'nullable|max:15',
            'email' => 'nullable|email|max:255',
            'kelas' => 'nullable|max:50',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        // get siswa by ID
        $siswa = Siswa::findOrFail($id);

        // check if foto is uploaded
        if ($request->hasFile('foto')) {

            // upload new foto
            $foto = $request->file('foto');
            $foto->storeAs('public/siswa', $foto->hashName());

            // delete old foto
            if ($siswa->foto) {
                Storage::delete('public/siswa/'.$siswa->foto);
            }

            // update siswa with new foto
            $siswa->update([
                'foto' => $foto->hashName(),
                'nis' => $request->nis,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'nama_orang_tua' => $request->nama_orang_tua,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'kelas' => $request->kelas,
                'status' => $request->status,
            ]);

        } else {

            // update siswa without foto
            $siswa->update([
                'nis' => $request->nis,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'nama_orang_tua' => $request->nama_orang_tua,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'kelas' => $request->kelas,
                'status' => $request->status,
            ]);
        }

        // redirect to index
        return redirect()->route('siswa.index')->with(['success' => 'Data Siswa Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed  $id
     */
    public function destroy($id): RedirectResponse
    {
        // get siswa by ID
        $siswa = Siswa::findOrFail($id);

        // delete foto if exists
        if ($siswa->foto) {
            Storage::delete('public/siswa/'.$siswa->foto);
        }

        // delete siswa
        $siswa->delete();

        // redirect to index
        return redirect()->route('siswa.index')->with(['success' => 'Data Siswa Berhasil Dihapus!']);
    }
}
