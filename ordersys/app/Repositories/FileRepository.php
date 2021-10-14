<?php
namespace App\Repositories;

use Storage;
use Carbon\Carbon;
class FileRepository
{
	public static function move($file,$public=false){
		try{
			$originan_name = $file->getClientOriginalName();
			$file_type = $file->getClientMimeType();
			$file_size = $file->getSize();
			$arr = explode('.',$originan_name);
			$ext = $arr[count($arr)-1];
			$file_name = str_slug(str_replace($ext,'',$originan_name)).'.'.$ext;
			if($public){
				$pre = 'public';
			}else{
				$pre = '';
			}
			$path = '/uploads/'.Carbon::now()->format('Y/m/d');
			$new_path = $pre.$path;
			$new_name = $file_name;
			Storage::putFileAs($new_path,$file,$new_name);
			$pre = 'app';
			if($public)
				$pre = 'storage';
			return [
				'file_name'=>$originan_name,
				'file_size'=>$file_size,
				'path'=>$pre."/".$new_path.'/'.$new_name,
				'file_type'=>$file_type,
				'uploaded'=>true
			];
		}catch(\Exception $e){
			return [
				'uploaded'=>false,
				'error'=>$e->getMessage()
			];
		}
	}
}
