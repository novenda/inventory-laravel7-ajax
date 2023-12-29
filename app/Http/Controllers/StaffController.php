<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index()
    {
        return view('page.staff');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $staff = DB::connection('mysql')->table('tm_staff')
                        ->select('id_master_staff','kode_staff','nama_staff','password','level','username','wilayah')
                        ->where('is_delete','0')
                        ->get();
            return Datatables::of($staff)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" class="btn btn-outline-success px-1" onclick="edit(\''
                        .$row->id_master_staff.
                        "','"
                        .$row->kode_staff.
                        "','"
                        .$row->nama_staff.
                        "','"
                        .$row->password.
                        "','"
                        .$row->level.
                        "','"
                        .$row->username.
                        "','"
                        .$row->wilayah.
                        '\')"><i class="bx bx-edit"></i></button> &nbsp';
                        $btn = $btn.'<button type="button" class="btn btn-outline-danger px-1" onclick="hapus(\''
                        .$row->id_master_staff.
                        "','"
                        .$row->kode_staff.
                        "','"
                        .$row->nama_staff.
                        "','"
                        .$row->password.
                        "','"
                        .$row->level.
                        "','"
                        .$row->username.
                        "','"
                        .$row->wilayah.
                        '\')"><i class="bx bx-trash-alt"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function save(Request $request)
    {
        $staff = $request->id;
        if($staff ==""){
            $insert = DB::connection('mysql')->table('tm_staff')->insert([
                        'kode_staff' => $request->kode_staff,
                        'nama_staff' => $request->nama_staff,
                        'level' => $request->level,
                        'username' => $request->username,
                        'password' => $request->password,
                        'wilayah' => $request->wilayah,

                        ]);
				if($insert){
                    return response()->json(['code'=>1,'msg'=>'Input Data Success']);
				}else{
					return response()->json(['code'=>0,'msg'=>'Input Data Falied']);
				}
        }else{
            $update = DB::connection('mysql')->table('tm_staff')->where('id_master_staff',  $request->id)->update([
                        'kode_staff' => $request->kode_staff,
                        'nama_staff' => $request->nama_staff,
                        'level' => $request->level,
                        'username' => $request->username,
                        'password' => $request->password,
                        'wilayah' => $request->wilayah,
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
        $delete = DB::connection('mysql')->table('tm_staff')->where('id_master_staff',  $request->id_master_staff)->update([
            'is_delete'=> 1,
            ]);
            if($delete){
                return response()->json(['code'=>1,'msg'=>'Delete Data Success']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Delete Data Falied']);
            }
    }
}
