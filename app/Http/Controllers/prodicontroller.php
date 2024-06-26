<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Validation\Rules\Unique;

class prodicontroller extends Controller
{
    public function index()
    {
        $data = ['nama' => "Najwa Fitriyani", 'foto' =>'najwa.jpg'];
        $prodi = Prodi::all();
        return view('prodi.index', compact(['data', 'prodi']));
    }

    public function create()
    {
        $data = ['nama' => "Najwa Fitriyani", 'foto' =>'najwa.jpg'];
        return view('prodi.create', compact(['data']));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate(
            [
                'nama_prodi' => 'required|unique:prodi|max:255'
            ],
            [
                'nama_prodi.required' => 'Nama Prodi harus diisi',
                'nama_prodi.unique' => 'Nama Prodi sudah ada',
                'nama_prodi.max' => 'Nama Prodi maksimal 255 karakter'

            ]
        );
        Prodi::create($validateData);
        flash()->success('Data Berhasil ditambahkan');
        return redirect('/prodi');
    }    

    public function edit(String $id)
    {
        $data = ['nama' => "Najwa Fitriyani", 'foto' =>'najwa.jpg'];
        $prodi = Prodi::find($id);
        return view('prodi.edit', compact(['data','prodi']));
    }

    public function update (Request $request, string $id)
    {
        $validateData = $request->validate(
            [
                'nama_prodi' => 'required|unique:prodi|max:255'
            ],
            [
                'nama_prodi.required' => 'Nama Prodi harus diisi',
                'nama_prodi.unique' => 'Nama Prodi sudah ada',
                'nama_prodi.max' => 'Nama Prodi maksimal 255 karakter'

            ]
        );
        Prodi::where('id', $id)->update($validateData);
        flash()->success('Data Berhasil diubah');
        return redirect('/prodi');
    }

    public function destroy(String $id)
    {
        Prodi::destroy($id);
        flash()->success('Data Berhasil dihapus');
        return redirect('/prodi');
    }

    public function welcome()
    {
        return view ('welcome');
    }
};