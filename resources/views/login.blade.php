<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/auth.js"></script>
</head>
<body>

<div class="container mt-5">
    <div class="card p-4">
        <h3>Login</h3>

        <div id="loginMsg"></div>

        <form id="loginForm" method="POST" action="/login">
            @csrf

            <input type="email" name="email" id="email" class="form-control mb-2" placeholder="Email" value="{{ old('email') }}">
            <span class="text-danger" id="emailError"></span>
            <input type="password" name="password" id="password" class="form-control mb-2" placeholder="Password" autocomplete="new-password" value="{{ old('password') }}">
            <span class="text-danger" id="passwordError"></span><br>

            <button class="btn btn-success">Login</button>
            <a  class="btn btn-secondary" href='{{ route('register') }}' >Create Account</a>
        </form>

    </div>
</div>

</body>
</html>


 <!-- <?php
// namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
// use App\Models\Students;

// class DatabaseSeeder extends Seeder
// {
//     use WithoutModelEvents;

//     /**
//      * Seed the application's database.
//      */
//     public function run(): void
//     {
//         // User::factory(10)->create();

//         Students::factory()->count(10)->create();
//     }
// }


