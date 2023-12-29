<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GudangController extends Controller
{
    public function index()
    {
        return view('page.gudang');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $gudang = DB::connection('mysql')->table('tm_gudang')
                        ->select('id_master_gudang','kode_gudang','nama_gudang')
                        ->where('is_delete','0')
                        ->get();
            return Datatables::of($gudang)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" class="btn btn-outline-success px-1" onclick="edit(\'' 
                        .$row->id_master_gudang.
                        "','" 
                        .$row->kode_gudang.
                        "','"
                        .$row->nama_gudang.
                        '\')"><i class="bx bx-edit"></i></button> &nbsp';
                        $btn = $btn.'<button type="button" class="btn btn-outline-danger px-1" onclick="hapus(\'' 
                        .$row->id_master_gudang.
                        "','" 
                        .$row->kode_gudang.
                        "','"
                        .$row->nama_gudang.
                        '\')"><i class="bx bx-trash-alt"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function save(Request $request)
    {
        $gudang = $request->id;
        if($gudang ==""){
            $insert = DB::connection('mysql')->table('tm_gudang')->insert([
                        'kode_gudang' => $request->kode_gudang,
                        'nama_gudang' => $request->nama_gudang, 
                        ]);
				if($insert){
                    return response()->json(['code'=>1,'msg'=>'Input Data Success']);
				}else{
					return response()->json(['code'=>0,'msg'=>'Input Data Falied']);
				}
        }else{
            $update = DB::connection('mysql')->table('tm_gudang')->where('id_master_gudang',  $request->id)->update([
                        'kode_gudang' => $request->kode_gudang,
                        'nama_gudang' => $request->nama_gudang, 
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
        $delete = DB::connection('mysql')->table('tm_gudang')->where('id_master_gudang',  $request->id_master_gudang)->update([
            'is_delete'=> 1, 
            ]);
            if($delete){
                return response()->json(['code'=>1,'msg'=>'Delete Data Success']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Delete Data Falied']);
            }
    }
}
