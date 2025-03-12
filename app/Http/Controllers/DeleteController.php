<?php

namespace App\Http\Controllers;

use App\Models\BMICalculator;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\TextComparison;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DeleteController extends Controller
{
    public function index($tabel, $id)
    {
        if (!empty($tabel)) {

            switch ($tabel) {
                case 'kategori':
                    try {
                        $data = Kategori::findOrFail($id);
                        $data->delete();
                        return response()->json(['param' => true, 'message' => 'Data Berhasil Dihapus']);
                    } catch (\Exception $err) {
                        return response()->json(['param' => false, 'message' => $err->getMessage()]);
                    }
                    break;

                case 'sub-kategori':
                    try {
                        $data = SubKategori::findOrFail($id);
                        $data->delete();
                        return response()->json(['param' => true, 'message' => 'Data Berhasil Dihapus']);
                    } catch (\Exception $err) {
                        return response()->json(['param' => false, 'message' => $err->getMessage()]);
                    }
                    break;
                case 'role':
                    try {
                        $data = Role::findOrFail($id);
                        $data->delete();
                        return response()->json(['param' => true, 'message' => 'Data Berhasil Dihapus']);
                    } catch (\Exception $err) {
                        return response()->json(['param' => false, 'message' => $err->getMessage()]);
                    }
                    break;
                case 'permission':
                    try {
                        $data = Permission::findOrFail($id);
                        $data->delete();
                        return response()->json(['param' => true, 'message' => 'Data Berhasil Dihapus']);
                    } catch (\Exception $err) {
                        return response()->json(['param' => false, 'message' => $err->getMessage()]);
                    }
                    break;
                case 'comparison':
                    try {
                        $data = TextComparison::findOrFail($id);
                        $data->delete();
                        return response()->json(['param' => true, 'message' => 'Data Berhasil Dihapus']);
                    } catch (\Exception $err) {
                        return response()->json(['param' => false, 'message' => $err->getMessage()]);
                    }
                    break;
                case 'bmi':
                    try {
                        $data = BMICalculator::findOrFail($id);
                        $data->delete();
                        return response()->json(['param' => true, 'message' => 'Data Berhasil Dihapus']);
                    } catch (\Exception $err) {
                        return response()->json(['param' => false, 'message' => $err->getMessage()]);
                    }
                    break;
                default:
                    return response()->json(['param' => false, 'message' => 'Settingan untuk delete blum ada']);
                    break;
            }
        }
    }
}
