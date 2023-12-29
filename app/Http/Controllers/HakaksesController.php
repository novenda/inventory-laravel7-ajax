<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HakaksesController extends Controller
{
    public function index()
    {
        return view('page.hakakses');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $hakakses = DB::connection('mysql')->table('tm_hakakses')
                        ->select('id_master_hakakses','kode_hakakses','nama_hakakses')
                        ->where('is_delete','0')
                        ->get();
            return Datatables::of($hakakses)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" class="btn btn-outline-success px-1" onclick="edit(\''
                        .$row->id_master_hakakses.
                        "','"
                        .$row->kode_hakakses.
                        "','"
                        .$row->nama_hakakses.
                        '\')"><i class="bx bx-edit"></i></button> &nbsp';
                        $btn = $btn.'<button type="button" class="btn btn-outline-danger px-1" onclick="hapus(\''
                        .$row->id_master_hakakses.
                        "','"
                        .$row->kode_hakakses.
                        "','"
                        .$row->nama_hakakses.
                        '\')"><i class="bx bx-trash-alt"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function save(Request $request)
    {
        $hakakses = $request->id;
        if($hakakses ==""){
            $insert = DB::connection('mysql')->table('tm_hakakses')->insert([
                        'kode_hakakses' => $request->kode_hakakses,
                        'nama_hakakses' => $request->nama_hakakses,
                        ]);
				if($insert){
                    return response()->json(['code'=>1,'msg'=>'Input Data Success']);
				}else{
					return response()->json(['code'=>0,'msg'=>'Input Data Falied']);
				}
        }else{
            $update = DB::connection('mysql')->table('tm_hakakses')->where('id_master_hakakses',  $request->id)->update([
                        'kode_hakakses' => $request->kode_hakakses,
                        'nama_hakakses' => $request->nama_hakakses,
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
        $delete = DB::connection('mysql')->table('tm_hakakses')->where('id_master_hakakses',  $request->id_master_hakakses)->update([
            'is_delete'=> 1,
            ]);
            if($delete){
                return response()->json(['code'=>1,'msg'=>'Delete Data Success']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Delete Data Falied']);
            }
    }
}
