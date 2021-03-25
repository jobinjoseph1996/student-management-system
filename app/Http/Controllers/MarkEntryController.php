<?php

namespace App\Http\Controllers;

use App\Models\MarkEntry;
use Illuminate\Http\Request;
use App\Models\StudentData;
use Validator;
use Session;
// use App\Http\Controllers\Controller;
class MarkEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = MarkEntry::select('id','student_id','terms','maths','science','history','created_at')->with('student:id,name')->get();
        return view('markentry.markentry',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('markentry.add');
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
            'student_id'   => 'required',
            'terms'    => 'required',
            'maths' => 'required|numeric',
            'science'  => 'required|numeric',
            'history'  => 'required|numeric'
	    ]);
	    if( $validate->fails()){
	        return redirect()
	        ->back()
	        ->withErrors($validate);
	    }else {
            // store
            $StudentData              = new MarkEntry();
            $StudentData->student_id        = $request->student_id;
            $StudentData->terms  = $request->terms;
            $StudentData->maths      = $request->maths;
            $StudentData->science       = $request->science;
            $StudentData->history       = $request->history;
            $insert = $StudentData->save();
            if($insert){
	            // redirect
	            Session::flash('message', 'Mark added successfully!');
	            Session::flash('alert-class', 'alert-success'); 
	            return redirect('/markentry');
	        }
	        else{
	        	Session::flash('message', 'Failed!');
	            Session::flash('alert-class', 'alert-danger'); 
	            return redirect('/markentry');
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
            'student_id'   => 'required',
            'terms'    => 'required',
            'maths' => 'required|numeric',
            'science'  => 'required|numeric',
            'history'  => 'required|numeric'
	    ]);
	    if( $validate->fails()){
	        return redirect()
	        ->back()
	        ->withErrors($validate);
	    }else {
            
	    	$user_update = MarkEntry::where('id', $request->id)
                            ->update(
                            [
                                'student_id' => $request->student_id,
                                'terms' => $request->terms,
                                'maths' => $request->maths,
                                'science'  => $request->science,
                                'history'  => $request->history
                             
                            ]
                    );
             if($user_update){
	            // redirect
	            Session::flash('message', 'Mark updated successfully!');
	            Session::flash('alert-class', 'alert-success'); 
	            return redirect('/markentry');
	        }
	        else{
	        	print_r('failed');exit;
	        	Session::flash('message', 'Failed!');
	            Session::flash('alert-class', 'alert-danger'); 
	            return redirect('/markentry');
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
        $users    = MarkEntry::
                    select('*')
                    ->where('id', '=', $id)
                    ->get();
		return view('markentry.edit',compact('users'));

    }
    public function deleteUser($id){
        // delete
       $user = MarkEntry::find($id);
       $user->delete();

       // redirect
       Session::flash('message', 'Mark details deleted successfully!');
       Session::flash('alert-class', 'alert-success'); 
       return redirect('/markentry');

   }
   public function getStudentcombo($id)
   {
        $data = StudentData::all();
        $html = "";
      
        $attr = $id!=""?"disabled":"required";
        $html .= "<select name='student_id' id='student_id' class='form-control' required>
                <option value=''>--Select--</option>";
                    if(!$data->isEmpty())
                    {
                            for ($i = 0; $i < count($data); $i++) {
                                if ($id == $data[$i]['id']) {
                                    $html .= "<option value='" . $data[$i]['id'] . "' selected>" . $data[$i]['name'] . "</option>";
                                } else {
                                    $html .= "<option value='" . $data[$i]['id'] . "'>" . $data[$i]['name'] . "</option>";
                                }
                            }
                    }
        $html .= "</select>";
        return $html; 
   }
}
