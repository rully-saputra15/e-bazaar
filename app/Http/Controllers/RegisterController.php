<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Storage\StorageClient;
use Kreait\Firebase\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use DateTime;
class RegisterController extends Controller
{
    private function firestoreInit(){
        $firestore = new FirestoreClient([
            'projectId' => 'bazaar-dki2',
        ]);
        return $firestore;
    }
    private function firebaseStorageInit(){
        $storage = new StorageClient([
            'projectId' => 'bazaar-dki2',
            'keyFilePath' => __DIR__.'/dki2.json'
        ]);
        /*$storage = (new Factory())
        ->withDefaultStorageBucket('image')
        ->createStorage();
        $factory = (new Factory)->withDatabaseUri('https://bazaar-dki2.firebaseio.com');
        $factory = (new Factory)->withServiceAccount(__DIR__.'/dki2.json');
        $storage = $factory->createStorage();
        $storageClient = $storage->getStorageClient();*/
        return $storage;
    }
    public function index(){
        return view('register');
    }
    public function register(Request $request){
        try{
            $firestore = $this->firestoreInit();
            $image = $request->file('foto');
            $imageName = $image->getClientOriginalName();
           // $image->storeAs('/images',$imageName);
           // $url = Storage::url($imageName);
            $storage = $this->firebaseStorageInit();
            $defaultBucket = $storage->bucket('bazaar-dki2.appspot.com');
            Storage::disk('gcs')->put($imageName,file_get_contents($image));
            $expires = new \DateTime('01-01-2500');
            $object = $defaultBucket->object($imageName);
            $url = $object->signedUrl($expires);
            $date = \Carbon\Carbon::createFromFormat('Y-m-d', $request->tanggal_lahir)
            ->format('d-M-Y');
            $data = [
                'nama' => $request->nama,
                'hadir' => 0,
                'jenis_kelamin' => $request->jenis_kelamin,
                'line' => $request->line,
                'whatsapp' => $request->whatsapp,
                'pendidikan' => $request->pendidikan,
                'status' => $request->status,
                'tahun_gojukai' => $request->tahun_gojukai,
                'tempat' => $request->tempat_lahir,
                'tanggal_lahir' => $date,
                'cetya' => $request->cetya,
                'instagram' => $request->instagram,
                'foto' => $url,
            ];
            $addedDocRef = $firestore->collection('member')->newDocument();
            $addedDocRef->set($data);
            return view('thankyou');
        } catch(Throwable $e){
            report($e);
        }

    }
}
