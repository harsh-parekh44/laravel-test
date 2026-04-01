<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h2 class="text-center"`>Student Form</h2>
    <div class="container">
    <form action="{{ route('student.store') }}" method="post" class="form-control" enctype="multipart/form-data">
        @csrf
        Name:
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter your name">
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        Email:
        <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}"placeholder="Enter your email">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        Phone Number:
        <input type="number" name="phone" id="phone"  class="form-control" value="{{ old('phone') }}"placeholder="Enter your phone">
        @error('phone')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        Enrollment No:
        <input type="number" name="enrollment_no" id="enrollment_no" class="form-control" value="{{ old('enrollment_no') }}" placeholder="Enter your Enrollment No">
        @error('enrollment_no')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>

        Age:
        <input type="number" name="age" id="age" class="form-control" value="{{ old('age') }}" placeholder="Enter your age">
        @error('age')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        Gender:
        <input type="radio" name="gender" id="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> Male
        <input type="radio" name="gender" id="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}> Female 
        {{-- <input type="radio" name="gender" id="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}> Other <br> --}}
        @error('gender')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        Hobbies:
        <input type="checkbox"  id="hobbies" name="hobbies[]" value="reading" {{ in_array('reading', old('hobbies', [])) ? 'checked' : '' }}> Reading
        <input type="checkbox"  id="hobbies" name="hobbies[]" value="writing" {{ in_array('writing', old('hobbies', [])) ? 'checked' : '' }}> Writing
        <input type="checkbox"  id="hobbies" name="hobbies[]" value="coding" {{ in_array('coding', old('hobbies', [])) ? 'checked' : '' }}> Coding
        <input type="checkbox"  id="hobbies" name="hobbies[]" value="gaming" {{ in_array('gaming', old('hobbies', [])) ? 'checked' : '' }}> Gaming <br>  
        @error('hobbies')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>

        Technologies: <br>
        @foreach($technologies as $technology)
            <input type="checkbox" name="technologies[]" value=" {{ $technology->id }} " 
                    {{ in_array($technology->id, old('technologies', []))  ? 'checked' : '' }}> {{ $technology->name }} <br>
        @endforeach
        @error('technologies')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>

        Subjects:
            <select name="subjects_id" class="form-control">    
            <option value="">Select Subject</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->subjects_name }}</option>
            @endforeach
        </select>
        @error('subjects_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        Marks:
        <input type="number" name="marks" id="marks" class="form-control" value="{{ old('marks') }}" placeholder="Enter your marks">
        @error('marks')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>

        Graduation:
        <select name="graduation" id="graduation" class="form-control">
           <option value="">Select Graduation</option>
           <option value="under_graduate" {{ old('graduation') == 'under_graduate' ? 'selected' : '' }}>Under Graduate</option>
           <option value="post_graduate" {{ old('graduation') == 'post_graduate' ? 'selected' : '' }}>Post Graduate</option>
        </select>
        @error('graduation')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        Profile Picture:
        <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}"> 
        @error('image')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href = {{ route('student.studentsdata') }} class="btn btn-secondary">View Data</a>
    </form>
    </div>
</body>
</html>