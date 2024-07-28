<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Students;
class StudentsController extends Controller
{
    public function getStudents(){
        $students = Students::where('class','=',Auth::user()->class)->paginate(10);
        return view('pages.students',compact('students'));
    }
    public function createStudent(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'subject' => 'required',
            'marks' => 'required'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->route('home')
                             ->withErrors($validator)
                             ->withInput();
        }

        $student = $request->only('name', 'subject','marks');
        $check = Students::where('name','=',$student['name'])->where('subject','=',$student['subject'])->first();
        if($check){
             Students::where('id','=',$check->id)->update($student);
        } else {
            $student['status'] = 1;
            $student['class'] = Auth::user()->class;
            Students::create($student);
        }
        return redirect()->intended('home');
    }

    public function deleteStudent(Request $request,$studentId){
         $student = Students::whereRaw('MD5(id) = ?', [$studentId])->delete();
         if($student) $response = ['status' => true, 'message' => 'Student Deleeted Successfully!'];
         else $response = ['status' => false, 'message' => 'Student Not Deleted!'];
         return response()->json($response,200);
    }
}
