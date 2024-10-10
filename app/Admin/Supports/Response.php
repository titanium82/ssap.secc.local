<?php

namespace App\Admin\Supports;

trait Response
{
    public function backSuccessInput(string $msg = '')
    {
        return $this->back($msg, true);
    }

    public function backSuccess(string $msg = '')
    {
        if($msg == '')
        {
            $msg = trans('notifySuccess');
        }
        
        return $this->back($msg);
    }

    public function backErrorInput(string $msg = '')
    {
        if($msg == '')
        {
            $msg = trans('notifyFail');
        }
        return $this->back($msg, true, 'error');
    }

    public function backErrorAjax(\Throwable $th)
    {
        if(request()->ajax())
        {
            throw $th;
        }
        
        return $this->backError($th->getMessage());
    }

    public function backError(string $msg = '')
    {
        if($msg == '')
        {
            $msg = trans('notifyFail');
        }

        return $this->back($msg, false, 'error');
    }

    public function back(string $msg = '', bool $input = false, string $typeMsg = 'success')
    {
        $response = back();

        if($input)
        {
            $response = $response->withInput();
        }

        return $response->with($typeMsg, $msg);
    }
}