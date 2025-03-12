<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubKategoriRequest;
use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubKategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::with('subKategori')->has('subKategori')->orderBy('created_at', 'desc')->paginate(5);
        return view('pages.sub-kategori', [
            'pageTitle' => 'Sub Kategori',
        ], compact('kategori'));
    }

    public function store(SubKategoriRequest $request)
    {
        try {
            SubKategori::create(array_merge($request->validated(), ['user_id' => Auth::user()->id]));

            return response()->json(['param' => true, 'message' => 'Successfully']);
        } catch (\Exception $err) {
            return response()->json(['param' => false, 'message' => $err->getMessage()]);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $change = SubKategori::moveAllToNewCategory($id, $request->kategori_id);

            if ($change > 0) {
                return response()->json(['param' => true, 'message' => 'Successfully']);
            } else {
                return response()->json(['param' => false, 'message' => 'Gagal update kategori']);
            }
            return response()->json(['param' => true, 'message' => 'Successfully']);
        } catch (\Exception $err) {
            return response()->json(['param' => false, 'message' => $err->getMessage()]);
        }
    }
}
