<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::query()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('pages.kategori', [
            'pageTitle' => 'Kategori',
        ], compact('kategori'));
    }

    public function store(KategoriRequest $request)
    {
        try {
            if ($request->ID == 0) {
                Kategori::create(array_merge($request->validated(), ['user_id' => Auth::user()->id]));
            } else {
                Kategori::where('id', $request->ID)->update($request->validated());
            }
            return response()->json(['param' => true, 'message' => 'Successfully']);
        } catch (\Exception $err) {
            return response()->json(['param' => false, 'message' => $err->getMessage()]);
        }
    }
}
