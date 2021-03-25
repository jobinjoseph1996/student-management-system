<?php

namespace App\Http\Controllers;

use App\Models\MarkEntry;
use Illuminate\Http\Request;
use App\Models\StudentData;
use Validator;
use Session;
// use App\Http\Controllers\Controller;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = StudentData::all();
		return view('student.student',compact('user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate      
        $validate = \Validator::make($request->all(), [
            'name'   => 'required',
            'age'    => 'required',
            'gender' => 'required',
            'teacher'  => 'required'
	    ]);
	    if( $validate->fails()){
	        return redirect()
	        ->back()
	        ->withErrors($validate);
	    }else {
            // store
            $StudentData              = new StudentData();
            $StudentData->name        = $request->name;
            $StudentData->age  = $request->age;
            $StudentData->gender      = $request->gender;
            $StudentData->reporting_teacher       = $request->teacher;
            $insert = $StudentData->save();
            if($insert){
	            // redirect
	            Session::flash('message', 'Successfully created user!');
	            Session::flash('alert-class', 'alert-success'); 
	            return redirect('/student');
	        }
	        else{
	        	Session::flash('message', 'Failed!');
	            Session::flash('alert-class', 'alert-danger'); 
	            return redirect('/student');
	        }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate      
        $validate = \Validator::make($request->all(), [
            'name'   => 'required|max:20',
            'age'    => 'required',
            'gender' => 'required',
            'teacher'  => 'required'
	    ]);
	    if( $validate->fails()){
	        return redirect()
	        ->back()
	        ->withErrors($validate);
	    }else {
            
	    	$user_update = StudentData::where('id', $request->id)
                            ->update(
                            [
                                'name' => $request->name,
                                'age' => $request->age,
                                'gender' => $request->gender,
                                'reporting_teacher' => $request->teacher
                             
                            ]
                    );
             if($user_update){
	            // redirect
	            Session::flash('message', 'Successfully updated user!');
	            Session::flash('alert-class', 'alert-success'); 
	            return redirect('/student');
	        }
	        else{
	        	print_r('failed');exit;
	        	Session::flash('message', 'Failed!');
	            Session::flash('alert-class', 'alert-danger'); 
	            return redirect('/student');
	        }
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function editUser($id)
    {
        // get the user
        $users    = StudentData::
                        select('id', 'name', 'age','gender','reporting_teacher')
                        ->where('id', '=', $id)
                        ->get();
		return view('student.edit',compact('users'));

    }
    public function deleteUser($id){
        // delete
        $users    = MarkEntry::
                    select('*')
                    ->where('student_id', '=', $id)
                    ->get();
        if($users->isEmpty())
        {
            $user = StudentData::find($id);
            $user->delete();
            Session::flash('message', 'Successfully deleted the User!');
            Session::flash('alert-class', 'alert-success'); 
        }
        else{
            Session::flash('message', 'Cannot delete the user.It is reffered in another table!');
            Session::flash('alert-class', 'alert-danger'); 
        }
      

       // redirect
       
       return redirect('/student');

   }
}
