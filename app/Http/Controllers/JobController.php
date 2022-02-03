<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function index()
    {
        return Job::all();
    }


    public function store(Request $request)
    {
       $data = $request->all();
       $rules = [
           'name' => 'required|string',
           'description' => 'nullable|string',
       ];

       $validator = Validator::make($data, $rules);

       if($validator->fails()){
           return response($validator->errors(),422);
       }else{
           $job = Job::create($data);
           return $job;
       }
    }

    public function update(Request $request, Job $job)
    {
        $data = $request->all();
       $rules = [
           'name' => 'string',
           'description' => 'string',
       ];

       $validator = Validator::make($data, $rules);

       if($validator->fails()){
           return response($validator->errors(),422);
       }else{
           $job->update($data);
           return $job;
       }
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return $job;
    }
}
