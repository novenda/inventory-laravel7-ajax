<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    public function index()
    {
        return view('page.satuan');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $satuan = DB::connection('mysql')->table('tm_satuan')
                        ->select('id_master_satuan','kode_satuan','nama_satuan')
                        ->where('is_delete','0')
                        ->get();
            return Datatables::of($satuan)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" class="btn btn-outline-success px-1" onclick="edit(\'' 
                        .$row->id_master_satuan.
                        "','" 
                        .$row->kode_satuan.
                        "','"
                        .$row->nama_satuan.
                        '\')"><i class="bx bx-edit"></i></button> &nbsp';
                        $btn = $btn.'<button type="button" class="btn btn-outline-danger px-1" onclick="hapus(\'' 
                        .$row->id_master_satuan.
                        "','" 
                        .$row->kode_satuan.
                        "','"
                        .$row->nama_satuan.
                        '\')"><i class="bx bx-trash-alt"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function save(Request $request)
    {
        $satuan = $request->id;
        if($satuan ==""){
            $insert = DB::connection('mysql')->table('tm_satuan')->insert([
                        'kode_satuan' => $request->kode_satuan,
                        'nama_satuan' => $request->nama_satuan, 
                        ]);
				if($insert){
                    return response()->json(['code'=>1,'msg'=>'Input Data Success']);
				}else{
					return response()->json(['code'=>0,'msg'=>'Input Data Falied']);
				}
        }else{
            $update = DB::connection('mysql')->table('tm_satuan')->where('id_master_satuan',  $request->id)->update([
                        'kode_satuan' => $request->kode_satuan,
                        'nama_satuan' => $request->nama_satuan, 
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
        $delete = DB::connection('mysql')->table('tm_satuan')->where('id_master_satuan',  $request->id_master_satuan)->update([
            'is_delete'=> 1, 
            ]);
            if($delete){
                return response()->json(['code'=>1,'msg'=>'Delete Data Success']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Delete Data Falied']);
            }
    }
}
