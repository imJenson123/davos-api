<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;

class TodoController extends Controller
{
    public function get(){
        $todo = Todo::all();

        return response()->json($todo,200);
    }

    public function create(Request $request){
        $fields = [
            'description'=>'required',
        ];
        $customMsg = [
            'description.required' => 'Description is required',
        ];
        $this->validate($request,$fields,$customMsg);

        $todo = new Todo();
        $todo->description = $request->description;
        $todo->save();

        return response()->json($todo,200);
    }

    public function markComplete(Request $request,$id){
        if($id == null){
            return response()->json(['message'=>'ID is Required'],404);
        }

        $todo = Todo::where('id',$id)->update(['status'=>'completed']);

        return response()->json($todo,200);
    }

    public function delete($id){
        if($id == null){
            return response()->json(['message'=>'ID is Required'],404);
        }
        
        $todo = Todo::find($id);
        $todo->delete();

        return response()->json(['message'=>'Successfully Deleted'],200);
    }
}
