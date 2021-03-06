<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Masternilai;
use App\Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MasterNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datasiswa = Siswa::all();
        
        return view('superadmin/report', compact('datasiswa'));
    }

    public function printprv()
    {
        $siswaprint = Siswa::all();
        return view('superadmin/printsiswa')->with('siswaprint', $siswaprint);
    }

    public function printprvdtl($id)
    {
        $datad = Masternilai::where('id_siswa',$id)->get();

        $semuanilai = 0;
        foreach( $datad as $datadetail)
        {
            $nilai_1 = $datadetail->nilai_subkat_1 * 2.5/100;
            $nilai_2 = $datadetail->nilai_subkat_2 * 2.5/100;
            $nilai_3 = $datadetail->nilai_subkat_3 * 10/100;
            $nilai_4 = $datadetail->nilai_subkat_4 * 10/100;
            $nilai_5 = $datadetail->nilai_subkat_5 * 10/100;
            $nilai_6 = $datadetail->nilai_subkat_6 * 10/100;
            $nilai_7 = $datadetail->nilai_subkat_7 * 5/100;
            $nilai_8 = $datadetail->nilai_subkat_8 * 10/100;
            $nilai_9 = $datadetail->nilai_subkat_9 * 10/100;
            $nilai_10 = $datadetail->nilai_subkat_10 * 5/100;
            $nilai_11 = $datadetail->nilai_subkat_11 * 10/100;
            $nilai_12 = $datadetail->nilai_subkat_12 * 15/100;

            $total_nilai = $nilai_1+$nilai_2+$nilai_3+$nilai_4+$nilai_5+$nilai_6+$nilai_7+$nilai_8+$nilai_9+$nilai_10+$nilai_11+$nilai_12;
                 
        }

        return view('superadmin/printdetail',compact('datad'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            
            'skategori1' => 'required|min:2',
            'skategori2' => 'required|min:2',
            'skategori3' => 'required|min:2',
            'skategori4' => 'required|min:2',
            'skategori5' => 'required|min:2',
            'skategori6' => 'required|min:2',
            'skategori7' => 'required|min:2',
            'skategori8' => 'required|min:2',
            'skategori9' => 'required|min:2',
            'skategori10' => 'required|min:2',
            'skategori11' => 'required|min:2',
            'skategori12' => 'required|min:2',
        ]);

        $data =  new Masternilai();
        $data->id_siswa = $request->id_siswa;
        $data->id_penguji = $request->id_penguji;
        $data->status_penguji = $request->status;
        $data->nilai_subkat_1 = $request->skategori1;
        $data->nilai_subkat_2 = $request->skategori2;
        $data->nilai_subkat_3 = $request->skategori3;
        $data->nilai_subkat_4 = $request->skategori4;
        $data->nilai_subkat_5 = $request->skategori5;
        $data->nilai_subkat_6 = $request->skategori6;
        $data->nilai_subkat_7 = $request->skategori7;
        $data->nilai_subkat_8 = $request->skategori8;
        $data->nilai_subkat_9 = $request->skategori9;
        $data->nilai_subkat_10 = $request->skategori10;
        $data->nilai_subkat_11 = $request->skategori11;
        $data->nilai_subkat_12 = $request->skategori12;
        $data->save();
            return redirect('/user')->with(['success' => 'Berhasil Menginput Nilai Mentee']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datad = Masternilai::where('id_siswa',$id)->get();
        $datas = Siswa::where('id',$id)->first();
        $semuanilai = 0;
        foreach( $datad as $datadetail)
        {
            $nilai_1 = $datadetail->nilai_subkat_1 * 2.5/100;
            $nilai_2 = $datadetail->nilai_subkat_2 * 2.5/100;
            $nilai_3 = $datadetail->nilai_subkat_3 * 10/100;
            $nilai_4 = $datadetail->nilai_subkat_4 * 10/100;
            $nilai_5 = $datadetail->nilai_subkat_5 * 10/100;
            $nilai_6 = $datadetail->nilai_subkat_6 * 10/100;
            $nilai_7 = $datadetail->nilai_subkat_7 * 5/100;
            $nilai_8 = $datadetail->nilai_subkat_8 * 10/100;
            $nilai_9 = $datadetail->nilai_subkat_9 * 10/100;
            $nilai_10 = $datadetail->nilai_subkat_10 * 5/100;
            $nilai_11 = $datadetail->nilai_subkat_11 * 10/100;
            $nilai_12 = $datadetail->nilai_subkat_12 * 15/100;

            $total_nilai = $nilai_1+$nilai_2+$nilai_3+$nilai_4+$nilai_5+$nilai_6+$nilai_7+$nilai_8+$nilai_9+$nilai_10+$nilai_11+$nilai_12;
            $datadetail->total_subkat_1 = $nilai_1;
            $datadetail->total_subkat_2 = $nilai_2;
            $datadetail->total_subkat_3 = $nilai_3;
            $datadetail->total_subkat_4 = $nilai_4;
            $datadetail->total_subkat_5 = $nilai_5;
            $datadetail->total_subkat_6 = $nilai_6;
            $datadetail->total_subkat_7 = $nilai_7;
            $datadetail->total_subkat_8 = $nilai_8;
            $datadetail->total_subkat_9 = $nilai_9;
            $datadetail->total_subkat_10 = $nilai_10;
            $datadetail->total_subkat_11 = $nilai_11;
            $datadetail->total_subkat_12 = $nilai_12;
            $datadetail->total_nilai_subkat = $total_nilai;
            $datadetail->save();
            $semuanilai += $total_nilai/3;     
        }
        
        if($semuanilai >= 70 ){
            $datas->nilai = $semuanilai;
            $datas->status = "LULUS";
            
        }
        elseif($semuanilai < 70){
            $datas->nilai = $semuanilai;
            $datas->status = "TIDAK LULUS";
            
        }
        else {
            $datas->nilai = $semuanilai;
            $datas->status = "TIDAK ADA DATA";
            
        }
        $datas->save();
        

        return view('superadmin/detailreport',compact('datad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //update nilai total pada report
        $data = Siswa::where('id',$id)->first();
        $data->nama = $request->nilai;
        //$data->password = bcrypt($request->password);
        $data->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
