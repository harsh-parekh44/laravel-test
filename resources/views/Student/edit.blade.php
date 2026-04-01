<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h2 class="text-center">Edit Student</h2>
    <div class="container">
        <form action="{{ route('student.update', $student->id)  }}" method="post" class="form-control" enctype="multipart/form-data">
            @csrf
            @method('post')
            Name:
            <input type="text" name="name" id="name" class="form-control" value="{{ $student->name }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            Email:
            <input type="text" name="email" id="email" class="form-control" value="{{ $student->email }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            Phone Number:
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $student->phone }}">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                Enrollment No:
            <input type="number" name="enrollment_no" id="enrollment_no" class="form-control"
            value="{{ $student->profile->enrollment_no ?? '' }}" placeholder="Enter your Enrollment No">
            @error('enrollment_no')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            Age:
            <input type="text" name="age" id="age" class="form-control" value="{{ $student->age }}">
            @error('age')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            Gender:
            <input type="radio" name="gender" id="gender" value="male" {{ $student->gender == "male" ? 'checked' : ''}}> Male
            <input type="radio" name="gender" id="gender" value="female" {{ $student->gender == 'female' ? 'checked' : ''}}> Female
            <input type="radio" name="gender" id="gender" value="other" {{ $student->gender == 'other' ? 'checked' : ''}}> Other

            @error('gender')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            <br>
        
            Hobbies:
            <input type="checkbox" name="hobbies[]" value="reading" {{ in_array("reading", explode(',', $student->hobbies)) ? 'checked' : '' }}> Reading

            <input type="checkbox" name="hobbies[]" value="writing" {{ in_array("writing", explode(',', $student->hobbies)) ? 'checked' : '' }}> Writing

            <input type="checkbox" name="hobbies[]" value="coding" {{ in_array("coding", explode(',', $student->hobbies)) ? 'checked' : '' }}> Coding

            <input type="checkbox" name="hobbies[]" value="gaming" {{ in_array("gaming", explode(',', $student->hobbies)) ? 'checked' : '' }}> Gaming

            @error('hobbies')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br><br>

            Technologies: <br>
            @foreach($technologies as $technology)
                <input type="checkbox" name="technologies[]" value="{{ $technology->id }}"
                {{ $student->technologies->pluck('id')->contains($technology->id) ? 'checked' : '' }}>
                {{ $technology->name }} <br>
            @endforeach
            @error('technologies')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            Graduation :
            <select name="graduation" id="graduation" class="form-control">
                <option value="">Select Graduation</option>
                <option value="under_graduate"{{ $student->graduation == 'under_graduate' ? 'selected' : '' }}>Under Graduate</option>
                <option value="post_graduate"{{ $student->graduation == 'post_graduate' ? 'selected' : '' }}>Post Graduate</option>

            </select>
            @error('graduation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>

            Profile Picture:
            @if($student->profile_picture)
            <img src=" {{  asset('storage/' . $student->profile_picture) }}" alt="Image" width="70px" height="70px" class="mb-3">
            @else
            <p class="text-danger">No image</p>
            @endif
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('student.studentsdata') }}" class="btn btn-secondary">Back -></a>
        </form>
    </div>
</body>
</html>