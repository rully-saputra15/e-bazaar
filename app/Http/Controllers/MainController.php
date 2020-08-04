<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
class MainController extends Controller
{
    public $menu;
    private function firestoreInit(){
        $firestore = new FirestoreClient([
            'projectId' => 'bazaar-dki2',
        ]);
        return $firestore;
    }
    public function index(){
            $firebase = (new Factory)->withServiceAccount(__DIR__.'/dki2.json');
            $firestore = $this->firestoreInit();
            $database = $firestore->collection('kategori');
            $query = $database->orderBy('urutan','DESC');
            $snapshot = $query->documents();
            $database = $firestore->collection('transaksi');
            $transaksi = $database->documents();
            $total = 0;
            foreach($transaksi as $value){
                $total = $total + $value['total'];
            }
            return view('home',['kategori' => $snapshot,'total' => $total]);
    }
    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;
        $firebase = (new Factory)->withServiceAccount(__DIR__.'/dki2.json');
        $auth = $firebase->createAuth();
        try{
            $result = $auth->signInWithEmailAndPassword($email,$password);

            $firestore = $this->firestoreInit();
            $database = $firestore->collection('kategori');
            //$query = $database->where('email','=',$email);
            $snapshot = $database->documents();
            $database1 = $firestore->collection('users');
            $query = $database1->where('email','=',$email);
            $snapshot1 = $query->documents();
            $tmp;
            foreach($snapshot1 as $dat){
                $tmp = $dat['nama'];
            }
            $request->session()->put('nama',$tmp);
            return $this->index();
        } catch(\Exception $err){
            return view('login',['message' => "email and password are wrong!"]);
        }
    }
    public function showKategori($id){
        try{
            $firestore = $this->firestoreInit();
            $database = $firestore->collection('kategori')->document($id)->collection('bazaar');
            $snapshot = $database->documents();
            return view('kategori',['data'=>$snapshot,'id' => $id]);
        } catch(\Exception $err){
            return $this->index();
        }
    }
    public function showAddFormKategori($id){
        try{
            return view('addKategori',['id' => $id]);
        }catch(\Exception $err){
            return $this->index();
        }
    }
    public function addKategori(Request $request){
        try{
            $firestore = $this->firestoreInit();
            $buka = date("D, j-M-Y",strtotime($request->buka));
            $tutup = date("D, j-M-Y",strtotime($request->tutup));
            $data = [
                'nama' => $request->nama_bazaar,
                'buka' => $buka,
                'tutup' => $tutup
            ];
            $addedDocRef = $firestore->collection('kategori')->document($request->id)->collection('bazaar')->newDocument();
            $addedDocRef->set($data);
            return $this->index();
        }catch(\Exception $err){
            echo '<script>Alert($err);</script>';
            //echo $err;
            return $this->index();
        }
    }
    public function showMenu(){
        $firestore = $this->firestoreInit();
        $database = $firestore->collection('barang');
        $snapshot = $database->documents();
        return view('menu',['data' => $snapshot]);
    }
    public function addMenu(Request $request){
        $firestore = $this->firestoreInit();
        try{
        $data =[
            'nama' => $request->nama_menu,
            'modal' => $request->modal,
            'jual' => $request->jual,
            'terjual' => 0
        ];
        $addedDocRef = $firestore->collection('barang')->newDocument();
        $addedDocRef->set($data);
        return $this->index();
    } catch(\Exception $err){
        return $this->index();
    }
    }
    public function showAddFormModal($nama){
        return view('addFormModal',['nama'=>$nama]);
    }
    public function pushFormModal(Request $request){
        try{
            $firestore = $this->firestoreInit();
            $modal = $request->modal;
            $harga = $request->harga;
            $pushModal = [];
            for($i = 0 ; $i < count($modal) ;$i++){
                $tmpPesanan = ['data' => [$modal[$i],$harga[$i]]];
                array_push($pushModal,$tmpPesanan);
            }
            $data = [
                'kategori' => $request->nama,
                'listModal' => $pushModal
            ];
            $database = $firestore->collection('modal')->newDocument();
            $database->set($data);
            return $this->showTransaksi($request->nama);
        } catch(\Exception $err){
            return $this->index();
        }

    }
    public function showTransaksi($nama){
        try{
            $firestore = $this->firestoreInit();
            $database = $firestore->collection('transaksi');
            $query = $database->where('kategori','=',$nama);
            $documents = $query->documents();
            $grandTotal = 0;
            foreach($documents as $tmp){
                $grandTotal = $grandTotal + $tmp['total'] - $tmp['ongkir'];
            }
            return view('transaksi',['data' => $documents,'nama' => $nama,'total' => $grandTotal]);
        }catch(\Exception $err){
            echo $err;
            return $this->index();
        }
    }
    public function detailDataTransaksi($nama){
        try{
            $firestore = $this->firestoreInit();
            $database = $firestore->collection('transaksi');
            $query = $database->where('kategori','=',$nama);
            $documents = $query->documents();
            $grandTotal = 0;
            $dataAllPesanan = array();
            $dataAllJumlah = array();
            $dataAllBersih = array();
            $namaBarang = [];
            $hargaBarang = [];
            $allNamaModal = [];
            $allHargaModal = [];
            $totalHargaModal = 0;
            $databaseBarang = $firestore->collection('barang');
            $snapshotBarang = $databaseBarang->documents();
            $databaseModal = $firestore->collection('modal');
            $queryModal = $databaseModal->where('kategori','=',$nama);
            $snapshotModal = $queryModal->documents();
            foreach($snapshotBarang as $tmp){
                array_push($namaBarang,$tmp['nama']);
                $dat = $tmp['jual']-$tmp['modal'];
                array_push($hargaBarang,$dat);
            }
            foreach($snapshotModal as $tmp){
                foreach($tmp['listModal'] as $dat){
                    array_push($allNamaModal,$dat['data'][0]);
                    array_push($allHargaModal,$dat['data'][1]);
                    $totalHargaModal = $totalHargaModal + $dat['data'][1];
                }
            }
            foreach($documents as $tmp){
                $grandTotal = $grandTotal + $tmp['total'];
            }
            foreach($documents as $tmp){
                foreach($tmp['pesanan'] as $dat){
                    $tmpNamaPesanan = array($dat['data'][0]);
                    $tmpJumlahPesanan = array($dat['data'][1]);
                    array_push($dataAllPesanan,$tmpNamaPesanan);
                    array_push($dataAllJumlah,$tmpJumlahPesanan);
                }
            }
            for($i=0;$i<count($dataAllPesanan) ;$i++){
                for($j=$i+1;$j<count($dataAllPesanan);$j++){

                    if($dataAllPesanan[$i][0] == $dataAllPesanan[$j][0]){
                        $dataAllJumlah[$i][0] = $dataAllJumlah[$i][0] + $dataAllJumlah[$j][0];
                        array_splice($dataAllPesanan,$j,1);
                        array_splice($dataAllJumlah,$j,1);
                    }
                }
            }
            for($i=0;$i<count($dataAllPesanan);$i++){
                for($j=0;$j<count($namaBarang);$j++){
                    if($dataAllPesanan[$i][0] == $namaBarang[$j]){
                        $tmp = $hargaBarang[$j];
                        array_push($dataAllBersih,$tmp);
                    }
                }
            }
            $totalBersih = 0;
            for($i=0;$i < count($dataAllPesanan) ;$i++){
                $totalBersih = $totalBersih + $dataAllJumlah[$i][0] * $dataAllBersih[$i];
            }
            $totalBersih = $totalBersih - $totalHargaModal;
            return view('detailDataTransaksi',['nama' => $nama,'total' => $grandTotal,'pesanan' => $dataAllPesanan,'jumlah' => $dataAllJumlah,'bersih'=>$dataAllBersih,'totalBersih'=>$totalBersih,'namaModal' =>$allNamaModal,'hargaModal' => $allHargaModal]);
        } catch(\Exception $err){

        }
    }
    public function addFormTransaksi(Request $request,$kategori){
        try{
            if(!$request->session()->has('nama')){
                return view('login',['message' => NULL]);
            }else{
                $firestore = $this->firestoreInit();
                $database = $firestore->collection('barang');
                $snapshot = $database->documents();
                return view('addFormTransaksi',['kategori' => $kategori,'data' => $snapshot]);
            }
        } catch(\Exception $err){
            return $this->index();
        }
    }
    public function addTransaksi(Request $request){
        try{
            $firestore = $this->firestoreInit();$nama = [];$harga = [];
            $database = $firestore->collection('barang');
            $snapshot = $database->documents();
            foreach($snapshot as $tmp){
                array_push($nama,$tmp['nama']);
                array_push($harga,$tmp['jual']);
            }
            $pesanan = $request->pesanan;
            $jumlah = $request->jumlah;
            $pushPesanan =[];
            $total = 0 ;
            for($i=0; $i < count($pesanan) ;$i++){
                for($j=0 ; $j < count($nama) ;$j++){
                    if($pesanan[$i] == $nama[$j]){
                            $tmpPesanan = ['data' => [$pesanan[$i],(int)$jumlah[$i],(int)$harga[$j]]];
                            $total = $total + ($jumlah[$i] * $harga[$j]);
                            array_push($pushPesanan,$tmpPesanan);
                            $query = $database->where('nama','=',$pesanan[$i]);
                            $snapshot = $query->documents();
                            $nil;$idBarang;
                            foreach($snapshot as $tmp){
                                $nil = $tmp['terjual'];
                                $idBarang = $tmp->id();
                                if($nil!=NULL && $idBarang != NULL ){
                                    break;
                                }
                            }
                            $nil = $nil +$jumlah[$i];
                            $snapshot = $firestore->collection('barang')->document($idBarang);
                            $snapshot->update([
                                ['path'=>'terjual','value' => $nil]
                            ]);
                        }
                    }
                }
            $tanggal = date("D, j-M-Y",strtotime($request->tanggal));
            $total = $total + $request->ongkir;
            $data =[
                'kategori' => $request->kategori,
                'pesanan' => $pushPesanan,
                'alamat' => $request->alamat,
                'nama' => $request->nama,
                'transport' => $request->transport,
                'status' => 0,
                'tanggal' => $tanggal,
                'catatan' => $request->catatan,
                'pembuat' => $request->session()->get('nama'),
                'total' => $total,
                'ongkir'=> $request->ongkir
            ];
            $addedDocRef = $firestore->collection('transaksi')->newDocument();
            $addedDocRef->set($data);
            return $this->showTransaksi($request->kategori);
        } catch(\Exception $err){
            echo $err;
            return $this->index();
        }
    }
    public function detailTransaksi($id){
        try{
            $firestore = $this->firestoreInit();
            $database = $firestore->collection('transaksi')->document($id);
            $snapshot = $database->snapshot();
            $data = $snapshot->data();
            //return redirect('/detailTransaksi')->with(['data' => $data,'id' => $id]);
            return view('detailTransaksi',['data' => $data,'id' => $id]);
        } catch(\Exception $err){
            return $this->index();
        }
    }
    public function updateTransaksi(Request $request,$id){
        try{
            $firestore = $this->firestoreInit();
            $nama = [];$harga = [];
            $database = $firestore->collection('barang');
            $snapshot = $database->documents();
            foreach($snapshot as $tmp){
                array_push($nama,$tmp['nama']);
                array_push($harga,$tmp['jual']);
            }
            $pesanan = $request->pesanan;
            $jumlah = $request->jumlah;
            $pushPesanan =[];
            $total = 0 ;
            for($i=0; $i < count($pesanan) ;$i++){
                for($j=0 ; $j < count($nama) ;$j++){
                    if($pesanan[$i] == $nama[$j]){
                            $tmpPesanan = ['data' => [$pesanan[$i],(int)$jumlah[$i],(int)$harga[$j]]];
                            $total = $total + ($jumlah[$i] * $harga[$j]);
                            array_push($pushPesanan,$tmpPesanan);
                        }
                    }
                }
            $total = $total + $request->ongkir;
            $database = $firestore->collection('transaksi')->document($id);
            $database->update([
                ['path' => 'alamat','value' => $request->alamat],
                ['path' => 'catatan','value' => $request->catatan],
                ['path' => 'total','value' => $total],
                ['path' => 'ongkir','value' => $request->ongkir],
                ['path' => 'pesanan','value' => $pushPesanan]
            ]);
            return $this->showTransaksi($request->kategori);
        }catch (\Exception $err){
            echo $err;
            return $this->index();
        }
    }
    public function updateStatusTransaksi($id){
        try{
            $firestore = $this->firestoreInit();
            $database = $firestore->collection('transaksi')->document($id);
            $database->update([
                ['path' => 'status','value'=> '1']
            ]);
            $snapshot = $database->snapshot();
            $data = $snapshot->data();
            $nama = $data['kategori'];

            return $this->showTransaksi($nama);
        } catch(\Exception $err){
            echo $err;
            return $this->index();
        }
    }
    public function insight(){
        $firestore = $this->firestoreInit();
        $database = $firestore->collection('barang');
        $query = $database->orderBy('terjual','desc')->limit(5);
        $nama = [];
        $jumlah = [];
        $pendapatanBersih = [];
        $snapshot = $query->documents();
        foreach($snapshot as $dat){
            array_push($nama,$dat['nama']);
            array_push($jumlah,$dat['terjual']);
            $tmp = $dat['terjual'] * ($dat['jual'] - $dat['modal']);
            array_push($pendapatanBersih,$tmp);
        }
        $nama = Arr::flatten($nama);
        $jumlah = Arr::flatten($jumlah);
        $pendapatanBersih = Arr::flatten($pendapatanBersih);
        return view('insight',['nama' => $nama,'terjual' => $jumlah,'pendapatan' => $pendapatanBersih]);
    }
}
