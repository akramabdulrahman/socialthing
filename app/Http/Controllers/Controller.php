<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function upload_file(array $options, Request $request)
    {

        $opts = [
            'filename' => 'file',
            'prefix' => 'image'
        ];


        $opts = array_merge($opts, $options);
        $localpath = '/public/';

        if ($request->file($opts['filename'])->isValid()) {
            $name = str_random(8) . '.' . $request->file('image')->getClientOriginalExtension();
            $localpath .= (str_plural($opts['prefix']));
            $request->file($opts['prefix'])->move(
                base_path() . $localpath, $name
            );
            return (str_plural($opts['prefix'])) . '/' . $name;
        }
    }
}
