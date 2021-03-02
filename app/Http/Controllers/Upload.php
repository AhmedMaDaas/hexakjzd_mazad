<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class Upload extends Controller
{
    public static function upload($data = []){

    	$data['fileName'] = isset($data['fileName']) ? $data['fileName'] : time();

    	if(request()->hasFile($data['file'])){
    		Storage::has($data['deleteFile']) ? Storage::delete($data['deleteFile']) : '';
    		return request()->file($data['file'])->store($data['path']);
    	}
    	else if(is_file($data['file'])){
    		return $data['file']->store($data['path']);
    	}
        return '';
    }

    public static function deleteFile($file){
        Storage::has($file) ? Storage::delete($file) : '';
    }
}
