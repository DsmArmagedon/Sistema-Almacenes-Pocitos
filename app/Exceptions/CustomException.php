<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    public function report()
    {
        // 
    }

    public function render($request) 
    {
        if($request->ajax())
        {
            return response()->json(['error'=>$this->getMessage()],$this->getCode());
        }
        return back()->with('errorCustom',$this->getMessage())->withInput();
    }
}
