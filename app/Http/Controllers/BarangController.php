<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        return view('page.barang');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $barang = DB::connection('mysql')->table('tm_barang')
                        ->select('id_master_barang','kode_barang','nama_barang')
                        ->where('is_delete','0')
                        ->get();
            return Datatables::of($barang)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        //    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id_master_barang="'.$row->id_master_barang.'" data-original-title="Edit" class="edit   btn-sm editBarang"><span style="font-size: 20px; color: green;"><i class="bx bx-edit"></i></a>';
                        //    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id_master_barang="'.$row->id_master_barang.'" data-original-title="Delete" class=" btn-sm deleteBarang"><span style="font-size: 20px; color: red;"><i class="bx bx-trash-alt"></i></a>';
                        $btn = '<button type="button" class="btn btn-outline-success px-1" onclick="edit(\''
                        .$row->id_master_barang.
                        "','"
                        .$row->kode_barang.
                        "','"
                        .$row->nama_barang.
                        '\')"><i class="bx bx-edit"></i></button> &nbsp';
                        $btn = $btn.'<button type="button" class="btn btn-outline-danger px-1" onclick="hapus(\''
                        .$row->id_master_barang.
                        "','"
                        .$row->kode_barang.
                        "','"
                        .$row->nama_barang.
                        '\')"><i class="bx bx-trash-alt"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function save(Request $request)
    {
        $barang = $request->id;
        if($barang ==""){
            $insert = DB::connection('mysql')->table('tm_barang')->insert([
                        'kode_barang' => $request->kode_barang,
                        'nama_barang' => $request->nama_barang,
                        ]);
				if($insert){
                    return response()->json(['code'=>1,'msg'=>'Input Data Success']);
				}else{
					return response()->json(['code'=>0,'msg'=>'Input Data Falied']);
				}
        }else{
            $update = DB::connection('mysql')->table('tm_barang')->where('id_master_barang',  $request->id)->update([
                        'kode_barang' => $request->kode_barang,
                        'nama_barang' => $request->nama_barang,
                        ]);
                if($update){
                    return response()->json(['code'=>1,'msg'=>'Input Data Success']);
                }else{
                    return response()->json(['code'=>0,'msg'=>'Input Data Falied']);
                }
            }
    }

    public function hapus(Request $request)
    {
        $delete = DB::connection('mysql')->table('tm_barang')->where('id_master_barang',  $request->id_master_barang)->update([
            'is_delete'=> 1,
            ]);
            if($delete){
                return response()->json(['code'=>1,'msg'=>'Delete Data Success']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Delete Data Falied']);
            }
    }
}
