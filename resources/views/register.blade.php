<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">
    </head>
    <body>
            <div class="container">
                <div class="mt-5"></div>
                <img style="width:128px;height:128px;" class="rounded mx-auto d-block"src="{{URL::asset('img/logo.jpeg')}}">
                <form method="post" action="{{url('/registerPost')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <h1 style="text-align:center">Pendaftaran</h1>
                        <p style="text-align:center">Informasi-informasi yang disimpan berguna untuk pendataan anak-anak DKI 2</p>
                        <label for="">Nama Lengkap</label>
                        <input class="form-control" type="text" name="nama" placeholder="ex: John doe" required><br>
                        <label for="">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" required>
                            <option value="P">Perempuan</option>
                            <option value="L">Laki-Laki</option>
                        </select><br>
                        <label for="">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="BDI">BDI</option>
                            <option value="NON-BDI">NON-BDI</option>
                        </select><br>
                        <label for="">Tahun Gojukai(diisi jika umat)</label>
                        <input type="text" name="tahun_gojukai" class="form-control" placeholder="ex: 2004" required><br>
                        <label for="">Tempat Lahir</label>
                        <input class="form-control" type="text" name="tempat_lahir" placeholder="ex: Jakarta" required><br>
                        <label for="">Tanggal Lahir</label>
                        <input class="form-control" type="date" name="tanggal_lahir" required><br>
                        <label for="">ID Line</label>
                        <input class="form-control" type="text" name="line" placeholder="ex: ididline" required><br>
                        <label for="">No Whatsapp</label>
                        <input class="form-control" type="text" name="whatsapp" placeholder="ex: 085789012441" required><br>
                        <label for="">ID Instagram</label>
                        <input class="form-control" type="text" name="instagram" placeholder="ex: gm.dki2" required><br>
                        <label for="">Foto Kamu</label>
                        <input class="form-control" type="file" name="foto" accept="image/*" required><br>
                        <label for="">Cetya</label>
                        <select class="form-control" name="cetya" required>
                            <option value="BSD">BSD</option>
                            <option value="KELAPA GADING">KELAPA GADING</option>
                            <option value="SUNTER">SUNTER</option>
                            <option value="BEKASI">BEKASI</option>
                            <option value="HAPPY">HAPPY</option>
                            <option value="EKAYANA">EKAYANA</option>
                            <option value="PLUIT">PLUIT</option>
                            <option value="TEGAL ALUR">TEGAL ALUR</option>
                            <option value="JATINEGARA">JATINEGARA</option>
                        </select><br>
                        <label for="">Pendidikan</label>
                        <select class="form-control" name="pendidikan" required>
                            <option value="SD">SD</option>
                            <option value="SMP 1">SMP 1</option>
                            <option value="SMP 2">SMP 2</option>
                            <option value="SMP 3">SMP 3</option>
                            <option value="SMA 1">SMA 1</option>
                            <option value="SMA 2">SMA 2</option>
                            <option value="SMA 3">SMA 3</option>
                            <option value="Kuliah S1">Kuliah S1</option>
                            <option value="Kuliah S2">Kuliah S2</option>
                        </select><br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
    </body>
</html>
