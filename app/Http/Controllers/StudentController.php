<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Technology;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
class StudentController extends Controller
{
    public function index(){
        $technologies = Technology::all();
        $subjects = Subject::all();
        return view('student.form', compact('technologies', 'subjects'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|email|unique:students',
            'phone' => 'required|digits:10|unique:students,phone',
            'enrollment_no' => 'required|digits:5|unique:student_profiles,enrollment_no',
            'gender' => 'required|string',
            'age' => 'required|numeric|between:18,35',
            'hobbies' => 'required|array',
            'technologies' => 'required|array',
            'subjects_id' => 'required|exists:subjects,id',
            'marks' => 'required|numeric',
            'graduation' => 'required|string',
            'profile_picture' => 'mimes:jpeg,jpg,png,gif,svg,webp,avif|max:2048' //2MB max size
        ]);

        $student = Student::create([    
            
            'name' => $request->input('name'), 
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'hobbies' => implode(',', $request->input('hobbies')),
            'graduation' => $request->input('graduation'),
            'profile_picture' => $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null
        ]);

        $student->profile()->create([   
            'enrollment_no' => $request->input('enrollment_no')
        ]);

        
        $student->marks()->create([
            'subjects_id' => $request->input('subjects_id'),
            'marks' => $request->input('marks')
        ]);


        $student->technologies()->attach($request->input('technologies'));

        Session::flash('success', 'Student added successfully');
        return redirect()->route('student.studentsdata');
    }
    
    public function edit($id){
        $student = Student::findOrFail($id);
        $technologies = Technology::all();
        return view('student.edit', compact('student', 'technologies'));
    }

    public function delete($id){

        $student = Student::findOrFail($id);

        //delete image from storage if exists
        if ($student->profile_picture && Storage::disk('public')->exists($student->profile_picture)) {
            Storage::disk('public')->delete($student->profile_picture);
        }

        $student->delete();
        Session::flash('danger', 'Student deleted successfully');
        return redirect()->route('student.studentsdata');
    
    }
    
    public function update($id, Request $request){

        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required|digits:10|unique:students,phone,' . $id,
            'enrollment_no' => 'required|digits:5|unique:student_profiles,enrollment_no,' . $id,
            'gender' => 'required|string',
            'age' => 'required|numeric|between:18,35',
            'hobbies' => 'required|array',
            'technologies' => 'required|array',
            'graduation' => 'required|string',
            'image' => 'mimes:jpeg,jpg,png,gif,svg,webp,avif|max:2048' //2MB max size
        ]);
        
        $student = Student::findOrFail($id);

        $imagepath = $student->profile_picture;

        if($request->hasfile('image')){
            //delete old image
            if($student->profile_picture && Storage::disk('public')->exists($student->profile_picture)) {
            Storage::disk('public')->delete($student->profile_picture);
            }
            //store new image
            $imagepath = $request->file('image')->store('images', 'public');
        }
        $student->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'hobbies' => implode(',', $request->input('hobbies')),
            'graduation' => $request->input('graduation'),
            'profile_picture' => $imagepath
        ]);

        $student->technologies()->sync($request->input('technologies'));
        Session::flash('success', 'Student updated successfully');
        return redirect()->route('student.studentsdata');   
    } 
    public function studentsdata(Request $request){
    $sort = $request->input('sort', 'asc');

    $students = Student::with(['technologies','profile'])
                    ->orderBy('id', $sort)
                    ->paginate(10);

    if($request->ajax()){
        return view('student.studentsdata', compact('students', 'sort'))->render();
    }
     return view('student.studentsdata', compact('students', 'sort'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function search(Request $request){
        $search = $request->input('search');
        $students = Student::where('name', 'Like', "%$search%")
                            ->orWhere('email', 'Like', "%$search%")
                            ->orWhere('phone', 'Like', "%$search%")->paginate(10);

        $output = '';
        foreach($students as $student){

            $hobbies = $student->hobbies ? implode(',', explode(',', $student->hobbies)) : 'N/A';

            $profile_image = $student->profile_picture ? '<img src="'. asset('storage/' . $student->profile_picture) . '" alt="Image" width="70px" height="70px">' : 'No image';
            $output .= '<tr>  
            <td> '. $student->id . '</td>
            <td> '. $student->name . '</td>
            <td> '. $student->email . '</td>
            <td> '. $student->phone . '</td>
            <td> '. $student->gender . '</td>
            <td> '. $student->age . '</td>  
            <td>'. $hobbies .'</td>
            <td> '. $student->graduation . '</td>
            <td> '. $profile_image .' </td>
            <td><a href="'. route('student.edit', $student->id) . '" class="btn btn-primary">Edit</a></td>
            <td><a href="'. route('student.delete', $student->id) . '" class="btn btn-danger" onclick="return confirm(\"Are you sure want to delete this student? '. $student->name . '\")">Delete</a></td>
            </tr>';
        }
        return $output;
    }
    
    public function sort(Request $request)
    {
        $sort = $request->get('sort', 'asc'); 

        $students = Student::orderBy('id', $sort)->paginate(5);

        return view('student.studentsdata', compact('students'));
    }
}

