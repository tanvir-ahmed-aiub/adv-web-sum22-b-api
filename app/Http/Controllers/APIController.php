<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
class APIController extends Controller
{
    function create(Request $req){
        $validator = Validator::make($req->all(),[
            "name"=>"required",
            "cgpa"=>"required"
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $s = new Student();
        $s->name = $req->name;
        $s->dob = $req->dob;
        $s->cgpa = $req->cgpa;
        $s->save();
        return response()->json(
            [
                "msg"=>"Added Successfully",
                "data"=>$s        
            ]
        );
    }
    //
    function get(){
        $data = Student::all();
        return response()->json($data);
    }
    function search($id){
        $data = Student::where('id',$id)->first();
        return response()->json($data);
    }
}
