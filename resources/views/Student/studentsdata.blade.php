<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class=" container mt-3">
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(Session::has('danger'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ Session::get('danger') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <a href="{{ route('student.form') }}" class="btn btn-primary">Add Student</a><br><br>
        <h2 class="text-center">Students Data</h2>
        <div class="search-container">
            <input type="text" id="search" class="form-control" placeholder="Search by name, email, phone">
        </div> <br>

        <table class="table table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th>
                        <a href="javascript:void(0);" id="sort-id" data-sort="asc"
                            class="text-white text-decoration-none d-flex justify-content-between align-items-center gap-2">
                            ID <i class="fas fa-sort" id="sort-icon"></i>
                        </a>
                    </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Hobbies</th>
                    <th>Graduation</th>
                    <th>Profile Picture</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody class="text-center" id="students-data">
                @foreach($students as $student)
                    <tr>
                        <td> {{ $student->id }}</td>
                        <td> {{ $student->name }}</td>
                        <td> {{ $student->email }}</td>
                        <td> {{ $student->phone }}</td>
                        <td> {{ $student->gender }}</td>
                        <td> {{ $student->age }}</td>

                        <td>
                            @if($student->hobbies)
                                                {{ is_array($student->hobbies)
                                    ? implode(', ', $student->hobbies)
                                    : implode(', ', explode(',', $student->hobbies)) 
                                }}
                            @else
                                N/A
                            @endif
                        </td>

                        <td> {{ $student->graduation }}</td>
                        @if($student->profile_picture)
                            <td><img src="{{ asset('storage/' . $student->profile_picture) }}" width="70px" height="70px"></td>
                        @else
                            <td>No image</td>
                        @endif
                        <td><a href="{{  route('student.edit', $student->id)  }}" class="btn btn-primary">Edit</a></td>
                        <td><a href="{{  route('student.delete', $student->id)  }}" class="btn btn-danger"
                                onclick="return confirm('Are you sure want to delete this student? {{ $student->name  }}')">Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table> 
        <div class="pagination  gap-3">
            {{ $students->appends(['sort' => $sort])->links('pagination::bootstrap-5') }}
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            let timeout;
            let op = 500;
            $(document).ready(function () {
                //searching
                $('#search').on('keyup', function () {
                    clearTimeout(timeout);
                    let search = $(this).val();
                    timeout = setTimeout(function () {
                        $.ajax({
                            url: '{{ route('student.search') }}',
                            type: 'GET',
                            data: { search: search },
                            success: function (response) {
                                $('#students-data').html(response);
                            },
                            error: function () {
                                alert('No students found');
                            }
                        });
                    }, op);
                });

                //sorting
                $('#sort-id').on('click', function () {
                    let sort = $(this).data('sort') === 'asc' ? 'desc' : 'asc'; //toggle system
                    $(this).data('sort', sort);
                    let url = '{{ route('student.studentsdata') }}';

                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: { sort: sort, page: 1 },
                        success: function (response) {
                            $('#students-data').html($(response).find('#students-data').html());
                            $('.pagination').html($(response).find('.pagination').html());
                        },
                        error: function () {
                            alert('Something went wrong');
                        }
                    });

                });

                //pagination
                $(document).on('click', '.pagination a', function (e) {
                    e.preventDefault();
                    let url = $(this).attr('href');
                    let sort = $('#sort-id').data('sort');

                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: { sort: sort },
                        success: function (response) {
                            $('#students-data').html($(response).find('#students-data').html());
                            $('.pagination').html($(response).find('.pagination').html());
                        },
                        error: function (err) {
                            alert('Something went wrong');
                        }
                    });
                });
            });
        </script>
</body>

</html>

