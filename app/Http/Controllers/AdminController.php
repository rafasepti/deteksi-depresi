<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return view('admin.data_admin.v_admin');
    }

    public function dataTable(Request $request){
        if ($request->ajax()) {
            $admin = Admin::with('user')->get();
            return DataTables::of($admin)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    $actionBtn = 
                    '
                        <a href="/data-admin/edit/'.$data->id.'" class="btn btn-info btn-sm">
                            Edit
                        </a>
                        <a href="/data-admin/hapus/'.$data->user->id.'" class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin?`)">
                            Hapus
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data_admin.tambah_admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_admin' => ['required', 'string', 'max:100'],
            'nip' => ['required', 'integer'],
            'no_telp' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->nama_admin,
            'email' => $request->email,
            'hak_akses' => 'admin',
            'password' => Hash::make($request->password),
        ]);
        $userId = $user->id;

        $admin = Admin::create([
            'user_id' => $userId,
            'nama_admin' => $request->nama_admin,
            'nip' => $request->nip,
            'no_telp' => $request->no_telp,
        ]);

        return Redirect::route('admin.data-admin')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = Admin::with('user')
            ->where('id', $id)
            ->first();
        return view('admin.data_admin.edit_admin', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'nama_admin' => ['required', 'string', 'max:100'],
            'nip' => ['required', 'integer'],
            'no_telp' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255',  Rule::unique(User::class)->ignore($request->user_id)],
        ]);

        $user = User::where('id', $request->user_id)->update([
            'name' => $request->nama_admin,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $request->pass,
        ]);

        $admin = Admin::where('id', $request->admin_id)->update([
            'nama_admin' => $request->nama_admin,
            'nip' => $request->nip,
            'no_telp' => $request->no_telp,
        ]);

        return Redirect::route('admin.data-admin')->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        $admin = Admin::where('user_id', $id)->delete();
        
        return Redirect::route('admin.data-admin')->with('success', 'Data berhasil dihapus!');
    }
}
