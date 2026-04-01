<h1>Welcome: {{ session('user')->name }}</h1>

<a href="/logout">Logout</a> | 
<a href="#" id="deleteAccount" style="color:red;">Delete Account</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#deleteAccount").click(function (e) {
            e.preventDefault();

            if(confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
                $.ajax({
                    url: '/delete-account',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        alert("Your account has been deleted.");
                        window.location.href = "/register"; // redirect to register page
                    },
                    error: function(err) {
                        alert("Something went wrong. Try again!");
                    }
                });
            }
        });
    });
</script>