<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DatatableController extends Controller
{
    public function index(Request $request, $tabel)
    {
        if ($request->ajax()) {
            switch ($tabel) {
                case 'user':
                    $data = User::select('*')->where('id', '!=', Auth::user()->id);
                    return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('created_at', function ($row) {
                            return Carbon::create($row->created_at)->format('d F Y');
                        })
                        ->addColumn('aktif', function ($row) {

                            if ($row->status == 'Y') {
                                $output = '<span class="badge p-1 bg-primary">Aktif</span>';
                            } else {
                                $output = '<span class="badge p-1 bg-danger">Non Aktif</span>';
                            }
                            return $output;
                        })
                        ->addColumn('role', function ($row) {

                            return $row->roles->pluck('name');
                        })
                        ->addColumn('action', function ($row) {
                            $btn = '<button type="button" class="btn btn-sm btn-outline m-1 modal-cre text-warning" id="user-password" parent="' . $row->id . '" judul="Edit Password"><i class="fa-solid fa-key fa-xl"></i></button>';
                            $btn .= '<button type="button" class="btn btn-sm btn-outline m-1 modal-cre text-success" id="user-edit" parent="' . $row->id . '" judul="Edit User"><i class="fa-solid fa-pen-to-square fa-xl"></i></button>';
                            $btn .= '<button type="button" class="btn btn-sm btn-outline m-1 text-danger" onclick="logOutUser(' . $row->id . ')"><i class="fa-solid fa-right-from-bracket fa-xl"></i></button>';
                            return $btn;
                        })
                        ->rawColumns(['aktif', 'role', 'action'])
                        ->toJson();
                    break;
                default:
                    return response()->json([
                        'draw' => 0,
                        'recordsTotal' => 0,
                        'recordsFiltered' => 0,
                        'data' => []
                    ]);
                    break;
            }
        }
    }
}
