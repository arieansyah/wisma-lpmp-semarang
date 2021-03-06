<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BukuTamu;
use Redirect;
use App\Wisma;
use Carbon\Carbon;
use App\DetailWisma;
class WismaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function wisma1(){
      return view('wisma.wisma1');
    }

    public function wisma2(){
      return view('wisma.wisma2');
    }

    public function wisma3(){
      return view('wisma.wisma3');
    }

    public function wisma4(){
      return view('wisma.wisma4');
    }

    public function listDataNik($id){
      $dataNik = DetailWisma::leftJoin('buku_tamus', 'buku_tamus.nik', '=', 'detail_wismas.nik')
      ->where('wisma_id', $id)->get();
      $no = 0;
      $data = array();
      foreach($dataNik as $list){
        $no ++;
        $row = array();
        $row[] = $no;
        $row[] = $list->nik;
        $row[] = $list->nama;
        $row[] = $list->nomor_telepon;
        $row[] = '<div class="btn-group">
                <a onclick="deleteData('.$list->id_detail.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div>';
        $data[] = $row;
      }

      $output = array("data" => $data);
      return response()->json($output);
    }

    public function saveOrang(Request $request){
      $save = new DetailWisma;
      $save->nik = $request->nik;
      $save->wisma_id = $request->id;
      $save->save();
    }

    public function reset(Request $request, $id){
      $update = Wisma::find($id);
      $update->status = '1';
      $update->tanggal = null;
      $update->update();

      $reset = DetailWisma::where('wisma_id', $id)->first();
      $reset->delete();
    }

    public function addOrang($id){
      $tambah = Wisma::find($id);
      $detailNik = BukuTamu::all();
      return view('wisma.tambah_orang', compact('detailNik', 'tambah'));
    }

    public function saveWisma1(Request $request){
      $wisma1 = new Wisma;
      $wisma1->nama_wisma = $request->nama_wisma;
      $wisma1->status = '1';
      $wisma1->save();
    }

    public function update(Request $request, $id){
      $update = Wisma::find($id);
      $update->status = '2';
      $update->tanggal = $request->tanggal;
      $update->update();
    }

    public function edit($id){
      $wisma = Wisma::find($id);
      echo json_encode($wisma);
    }

    public function destroy($id, $idd){
      $delete = DetailWisma::find($idd);
      $delete->delete();
    }

    public function listDataWisma1()
    {
      $wisma = Wisma::where('wisma', 1)->get();
      $data = array();
      foreach($wisma as $list){
        $row = array();
        $row[] = $list->nomor_kamar;

        if ($list->status == '1') {
          $status = '<span class="label label-success">Kosong</span>';
        }else {
          $status = '<span class="label label-danger">Penuh</span>';
        }
        $row[] = $status;

        if ($list->tanggal == null) {
          $tanggal = '<span class="label label-success">Kosong</span>';
        }elseif ($list->tanggal < Carbon::now()) {
          $tanggal = '<span class="label label-danger">Masa Habis</span>';
        }else {
          $tanggal = $list->tanggal;
        }
        $row[] = $tanggal;
        $row[] = '<div class="btn-group">
                <a href="wisma/'.$list->id_wisma.'/tambah" class="btn btn-warning btn-sm"><i class="fa fa-user-plus"></i></a>
                <a onclick="resetData('.$list->id_wisma.')" class="btn btn-primary btn-sm">Reset</a></div>';
        $data[] = $row;
      }

      $output = array("data" => $data);
      return response()->json($output);
    }

    public function listDataWisma2()
    {
      $wisma = Wisma::where('wisma', 2)->get();
      $data = array();
      foreach($wisma as $list){
        $row = array();
        $row[] = $list->nomor_kamar;

        if ($list->status == '1') {
          $status = '<span class="label label-success">Kosong</span>';
        }else {
          $status = '<span class="label label-danger">Penuh</span>';
        }
        $row[] = $status;

        if ($list->tanggal == null) {
          $tanggal = '<span class="label label-success">Kosong</span>';
        }elseif ($list->tanggal < Carbon::now()) {
          $tanggal = '<span class="label label-danger">Masa Habis</span>';
        }else {
          $tanggal = $list->tanggal;
        }
        $row[] = $tanggal;
        $row[] = '<div class="btn-group">
                <a href="wisma/'.$list->id_wisma.'/tambah" class="btn btn-warning btn-sm"><i class="fa fa-user-plus"></i></a>
                <a onclick="resetData('.$list->id_wisma.')" class="btn btn-primary btn-sm">Reset</a></div>';
        $data[] = $row;
      }

      $output = array("data" => $data);
      return response()->json($output);
    }

    public function listDataWisma3()
    {
      $wisma = Wisma::where('wisma', 3)->get();
      $data = array();
      foreach($wisma as $list){
        $row = array();
        $row[] = $list->nomor_kamar;

        if ($list->status == '1') {
          $status = '<span class="label label-success">Kosong</span>';
        }else {
          $status = '<span class="label label-danger">Penuh</span>';
        }
        $row[] = $status;

        if ($list->tanggal == null) {
          $tanggal = '<span class="label label-success">Kosong</span>';
        }elseif ($list->tanggal < Carbon::now()) {
          $tanggal = '<span class="label label-danger">Masa Habis</span>';
        }else {
          $tanggal = $list->tanggal;
        }
        $row[] = $tanggal;
        $row[] = '<div class="btn-group">
                <a href="wisma/'.$list->id_wisma.'/tambah" class="btn btn-warning btn-sm"><i class="fa fa-user-plus"></i></a>
                <a onclick="resetData('.$list->id_wisma.')" class="btn btn-primary btn-sm">Reset</a></div>';
        $data[] = $row;
      }

      $output = array("data" => $data);
      return response()->json($output);
    }

    public function listDataWisma4()
    {
      $wisma = Wisma::where('wisma', 4)->get();
      $data = array();
      foreach($wisma as $list){
        $row = array();
        $row[] = $list->nomor_kamar;

        if ($list->status == '1') {
          $status = '<span class="label label-success">Kosong</span>';
        }else {
          $status = '<span class="label label-danger">Penuh</span>';
        }
        $row[] = $status;

        if ($list->tanggal == null) {
          $tanggal = '<span class="label label-success">Kosong</span>';
        }elseif ($list->tanggal < Carbon::now()) {
          $tanggal = '<span class="label label-danger">Masa Habis</span>';
        }else {
          $tanggal = $list->tanggal;
        }
        $row[] = $tanggal;
        $row[] = '<div class="btn-group">
                <a href="wisma/'.$list->id_wisma.'/tambah" class="btn btn-warning btn-sm"><i class="fa fa-user-plus"></i></a>
                <a onclick="resetData('.$list->id_wisma.')" class="btn btn-primary btn-sm">Reset</a></div>';
        $data[] = $row;
      }

      $output = array("data" => $data);
      return response()->json($output);
    }

}
