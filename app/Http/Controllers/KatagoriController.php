<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KatagoriController extends Controller
{
    public function index()
    {
        return view('page.katagori');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $katagori = DB::connection('mysql')->table('tm_katagori')
                        ->select('id_master_katagori','kode_katagori','nama_katagori')
                        ->where('is_delete','0')
                        ->get();
            return Datatables::of($katagori)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" class="btn btn-outline-success px-1" onclick="edit(\'' 
                        .$row->id_master_katagori.
                        "','" 
                        .$row->kode_katagori.
                        "','"
                        .$row->nama_katagori.
                        '\')"><i class="bx bx-edit"></i></button> &nbsp';
                        $btn = $btn.'<button type="button" class="btn btn-outline-danger px-1" onclick="hapus(\'' 
                        .$row->id_master_katagori.
                        "','" 
                        .$row->kode_katagori.
                        "','"
                        .$row->nama_katagori.
                        '\')"><i class="bx bx-trash-alt"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function save(Request $request)
    {
        $katagori = $request->id;
        if($katagori ==""){
            $insert = DB::connection('mysql')->table('tm_katagori')->insert([
                        'kode_katagori' => $request->kode_katagori,
                        'nama_katagori' => $request->nama_katagori, 
                        ]);
				if($insert){
                    return response()->json(['code'=>1,'msg'=>'Input Data Success']);
				}else{
					return response()->json(['code'=>0,'msg'=>'Input Data Falied']);
				}
        }else{
            $update = DB::connection('mysql')->table('tm_katagori')->where('id_master_katagori',  $request->id)->update([
                        'kode_katagori' => $request->kode_katagori,
                        'nama_katagori' => $request->nama_katagori, 
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
        $delete = DB::connection('mysql')->table('tm_katagori')->where('id_master_katagori',  $request->id_master_katagori)->update([
            'is_delete'=> 1, 
            ]);
            if($delete){
                return response()->json(['code'=>1,'msg'=>'Delete Data Success']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Delete Data Falied']);
            }
    }
}
