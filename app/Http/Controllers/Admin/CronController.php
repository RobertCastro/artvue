<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Page;
use App\Code;
use Carbon\Carbon;

class CronController extends Controller
{
    public function index()
    {
        $hoy = Carbon::now()->format('Y/m/d');

        // return $hoy;
    	$codes = Code::where('executed', '=', 0)
                        ->whereDate('cron_date', '=', $hoy)
                        ->get();
        
            foreach ($codes as $code) {
            	

    		$archivoCambiar = "ftp://".$code->page->user_ftp.":".$code->page->pass_ftp."@ftp.".$code->page->page_name."/".$code->page->link_file;

            $buscar = $code->page->current_code;

    		$nuevaCadena = $code->update_code;

    		$stream_options = array('ftp' => array('overwrite' => true));
    		$stream_context = stream_context_create($stream_options);

    		$cadena=join("",file($archivoCambiar));

    		$cadena=str_replace($buscar, $nuevaCadena, $cadena);

            
            $ejecutar = file_put_contents($archivoCambiar, $cadena, 0, $stream_context );

            if ($ejecutar) {
                print_r('exito');
            }
            else{
                print_r('error');
            }

            $id_code = $code->id;
            $disabledCode = Code::find($id_code);
            $disabledCode->executed = '1';
            $disabledCode->save();

            $updateCurrentCode = Page::find($code->page->id);
            $updateCurrentCode->current_code = $code->update_code;;
            $updateCurrentCode->save();


            return redirect()->route('admin.pages.edit', $code->page->id)->withFlash('Cron ejecutado');

        }

    }
}
