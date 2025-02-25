<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index(): View
    {
    ///get Data db
    $siswas = DB::table('siswas')
        ->join('users', 'siswas.id_user','=', 'users.id')
        ->select(
            'siswas.*',
            'users.name',
            'users.email',
        )
        ->paginate(10);

        return view('admin.siswa.index', compact('siswas'));

        if (request('cari')) {
            $siswas = $this->search(request('cari'));
        }

        return view('admin.siswa.index', compact('siswas'));
    }
    public function create(): View
    {
        return view('admin.siswa.create');
    }
    public function store(Request $request): RedirectResponse
    {
        
    }

}
    