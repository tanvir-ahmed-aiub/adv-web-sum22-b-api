<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Token;
use Datetime;
use App\Models\File;

class APIController extends Controller
{
    function create(Request $req){
        $validator = Validator::make($req->all(),[
            "name"=>"required",
            "cgpa"=>"required"
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
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

    function login(Request $req){
        if($req->uname=="tanvir" && $req->pass=="1234"){
            $key = Str::random(67);
            $token = new Token();
            $token->tkey = $key;
            $token->user_id = 1;
            $token->created_at = new Datetime();
            $token->save();
            return response()->json($token);
        }
        return response()->json(["msg"=>"Username password invalid"],404);
    }
    function logout(Request $req){
        $tk = $req->token;
        $token = Token::where('tkey',$tk)->first();
        $token->expired_at = new Datetime();
        $token->save();
        return response()->json(["msg"=>"Logged out"]);
    }
    function file(Request $req){
        if($req->hasfile('file')){
            $orgName = $req->file->getClientOriginalName();
            $req->file->storeAs('public/pro_pics',$orgName);
            return response()->json(["msg"=>$req->file->getClientOriginalName()]);
        }
        return response()->json(["msg"=>"No file"]);
    }
}
