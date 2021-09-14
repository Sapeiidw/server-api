<x-app-layout>
    @section('title', 'Dokumnetasi')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dokumentasi') }}
        </h2>
    </x-slot>
    <div id="top" class="absolute top-0"></div>
    <a href="#top" class="w-14 h-14 flex justify-center items-center text-3xl rounded-full bg-indigo-500 text-white fixed bottom-2 right-2"><i class="fa fa-angle-up"></i></a>
    <div class="py-12 flex flex-col lg:flex-row w-full">
        <div class="w-full lg:w-1/5 lg:min-h-screen mx-auto my-2 px-2 flex flex-start flex-col">
            <a href="#introduction" class="text-md transition duration-200 ease-in-out hover:underline mx-2 p-2">Introduction</a>
            <a href="#instalation" class="text-md transition duration-200 ease-in-out hover:underline mx-2 p-2">Instalation</a>
            <a href="#configuration" class="text-md transition duration-200 ease-in-out hover:underline mx-2 p-2">Configuration</a>
            <a href="#clients-token" class="text-md transition duration-200 ease-in-out hover:underline mx-2 p-2">Clients Token</a>
            <a href="#logging-sso-account" class="text-md transition duration-200 ease-in-out hover:underline mx-2 p-2">Logging sso account</a>
        </div>
        <div class="w-full lg:w-4/5 max-w-7xl mx-auto my-2 px-4 sm:px-6 lg:px-8 leading-relaxed">
            <div id="introduction" class="lg:w-3/4 my-8">
                <h1 class="text-3xl font-bold my-2 capitalize">
                    <span class="text-indigo-500">#</span>
                    Introduction</h1>
                <p class="my-2">SSO ITK adalah sistem single sign on yang memanfaatkan protokol Oauth2 untuk membagi data akun user (password tidak termasuk) dari SSO ITK ke Client (aplikasi anda) agar user bisa login dengan akun SSO ITK di aplikasi anda.</p>
                <h3 class="text-lg font-bold my-2 capitalize">
                    <span class="text-indigo-500">#</span>
                    Cara Kerja</h3>
                <p class="my-2">Setelah aplikasi anda terhubung dengan SSO ITK, sekarang user punya 2 pilihan login (login seperti biasa atau login dengan akun SSO ITK). Ketika user memilih login dengan akun SSO ITK ia cukup klik tombol login dengan SSO ITK. Jika dia sudah login di website <a href="sso.itk.ac.id" class="text-indigo-500">sso.itk.ac.id</a> maka secara otomatis akan langsung login, akan tetapi jika dia belum login maka akan diarahkan ke halaman login <a href="sso.itk.ac.id" class="text-indigo-500">sso.itk.ac.id</a>.</p>
                <h3 class="text-lg font-bold my-2 capitalize">
                    <span class="text-indigo-500">#</span>
                    Email sudah terdaftar</h3>
                <p class="my-2">Ketika email yang digunakan oleh akun SSO ITK sudah terdaftar di Client (aplikasi anda) maka SSO ITK akan menimpa akun tersebut kemudian menyamakan datanya dan menambahkan sso_id. Sehingga user bisa login dengan 2 cara yaitu cara biasa dan dengan SSO ITK. Dengan begini anda tidak perlu repot-repot migrasi data anda ke SSO ITK.</p>
            </div>
            <div id="instalation" class="lg:w-3/4 my-8">
                <h1 class="text-3xl font-bold my-2 capitalize">
                    <span class="text-indigo-500">#</span>
                    Instalation</h1>
                <p class="my-2">Untuk menggunakan sistem SSO pada aplikasi anda, anda tidak perlu menginstall package apapun, yang anda butuhkan hanyalah 
                    <code class="text-indigo-500 font-medium">Menambah kolom sso_id apda table users, SSOControllers, Route untuk memanggil fungsi SSOControllers, dan SSO_ID dan SSO_Secret yang akan disimpan pada file .env yang diperoleh setelah mendaftarkan Client (aplikasi anda) di <a href="sso.itk.ac.id" class="text-indigo-500">sso.itk.ac.id</a></code>.</p>
                <p class="my-2">Untuk menambah column sso_id pada table user buatlah migration dulu</p>
                <pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">php artisan make:migration add_sso_id_to_users</pre>
                <p class="my-2">buka migration yang baru dibuat tadi dan tambahkan line berikut :</p>
                <pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->integer('sso_id')->nullable()->unique();
        $table->index('sso_id');
    });
}
</pre>
                <p class="my2">Oke selanjutnya jangan lupa tambahkan sso_id di bagian fillable model user</p>
                <pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
namespace App\Models;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password', 'sso_id'
    ];
}
</pre>
                <p class="my2">Oke selanjutnya buat SSOControllers dengan metode sebagai berikut :</p>
                <pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">php artisan make:controller SSOControllers</pre>
                <p class="my-2">pada <code class="text-indigo-500 font-medium">App\Http\Controllers\SSOControllers</code> buatlah fungsi <code class="bg-indigo-200 dark:bg-indigo-500 p-1 rounded">redirect()</code> untuk melakukan authorize ke SSO server</p>
                <pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
public function redirect(Request $request)
{
    $request->session()->put("state", $state =  Str::random(40));
    $query = http_build_query([
        "client_id" => env('SSO_ID'),
        "redirect_uri" => env('APP_URL')."/callback",
        "response_type" => "code",
        "scope" => "",
        "state" => $state
    ]);
    return redirect(env('SSO_URL')."/oauth/authorize?" . $query);
}
</pre>
                <p>Selanjutnya buatlah fungsi <code class="bg-indigo-200 dark:bg-indigo-500 p-1 rounded">callback()</code> untuk mengubah authorize code dari SSO server menjadi access tokens</p>
                <pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
public function callback(Request $request)
{
    $state = $request->session()->pull("state");
    abort_unless(strlen($state) > 0 && $state == $request->state,"500");
    $response = Http::asForm()->post(
        env('SSO_URL')."/oauth/token",
        [
        "grant_type" => "authorization_code",
        "client_id" => env('SSO_ID'),
        "client_secret" => env('SSO_SECRET'),
        "redirect_uri" => env('APP_URL')."/callback",
        "code" => $request->code
    ]);
    $request->session()->put($response->json());
    return redirect("/login_with_sso");
}
</pre>
            <p>Selanjutnya buatlah fungsi <code class="bg-indigo-200 dark:bg-indigo-500 p-1 rounded">login_with_sso()</code> untuk mangambil akun sso dari SSO server agar bisa login di aplikasi anda.</p>
<pre languange class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
public function login_with_sso(Request $request)
{
    // akses API SSO ITK
    $access_token = $request->session()->get("access_token");
    $response = Http::withHeaders([
        "Accept" => "application/json",
        "Authorization" => "Bearer " . $access_token
    ])->get(env('SSO_URL')."/api/user");
    // Data user yang diperoleh
    $user = [
        'name' => $response['name'],
        'email' => $response['email'],
        'sso_id'=> $response['id'],
        'email_verified_at' => $response['email_verified_at'],
        'updated_at' => $response['updated_at'],
    ];
    // Mengecek apakah akun SSO ITK sudah terdaftar atau belum
    $finduser = User::where('sso_id', $response['id'])
                    ->orWhere('email', $response['email'])
                    ->first();
    if($finduser){
        // Menyamakan versi data akun SSO ITK dengan akun SSO ITK yang sudah didaftarkan sebelumnya
        if ($finduser->updated_at != $response['updated_at'] or $finduser->email == $response['email'] and $finduser->sso_id == null) {
            $user['password'] = $finduser->password;
            $finduser->update($user);
            Auth::login($finduser);
        }
        else {
            // Login degnan akun SSO ITK
            Auth::login($finduser);
        }
        // Redirect setelah login
        return redirect('/dashboard');

    }else{
        // Kalau akun SSO ITK belum terdaftar maka kita daftarkan dulu
        $user['password'] = encrypt('');
        $newUser = User::create($user);
        // Jika anda menggunakan jetstream dengan fitur teams maka aktifkan ini
        //Membuat personal team untuk user
        // $newTeam = Team::forceCreate([
        //     'user_id' => $newUser->id,
        //     'name' => explode(' ', $response['name'], 2)[0]."'s Team",
        //     'personal_team' => true,
        // ]);
        // // Simpan team dan tambahkan ke user
        // $newTeam->save();
        // $newUser->current_team_id = $newTeam->id;
        $newUser->save();
        // Login sebagai User baru
        Auth::login($newUser);
        // Redirect setelah login
        return redirect('/dashboard');
    }
}
</pre>
            </div>

            <div id="configuration" class="lg:w-3/4 my-8">
                <h1 class="text-3xl font-bold my-2 capitalize">
                    <span class="text-indigo-500">#</span>
                    Configuration</h1>
                    <p>Agar <code class="text-indigo-500 font-medium">App\Http\Controllers\SSOControllers</code> dapat berfungsi buat lah route pada <code class="bg-indigo-200 dark:bg-indigo-500 p-1 rounded">web.php</code> untuk memanggil fungsi-fungsi yang sudah dibuat tadi.</p>
                    <pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
use App\Http\Controllers\SSOControllers;

Route::get("/redirect", [SSOControllers::class,'redirect'])->name('redirect');
Route::get("/callback", [SSOControllers::class,'callback'])->name('callback');
Route::get("/login_with_sso", [SSOControllers::class,'login_with_sso'])->name('login_with_sso');
</pre>

            </div>
            <div id="clients-token" class="lg:w-3/4 my-8">
                <h1 class="text-3xl font-bold my-2 capitalize">
                    <span class="text-indigo-500">#</span>
                    clients token</h1>
                <p class="my-2">Agar bisa terhubung dengan API SSO ITK dibutuhkan Clients Token berupa Oauth_ID dan Oauth_Secret yang diperoleh dari SSO ITK. Untuk memperoleh Oauth_ID dan Oauth_Secret anda perlu menjadi Admin di SSO ITK atau silahkan hubungi cp: Admin SSO ITK yaitu Pak Tegar.</p>
                <h3 class="text-lg font-bold my-2 capitalize">
                    <span class="text-indigo-500">#</span>
                    Mendaftarkan Client (Aplikasi anda)</h3>
                <p class="my-2">Jika anda adalah admin di SSO ITK silahkan daftarkan aplikasi anda terlebih dahulu, mohon gunakan format yang sesuai.</p>
                <img alt="Gambar halaman mendaftarkan client" class="w-full object-cover  shadow-xl mb-6"
                x-init="$watch('darkMode', val => localStorage.setItem('dark', val))"
                x-bind:src="darkMode ? 'img/Create Client SSO Dark.png' : 'img/Create Client SSO Light.png' ">
                <p class="my-2">Setelah berhasil mendaftar akan ditampilkan Oauth ID dan Oauth Secret yang dibutuhkan untuk authorize aplikasi anda supaya dapat mengakses API SSO ITK.</p>
                <img alt="Gambar halaman mendaftarkan client" class="w-full object-cover  shadow-xl mb-6"
                x-init="$watch('darkMode', val => localStorage.setItem('dark', val))"
                x-bind:src="darkMode ? 'img/Client SSO Dark.png' : 'img/Client SSO Light.png' ">
                <p>Selanjutnya simpan Oauth_ID dan Oauth_Secret yang diperoleh dari SSO ITK pada file <code class="bg-indigo-200 dark:bg-indigo-500 p-1 rounded">.env</code> dengan format seperti berikut :</p>
                    <pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
SSO_ID=945a8070-210a-4e76-b27e-1793af32515b // ganti dengan Oauth_ID anda
SSO_SECRET=SiMOiC5l73TNvjkrsNjUcJRT4EASOX26oyPbUeTsJP0duClpOi // ganti dengan Oauth_Secret anda
SSO_URL=http://sso.itk.ac.id // Ini harus url SSO ITK
</pre>
            </div>
            <div id="logging-sso-account" class="lg:w-3/4 my-8">
                <h1 class="text-3xl font-bold my-2 capitalize">
                    <span class="text-indigo-500">#</span>
                    logging sso account</h1>
                <p class="my-2">
                    Untuk mencatat log User dari akun SSO ITK di setiap client maka ada beberapa konfigurasi tambahan yang harus dibuat. Disini saya sarankan menggunakan package dari Spatie yaitu spatie/laravel-activitylog. Cara kerjanya spatie/laravel-activitylog akan mendeteksi login, logout, dan perubahan pada models yang hanya dilakukan oleh akun SSO ITK. 
                </p>
                <pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">composer require spatie/laravel-activitylog</pre>
                <p class="my-2">
                    Secara default package ini akan secara otomatis terdaftar di service provider.
                    Selanjutnya publish file confignya.
                </p>
                <pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="config"</pre>
                <p class="my-2">
                    Kemudian pada config/activitylog.php ganti default log name menjadi nama Client (aplikasi anda).
                </p>
                <pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
/*
* If no log name is passed to the activity() helper
* we use this default log name.
*/
'default_log_name' => 'Client',
</pre>
<p class="my-2">
    Untuk menyimpan log ke database SSO ITK buatlah koneksi baru seperti berikut di file config/database.php:
</p>
<pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
'log' => [
    'driver' => 'mysql',
    'url' => env('LOG_DB_URL'),
    'host' => env('LOG_DB_HOST', '127.0.0.1'),
    'port' => env('LOG_DB_PORT', '3306'),
    'database' => env('LOG_DB_DATABASE', 'forge'),
    'username' => env('LOG_DB_USERNAME', 'forge'),
    'password' => env('LOG_DB_PASSWORD', ''),
    'unix_socket' => env('LOG_DB_SOCKET', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
    ]) : [],
],
</pre>
<p class="my-2">
Kemudian tambhakan code berikut di file .env
</p>
<pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
ACTIVITY_LOGGER_DB_CONNECTION=log
LOG_DB_HOST=127.0.0.1
LOG_DB_PORT=3306
LOG_DB_DATABASE=server_api  //nama database sso.itk.ac.id
LOG_DB_USERNAME=root        //username database sso.itk.ac.id
LOG_DB_PASSWORD=            //password database sso.itk.ac.id
</pre>
<p class="my-2">
    Untuk mencatat log login dan logout diperlukan event listener. Oleh karena itu buat 2 event listener dengan cara seperti berikut:
</p>
<pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
php artisan make:listener LoginSuccesfully
dan
php artisan make:listener LogoutSuccesfully
</pre>
<p class="my-2">
    App/Listeners/LoginSuccesfully.php
</p>
<pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
use Illuminate\Auth\Events\Login;
use Spatie\Activitylog\Contracts\Activity;

public function handle(Login $event)
{
    if ($event->user->sso_id) {
        activity()
        ->tap(function(Activity $activity) {
            $activity->causer_id = auth()->user()->sso_id;
        })
        ->log('login successfully');
    }
}
</pre>
<p class="my-2">
    App/Listeners/LogoutSuccesfully.php
</p>
<pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
use Illuminate\Auth\Events\Logout;
use Spatie\Activitylog\Contracts\Activity;
public function handle(Logout $event)
{
    if ($event->user->sso_id) {
        activity()
        ->tap(function(Activity $activity) {
            $activity->causer_id = auth()->user()->sso_id;
        })
        ->log('logout successfully');
    }
}
</pre>
<p class="my-2">
    Kemudian untuk mengaktifkan Login dan Logout Listener maka harus didaftarkan pada App/Providers/EnventServiceProvider
</p>
<pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
protected $listen = [
    Registered::class => [
        SendEmailVerificationNotification::class,
    ],
    'Illuminate\Auth\Events\Login' => ['App\Listeners\LoginSuccesfully'],
    'Illuminate\Auth\Events\Logout' => ['App\Listeners\LogoutSuccesfully'],
];
</pre>
<p class="my-2">
    Kemudian untuk mendeteksi perubahan seperti create, update, delete pada sebuah model maka harus mengimplementasikan kode berikut pada model tersebut. Contoh kita gunakan model User.
</p>
<pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use LogsActivity;
    
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This user has been {$eventName}";
    }
    public function tapActivity(Activity $activity)
    {
        // matikan logging jika dia tidak terdaaftar dengan akun sso itk
        if (auth()->user() == null and !isset(auth()->user()->sso_id)) {
            activity()->disableLogging();
        } else {
            $activity->causer_id = auth()->user()->sso_id;
        }
    }
    protected static $logAttributes = ['name', 'email', 'password',]; // ganti dengan atribute yang anda butuhkan
    protected static $logOnlyDirty = true;
}
</pre>
            </div>
        </div>
    </div>
</x-app-layout>
