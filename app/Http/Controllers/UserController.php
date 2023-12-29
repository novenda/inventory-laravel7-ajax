<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('page.user');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $user = DB::connection('mysql')->table('users')
                        ->select('id','nik','name','password','level','username','wilayah')
                        ->where('is_delete','0')
                        ->get();
            return Datatables::of($user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" class="btn btn-outline-success px-1" onclick="edit(\''
                        .$row->id_master_user.
                        "','"
                        .$row->nik.
                        "','"
                        .$row->nama_lengkap.
                        "','"
                        .$row->password.
                        "','"
                        .$row->level.
                        "','"
                        .$row->name.
                        "','"
                        .$row->wilayah.
                        '\')"><i class="bx bx-edit"></i></button> &nbsp';
                        $btn = $btn.'<button type="button" class="btn btn-outline-danger px-1" onclick="hapus(\''
                        .$row->id_master_user.
                        "','"
                        .$row->nik.
                        "','"
                        .$row->nama_lengkap.
                        "','"
                        .$row->password.
                        "','"
                        .$row->level.
                        "','"
                        .$row->name.
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
        $user = $request->id;
        if($user ==""){
            $insert = DB::connection('mysql')->table('users')->insert([
                        'NIK' => $request->nik,
                        'nama_lengkap' => $request->nama_lengkap,
                        'level' => $request->level,
                        'username' => $request->name,
                        'password' => $request->password,
                        'wilayah' => $request->wilayah,

                        ]);
				if($insert){
                    return response()->json(['code'=>1,'msg'=>'Input Data Success']);
				}else{
					return response()->json(['code'=>0,'msg'=>'Input Data Falied']);
				}
        }else{
            $update = DB::connection('mysql')->table('users')->where('id',  $request->id)->update([
                        'NIK' => $request->nik,
                        'nama_lengkap' => $request->nama_lengkap,
                        'level' => $request->level,
                        'username' => $request->name,
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
        $delete = DB::connection('mysql')->table('users')->where('id',  $request->id)->update([
            'is_delete'=> 1,
            ]);
            if($delete){
                return response()->json(['code'=>1,'msg'=>'Delete Data Success']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Delete Data Falied']);
            }
    }
}
