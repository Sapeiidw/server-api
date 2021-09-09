<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dokumnetasi') }}
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
                    <code class="text-indigo-500 font-medium">Menambah kolom sso_id apda table users, SSOController, Route untuk memanggil fungsi SSOController, dan SSO_ID dan SSO_Secret yang akan disimpan pada file .env yang diperoleh setelah mendaftarkan Client (aplikasi anda) di <a href="sso.itk.ac.id" class="text-indigo-500">sso.itk.ac.id</a></code>. Oke untuk memulai silahkan buat controller baru dan beri nama SSOControllers</p>
                <pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
php artisan make:controller SSOControllers</pre>
                <p>pada <code class="text-indigo-500 font-medium">App\Http\Controllers\SSOController</code> buatlah fungsi <code class="bg-indigo-200 dark:bg-indigo-500 p-1 rounded">redirect()</code> untuk melakukan authorize ke SSO server</p>
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
    </pre>
            </div>

            <div id="configuration" class="lg:w-3/4 my-8">
                <h1 class="text-3xl font-bold my-2 capitalize">
                    <span class="text-indigo-500">#</span>
                    Configuration</h1>
                    <p>Agar <code class="text-indigo-500 font-medium">App\Http\Controllers\SSOController</code> dapat berfungsi buat lah route pada <code class="bg-indigo-200 dark:bg-indigo-500 p-1 rounded">web.php</code> untuk memanggil fungsi-fungsi yang sudah dibuat tadi.</p>
                    <pre class="flex w-full rounded p-3 my-3 bg-indigo-200 dark:bg-indigo-500 overflow-x-auto">
use App\Http\Controllers\SSOController;

Route::get("/redirect", [SSOController::class,'redirect'])->name('redirect');
Route::get("/callback", [SSOController::class,'callback'])->name('callback');
Route::get("/login_with_sso", [SSOController::class,'login_with_sso'])->name('login_with_sso');
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
                <p class="my-2">SSO ITK adalah sistem Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus at et ducimus nemo. Corrupti ea nostrum, quos magnam error vel quis odio nihil alias similique nam asperiores pariatur facilis id voluptates minima ex tempore non ullam fuga, doloribus eveniet! Itaque rerum corrupti impedit perspiciatis laborum necessitatibus eos distinctio recusandae dignissimos delectus suscipit reprehenderit officia ut praesentium laboriosam doloremque saepe voluptatem iure illo odio repellendus culpa, et accusantium id. Earum odio reprehenderit amet magni adipisci expedita libero explicabo soluta quam dicta velit distinctio corporis natus quisquam voluptatem eligendi, itaque ipsam exercitationem mollitia quaerat placeat voluptatum, praesentium eos officiis. Optio, itaque obcaecati?</p>
            </div>
        </div>
    </div>
</x-app-layout>
