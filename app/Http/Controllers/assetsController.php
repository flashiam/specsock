<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Arr;
use View;
use Response;

class assetsController extends Controller
{
    
    public function index(){
        //dd($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        $window = "assets";
        $loc = 'Assets'.'/'.null;

        //$loc = 'Assets'.'/'.$dir.'/'.$sdir.'/'.$s1dir;
    //dd($loc);
    $show = $this->showFiles($loc);
//dd($show);
    if($show){
        
        $file = Storage::disk('do_spaces')->get($loc);
    

    $pdfContent = Storage::disk('do_spaces')->get($loc);

    // for pdf, it will be 'application/pdf'
    $type       = Storage::disk('do_spaces')->mimeType($loc);
    //$fileName   = Storage::disk('do_spaces')->name($loc);

    return Response::make($pdfContent, 200, [
      'Content-Type'        => $type,
      'Content-Disposition' => 'inline; filename="'.'mypdf'.'"'
    ]);
    }else{
        $Loc = null;
        $vals = $this->openDir($Loc);
        //dd($vals);
        $asset = $vals[0];
        $dir = $vals[1];
        $files = $vals[2];
        $exist = $vals[3];
        //dd($dir);
        //$dir = substr($dir, 0, -2);
        //dd($dir);
        return View::make('assets', compact('asset', 'files'))->with('window', $window)->with('dir', $dir)->with('exist', $exist);
    }
    }

    public function openDir($loc){
       // dd('Assets/'.$loc.'/');
        //dd($loc);
        $disk = Storage::disk('do_spaces')->directories('Assets/'.$loc.'/');
        //dd($disk);
        $file = Storage::disk('do_spaces')->files('Assets/'.$loc.'/');
        //dd($disk);
        if($disk != []){
        for($i=0; $i<=count($disk)-1; $i++){
            $asset[] = substr($disk[$i], strlen($loc)+6);
        }
        if($file != []){
            for($i=0; $i<=count($file)-1; $i++){
                $files[] = substr($file[$i], strlen($loc)+6);
            }
            $files = array_chunk($files, 3);
        }else{
            $files =array(array(null));
        }
        $asset = array_chunk($asset, 3);
        //dd($files, $asset);
        //$files = array_chunk($files, 3);
        //$dir = 'Assets/'.$loc.'/';
        //dd($dir);
        if($loc == null){
        $dir = Storage::disk('do_spaces')->path('Assets'.$loc);
        }else{
            $dir = Storage::disk('do_spaces')->path('Assets/'.$loc);
        }
        $exist = true;
        return array($asset, $dir, $files, $exist);
        }elseif($file != []){
            for($i=0; $i<=count($file)-1; $i++){
                $files[] = substr($file[$i], strlen($loc)+6);
            }
       
        $dir = 'Assets/'.$loc;
        $asset = array(array(null));
        //dd($dir);
        $exist = true;
        return array($asset, $dir, $files, $exist);

        }else{
        $exist = false;
        $dir = 'Assets/'.$loc;
        return array(null, $dir, null, $exist);       
        }
        
    }

    public function showDir($dir){
        //dd($dir);
        $data['dir'] = $dir;
        //dd($dir);
        $window = "assets";
        $loc = 'Assets'.'/'.$dir;

        //$loc = 'Assets'.'/'.$dir.'/'.$sdir.'/'.$s1dir;
    //dd($loc);
    $show = $this->showFiles($loc);
//dd($show);
    if($show){
        
        $file = Storage::disk('do_spaces')->get($loc);
    

    $pdfContent = Storage::disk('do_spaces')->get($loc);

    // for pdf, it will be 'application/pdf'
    $type       = Storage::disk('do_spaces')->mimeType($loc);
    //$fileName   = Storage::disk('do_spaces')->name($loc);

    return Response::make($pdfContent, 200, [
      'Content-Type'        => $type,
      'Content-Disposition' => 'inline; filename="'.'mypdf'.'"'
    ]);
    }else{
    $Loc = $dir;

        $vals = $this->openDir($Loc);
        //dd($vals);

        $asset = $vals[0];
        $dirs = $vals[1];
        //dd($dirs);
        
        //dd($files);
        $exist = $vals[3];
        //$dirs = substr($dirs, 0, -1);
        //dd($asset);
        if($asset != []){
        $ass = Arr::flatten($asset);
        //dd(str_split($ass[0], 1));
        $asset = [];
        for($i=0; $i<=count($ass)-1; $i++){
            $k = str_split($ass[$i], 1);
            //dd($k);
            $sl = array_slice($k, array_search('/',$k));
            //unset($sl[0]);
            //dd($sl);
            $asset[] = implode($sl);
        }
        $asset = array_chunk($asset, 3);
        }else{
            $asset = array(array(null));
        }

        $files = $vals[2];

        if($files != []){
            $fly = Arr::flatten($files);
            $files = [];
            //dd($fly);
            for($i=0; $i<=count($fly)-1; $i++){
                $k = str_split($fly[$i], 1);
                //dd($k);
                $sl = array_slice($k, array_search('/',$k));
                //unset($sl[0]);
                //dd($sl);
                $files[] = implode($sl);
            }
            //dd($files);
            $files = array_chunk($files, 3);
            }else{
        
                $files = array(array(null));
            }

    
        //dd($asset);
        return View::make('assets', compact('asset', 'files'))->with('window', $window)->with('dir', $dirs)->with('exist', $exist);
        }

    }

public function showdirDir($dir, $sdir){
    
    $data['dir'] = $dir;
    $data['sdir'] = $sdir;
    //dd($dir, $sdir);
    $window = "assets";
    $loc = 'Assets'.'/'.$dir.'/'.$sdir;

    //$loc = 'Assets'.'/'.$dir.'/'.$sdir.'/'.$s1dir;
    //dd($loc);
    $show = $this->showFiles($loc);
//dd($show);
    if($show){
        
        $file = Storage::disk('do_spaces')->get($loc);
    

    $pdfContent = Storage::disk('do_spaces')->get($loc);

    // for pdf, it will be 'application/pdf'
    $type       = Storage::disk('do_spaces')->mimeType($loc);
    //$fileName   = Storage::disk('do_spaces')->name($loc);

    return Response::make($pdfContent, 200, [
      'Content-Type'        => $type,
      'Content-Disposition' => 'inline; filename="'.'mypdf'.'"'
    ]);
    }else{
    $Loc = $dir.'/'.$sdir;
    
    $vals = $this->openDir($Loc);
    //dd($vals);

    $asset = $vals[0];
    $dirs = $vals[1];
    //dd($dirs);
    $files = $vals[2];
    $exist = $vals[3];
    //$dirs = substr($dirs, 0, -1);
    //dd($files);
    if($asset != []){
    $ass = Arr::flatten($asset);
    //dd(str_split($ass[0], 1));
    $asset = [];
    for($i=0; $i<=count($ass)-1; $i++){
        $k = str_split($ass[$i], 1);
        //dd($k);
        $sl = array_slice($k, array_search('/',$k));
        //unset($sl[0]);
        //dd($sl);
        $asset[] = implode($sl);
    }
    $asset = array_chunk($asset, 3);
}else{
    $asset = array(array(null));
}

    if($files != []){
    $fly = Arr::flatten($files);
    $files = [];
    //dd($fly);
    for($i=0; $i<=count($fly)-1; $i++){
        $k = str_split($fly[$i], 1);
        //dd($k);
        $sl = array_slice($k, array_search('/',$k));
        //unset($sl[0]);
        //dd($sl);
        $files[] = implode($sl);
    }
    //dd($files);
    $files = array_chunk($files, 3);
    }else{

        $files = array(array(null));
    }
    //dd($files);
    return View::make('assets', compact('asset', 'files'))->with('window', $window)->with('dir', $dirs)->with('exist', $exist);
}

}

public function showdirdirDir($dir, $sdir, $s1dir){

    $data['dir'] = $dir;
    $data['sdir'] = $sdir;
    $data['s1dir'] = $s1dir;
    //dd($dir, $sdir);
    $window = "assets";
    $loc = 'Assets'.'/'.$dir.'/'.$sdir.'/'.$s1dir;
    //dd($loc);
    $show = $this->showFiles($loc);
//dd($show);
    if($show){
        
        $file = Storage::disk('do_spaces')->get($loc);
    

    $pdfContent = Storage::disk('do_spaces')->get($loc);

    // for pdf, it will be 'application/pdf'
    $type       = Storage::disk('do_spaces')->mimeType($loc);
    //$fileName   = Storage::disk('do_spaces')->name($loc);

    return Response::make($pdfContent, 200, [
      'Content-Type'        => $type,
      'Content-Disposition' => 'inline; filename="'.'mypdf'.'"'
    ]);
    }else{
    $Loc = $dir.'/'.$sdir.'/'.$s1dir;
    //dd($Loc);
    $vals = $this->openDir($Loc);
    // /dd($vals);

    $asset = $vals[0];
    $dirs = $vals[1];
    //dd($asset);
    $files = $vals[2];
    $exist = $vals[3];
    //$dirs = substr($dirs, 0, -1);
    //dd($files);
    if($asset != []){
    $ass = Arr::flatten($asset);
    //dd(str_split($ass[0], 1));
    $asset = [];
    for($i=0; $i<=count($ass)-1; $i++){
        $k = str_split($ass[$i], 1);
        //dd($k);
        $sl = array_slice($k, array_search('/',$k));
        //unset($sl[0]);
        //dd($sl);
        $asset[] = implode($sl);
    }
    $asset = array_chunk($asset, 3);
    }else{
        $asset = array(array(null));
    }

    if($files != []){
    $fly = Arr::flatten($files);
    $files = [];
    //dd($fly);
    for($i=0; $i<=count($fly)-1; $i++){
        $k = str_split($fly[$i], 1);
        //dd($k);
        $sl = array_slice($k, array_search('/',$k));
        //unset($sl[0]);
        //dd($sl);
        $files[] = implode($sl);
    }
    //dd($files);
    $files = array_chunk($files, 3);
    }else{
        $files=array(array(null));
    }
    //dd($files);
    return View::make('assets', compact('asset', 'files'))->with('window', $window)->with('dir', $dirs)->with('exist', $exist);
    }



}

public function showFiles($string){
    $c = str_split($string, 1);
    $check = in_array('.', $c);
    //dd($check);
    return $check;
}

public function showdirdirdirDir($dir, $sdir, $s1dir, $s2dir){
    $data['dir'] = $dir;
    $data['sdir'] = $sdir;
    $data['s1dir'] = $s1dir;
    $data['s2dir'] = $s2dir;
    //dd($dir, $sdir);
    $window = "assets";
    $loc = 'Assets'.'/'.$dir.'/'.$sdir.'/'.$s1dir.'/'.$s2dir;
    //dd($loc);
    $show = $this->showFiles($loc);
//dd($show);
    if($show){
        
        $file = Storage::disk('do_spaces')->get($loc);
    

    $pdfContent = Storage::disk('do_spaces')->get($loc);

    // for pdf, it will be 'application/pdf'
    $type       = Storage::disk('do_spaces')->mimeType($loc);
    //$fileName   = Storage::disk('do_spaces')->name($loc);

    return Response::make($pdfContent, 200, [
      'Content-Type'        => $type,
      'Content-Disposition' => 'inline; filename="'.'mypdf'.'"'
    ]);
    }else{
    $Loc = $dir.'/'.$sdir.'/'.$s1dir.'/'.$s2dir;
    //dd($Loc);
    $vals = $this->openDir($Loc);
    // /dd($vals);

    $asset = $vals[0];
    $dirs = $vals[1];
    //dd($asset);
    $files = $vals[2];
    $exist = $vals[3];
    //$dirs = substr($dirs, 0, -1);
    //dd($dirs);
    if($asset != []){
    $ass = Arr::flatten($asset);
    //dd(str_split($ass[0], 1));
    $asset = [];
    for($i=0; $i<=count($ass)-1; $i++){
        $k = str_split($ass[$i], 1);
        //dd($k);
        $sl = array_slice($k, array_search('/',$k));
        //unset($sl[0]);
        //dd($sl);
        $asset[] = implode($sl);
    }
    $asset = array_chunk($asset, 3);
    }else{
        $asset = array(array(null));
    }

    if($files != []){
    $fly = Arr::flatten($files);
    $files = [];
    //dd($fly);
    for($i=0; $i<=count($fly)-1; $i++){
        $k = str_split($fly[$i], 1);
        //dd($k);
        $sl = array_slice($k, array_search('/',$k));
        //unset($sl[0]);
        //dd($sl);
        $files[] = implode($sl);
    }
    //dd($files);
    $files = array_chunk($files, 3);
    }else{
        $files=array(array(null));
    }
    //dd($files);
    return View::make('assets', compact('asset', 'files'))->with('window', $window)->with('dir', $dirs)->with('exist', $exist);
    }


}

public function showdirdirdirdirDir($dir, $sdir, $s1dir, $s2dir, $s3dir){

    $data['dir'] = $dir;
    $data['sdir'] = $sdir;
    $data['s1dir'] = $s1dir;
    $data['s2dir'] = $s2dir;
    $data['s3dir'] = $s3dir;
    //dd($dir, $sdir);
    $window = "assets";
    $loc = 'Assets'.'/'.$dir.'/'.$sdir.'/'.$s1dir.'/'.$s2dir.'/'.$s3dir;
    //dd($loc);
    $show = $this->showFiles($loc);
//dd($show);
    if($show){
        
        $file = Storage::disk('do_spaces')->get($loc);
    

    $pdfContent = Storage::disk('do_spaces')->get($loc);

    // for pdf, it will be 'application/pdf'
    $type       = Storage::disk('do_spaces')->mimeType($loc);
    //$fileName   = Storage::disk('do_spaces')->name($loc);

    return Response::make($pdfContent, 200, [
      'Content-Type'        => $type,
      'Content-Disposition' => 'inline; filename="'.'mypdf'.'"'
    ]);
    }else{
    $Loc = $dir.'/'.$sdir.'/'.$s1dir.'/'.$s2dir.'/'.$s3dir;
    //dd($Loc);
    $vals = $this->openDir($Loc);
    // /dd($vals);

    $asset = $vals[0];
    $dirs = $vals[1];
    //dd($asset);
    $files = $vals[2];
    $exist = $vals[3];
    //dd($dirs);
    $dirs = substr($dirs, 0, -1);
    //dd($files);
    if($asset != []){
    $ass = Arr::flatten($asset);
    //dd(str_split($ass[0], 1));
    $asset = [];
    for($i=0; $i<=count($ass)-1; $i++){
        $k = str_split($ass[$i], 1);
        //dd($k);
        $sl = array_slice($k, array_search('/',$k));
        //unset($sl[0]);
        //dd($sl);
        $asset[] = implode($sl);
    }
    $asset = array_chunk($asset, 3);
    }else{
        $asset = array(array(null));
    }

    if($files != []){
    $fly = Arr::flatten($files);
    $files = [];
    //dd($fly);
    for($i=0; $i<=count($fly)-1; $i++){
        $k = str_split($fly[$i], 1);
        //dd($k);
        $sl = array_slice($k, array_search('/',$k));
        //unset($sl[0]);
        //dd($sl);
        $files[] = implode($sl);
    }
    //dd($files);
    $files = array_chunk($files, 3);
    }else{
        $files=array(array(null));
    }
    //dd($files);
    return View::make('assets', compact('asset', 'files'))->with('window', $window)->with('dir', $dirs)->with('exist', $exist);
    }
}
}
