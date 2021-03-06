<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BukuTamu;
use App\DetailWisma;
use Carbon\Carbon;

class BukuTamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('buku_tamu.index');
    }

    public function __construct(){
        $this->middleware('auth');
    }

    public function listData()
    {

      $bukutamu = BukuTamu::orderBy('id_bukutamu', 'desc')->get();
      $no = 0;
      $data = array();
      foreach($bukutamu as $list){
        $no ++;
        $row = array();
        $row[] = $no;
        $row[] = $list->nik;
        $row[] = $list->nama;
        $row[] = $list->nomor_telepon;
        $row[] = $list->instansi;
        $row[] = '<div class="btn-group">
                <a onclick="showDetail('.$list->id_bukutamu.')" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                <a onclick="editForm('.$list->id_bukutamu.')" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                <a onclick="deleteData('.$list->id_bukutamu.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';

        $data[] = $row;
      }

      $output = array("data" => $data);
      return response()->json($output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bukutamu = new BukuTamu;
        $bukutamu->nik = $request->nik;
        $bukutamu->nama = $request->nama;
        $bukutamu->jenis_kelamin = $request->jenis_kelamin;
        $bukutamu->nomor_telepon = $request->nomor_telepon;
        $bukutamu->instansi = $request->instansi;
        $bukutamu->alamat = $request->alamat;
        $bukutamu->keterangan = $request->keterangan;
        $bukutamu->tanggal = Carbon::now();
        $bukutamu->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $bukutamu = DetailWisma::join('buku_tamus', 'buku_tamus.nik', '=', 'detail_wismas.nik')
      ->join('wismas', 'wismas.id_wisma', '=', 'detail_wismas.wisma_id')
      ->where('id_bukutamu', $id)
      ->first();
      $bukutamus = BukuTamu::find($id);
      if ($bukutamu == null) {
        echo json_encode($bukutamus);
      }else {
        echo json_encode($bukutamu);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $bukutamu = BukuTamu::find($id);
      echo json_encode($bukutamu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bukutamu = BukuTamu::find($id);
        $bukutamu->nik = $request->nik;
        $bukutamu->nama = $request->nama;
        $bukutamu->jenis_kelamin = $request->jenis_kelamin;
        $bukutamu->nomor_telepon = $request->nomor_telepon;
        $bukutamu->instansi = $request->instansi;
        $bukutamu->alamat = $request->alamat;
        $bukutamu->keterangan = $request->keterangan;
        $bukutamu->tanggal = Carbon::now();
        $bukutamu->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = BukuTamu::find($id);
        $delete->delete();
    }
}
