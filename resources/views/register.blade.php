
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom JS -->
    <script src="/js/auth.js"></script>
    
</head>
<body>

<div class="container mt-5">
    <div class="card p-4">
        <h3>Register</h3>

        <div id="registerMsg"></div>

        <form id="registerForm">
            @csrf

            <input type="text" name="name" id="name" class="form-control mb-2" placeholder="Name" value="{{ old('name') }}">
            <span class="text-danger" id="nameError"></span>
            <input type="email" name="email" id="email" class="form-control mb-2" placeholder="Email" value="{{ old('email') }}">
            <span class="text-danger" id="emailError"></span>
            <input type="password" name="password" id="password" class="form-control mb-2" placeholder="Password" autocomplete="new-password" value="{{ old('password') }}">
            <span class="text-danger" id="passwordError"></span>
            <input type="date" name="dob" id="dob" class="form-control mb-2" value="{{ old('dob') }}">
            <span class="text-danger" id="dobError"></span>
            <input type="number" name="phone_number" id="phone_number" class="form-control mb-2" placeholder="Phone" value="{{ old('phone_number') }}">
            <span class="text-danger" id="phone_numberError"></span>

            <select name="gender" id="gender" class="form-control mb-2">
                        <option value="">Select Gender</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            <span class="text-danger" id="genderError"></span><br><br>

            <button class="btn btn-primary">Register</button>
            <a class="btn btn-secondary" href='{{ route('login') }}' >Already have account?</a>
        </form>
    </div>
</div>  

</body>
</html>

