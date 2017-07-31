## Instalasi Laravel


Requirement untuk menjalankan Laravel 5.4 adalah:

- PHP 7
- mysql (database server)
- composer
- nodejs
- npm

Setelah memenuhi requirement, yang diperlukan adalah:

- Instalasi project baru dengan perintah

```
composer create-project --prefer-dist laravel/laravel nama-project

cd nama-project

npm install
```

- Atau menjalankan project yang sudah ada dengan perintah:

```
composer install

npm install
```

## Konfigurasi Laravel

- Jika kita melakukan instalasi menggunakan `composer create-project` maka kita sudah memiliki file `.env` untuk menyimpan konfigurasi environment kita.
- Namun jika kita melakukan clone dari repo, maka kita harus membuat file `.env` kita sendiri dan melakukan copas isi dari `.env.example`.
- Jika kita melakukan instalasi menggunakan `composer create-project` maka kita sudah mendapatkan key unik untuk aplikasi. 
- Namun jika kita melakukan clone dari repo, maka kita perlu menjalankan perintah di bawah untuk mendapatkan key baru.

```
php artisan key:generate
```

- Selanjutnya ubah konfigurasi database di `.env` untuk disesuaikan dengan konfigurasi database lokal

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

## Jalankan Laravel

```
php artisan serve
```

- Buka browser dengan URL `localhost:8000`

## Membuat Otentikasi

- Laravel telah menyediakan otentikasi yang cukup lengkap hanya dengan menjalankan perintah berikut

```
php artisan make:auth
php artisan migrate
```

- Refresh browser, registrasi user, dan login
- Untuk menambah jumlah user, kita juga bisa menambahkan data abal-abal dengan cara berikut:

```
php artisan tinker
>>> factory(App\User::class, 10)->create();
```

## Merubah Tampilan Secara Sederhana

- Semua tampilan berada di folder `/resources/views`
- Folder Layout berisi file untuk mendefinisikan kerangka layout yang dapat digunakan oleh view lain.
- Semua views sebaiknya menggunakan nama file berakhiran `.blade.php` untuk dapat menggunakan **Blade Template Engine** milik Laravel.
- Buka `views/layouts/app.blade.php` dan ubah kode berikut:

```html
<!-- baris 11 -->
<title>Pengurus Uang</title>

...

<!-- baris 31 -->
<a class="navbar-brand" href="{{ url('/') }}">
    Pengurus Uang
</a>
```

- Selanjutnya ubah juga file `views/home.blade.php` dan ubah kode berikut:

```html
<!-- baris 31 -->
<div class="panel-heading">
    <h1>Beranda Aplikasi</h1>
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('add-trans') }}" 
            class="btn btn-primary btn-lg btn-block">
            Tambah Transaksi</a>
        </div>
    
        <div class="col-md-4">
            <a href="{{ route('show-trans') }}" 
            class="btn btn-warning btn-lg btn-block">
            Tampilkan Transaksi</a>
        </div>
    
        <div class="col-md-4">
            <a href="{{ route('edit-profile') }}" 
            class="btn btn-danger btn-lg btn-block">
            Edit Profil</a>
        </div>
    </div>
</div>
```

## Tambahkan Route

- Ketika di-refresh maka akan mendapatkan error, karena kita belum menambahkan route untuk ketiga link tersebut.
- Buka file `routes/web.php` untuk menambahkan route menjadi seperti di bawah ini:

```php
// ....
Route::get('/transaction/add', 'HomeController@index')->name('add-trans');
Route::post('/transaction/add', 'HomeController@index')->name('add-trans.post');
Route::get('/transaction/show', 'HomeController@index')->name('show-trans');
Route::get('/profile', 'HomeController@index')->name('edit-profile');
```

- Semua URL link masih mengarah ke Controller yang sama, nanti akan diubah setelah membuat controller yang cocok.

## Buat Model Transaksi &amp; Migrasinya

- Untuk menambahkan tabel baru, kita harus membuat Model sekaligus perintah migrasinya. Jalankan perintah di bawah ini:

```
php artisan make:model -m Transaction
```

- Tambahkan aturan relasi pada file model `app/Transaction.php`:

```php
public function user()
{
    return $this->belongsTo(User::class);
}
```

- Tambahkan juga aturan relasi pada file `app/User.php`;

```php
protected $fillable = ['title', 'amount', 'description', 'type', 'status'];

public function transactions()
{
    return $this->hasMany(Transaction::class);
}
```

- Setelah dibuatkan file baru, edit file `\database\transaction\****_create_transactions_table.php` dan tambahkan kode berikut:

```php
// ...
public function up()
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->integer('amount');
        $table->string('description');
        $table->enum('type', ['pengeluaran', 'pemasukan']);
        $table->enum('status', ['valid', 'invalid', 'pending']);
        $table->integer('user_id')->unsigned();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('cascade');
    });
}
// ...
```
- Selanjutnya jalankan perintah:

```
php artisan migrate
php artisan tinker
>>> App\Transaction::count();
```

## Buat Controller dan View untuk Input Data

- Buat file view baru di `resources/views/add-trans.blade.php`

- Buka file tersebut dan isikan dengan di bawah ini:

```html
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Input Transaksi Baru
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Nama Transaksi</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="nama transaksi">
                        </div>
                        <div class="form-group">
                            <label for="amount">Jumlah Pengeluaran</label>
                            <input type="text" class="form-control" id="amount" name="amount" >
                        </div>
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <input type="text" id="description" name="description" class="form-control">
                            <p class="help-block">Keterangan tambahan tentang transaksi</p>
                        </div>
                        <div class="form-group">
                            <label for="type">Tipe</label>
                            <select name="type" id="type" class="form-control">
                                <option value="1">Pengeluaran</option>
                                <option value="2">Pemasukan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
```

- Buat class Controller baru

```
php artisan make:controller TransactionController
```

- Buka file `app/Http/Controllers/TransactionController.php`, kemudian tambahkan kode berikut:

```php
use Illuminate\Support\Facades\Auth;

// ..

public function add(Request $request)
{
    if ($request->isMethod('post')) {
        Auth::user()->addTransaction($request->all());

        return redirect()->route('home')
            ->with('message', 'Berhasil input data transaksi baru');
    }
    return view('add-trans');
}

```

- Juga tambahkan kode berikut pada file model `app/User.php`

```php
public function addTransaction($input)
{        
    return $this->transactions()
                ->create(['title'=>$input['title'], 
                          'amount'=>$input['amount'],
                          'description'=>$input['description'],
                          'type'=>$input['type'],
                          'status'=>1]);
}
```

- Jangan lupa untuk memindahkan Router ke `Transaction@add`

- Untuk memudahkan proses development, kita dapat membuat model factory untuk tabel transactions tersebut.
- Buka file `database/factories/ModelFactory.php` dan tambahkan kode berikut:

```php
$factory->define(App\Transaction::class, function (Faker\Generator $faker) {    
    return [
        'title' => $faker->words($nb = 3, $asText = true),
        'amount' => $faker->numberBetween($min = 10000, $max = 900000),
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'type' => $faker->numberBetween($min = 1, $max = 2),
        'status' => 1,
        'user_id' => $faker->numberBetween($min = 1, $max = 11),
    ];
});
```

- Keluar dan dari mode tinker terlebih dahulu kemudian masuk lagi untuk menjalankan factory model yang barusan dibuat

```
>>> exit
php artisan tinker
>>> factory(App\Transaction::class, 10)->create();
```
