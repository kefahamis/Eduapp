<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderFile;
use App\Repositories\FileRepository;

class DropZoneController extends Controller
{
    //
    public function postFile(Request $request){
     $file = $request->file('file');
     $allowed = ['pdf','PDF','csv','docx','xls','xlsx','jpg','jpeg','png'];
     $ext = $file->getClientOriginalExtension();
     $file_name = $file->getClientOriginalName();
     if(!in_array($ext,$allowed)){
        return response(['errors'=>['documents'=>'Please upload a valid file(pdf,csv,docx,xls,xlsx,jpg,jpeg,png)']],422);
    }
    $uploaded = FileRepository::move($file);
    if($uploaded['uploaded'] == false){
        return response(['errors'=>['documents'=>$uploaded['error']]],422);
    }

    $document_path = $uploaded['path'];

    $document = new OrderFile;
    $document->order_code = '0000';
    $document->user_id = 99999;
    $document->user_role = 'customer';
    $document->file_name = $file_name;
    $document->mime_type = $ext;
    $document->path = $document_path;
    $document->save();

    $order_files = array();
    if (request()->session()->has('order_files')) {
        $order_files = request()->session()->get('order_files');
    }
    array_push($order_files, $document->id);

    request()->session()->put('order_files',$order_files);

    return response()->json(['status' => "File uploaded."]);
}

public function deleteFile(Request $request){
    $file_name = $request->file_name;
    $file = OrderFile::where('file_name',$file_name)->first();
    if($file){
        $file_id = $file->id;
        $file->delete();

        $order_files = array();
        if (request()->session()->has('order_files')) {
            $order_files = request()->session()->get('order_files');
            if(($key = array_search($file_id,$order_files)) !== false) {
               unset($order_files[$key]);
               request()->session()->put('order_files',$order_files);
           }   
       }

   }
   return response()->json(['status' => 'success']);
}

}
