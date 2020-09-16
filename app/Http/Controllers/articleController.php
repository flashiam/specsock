<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use View;
use DB;


class articleController extends Controller
{
    public function index(){
        //dd('index');
        //$metas = DB::table('articleMetaTags')->get()->all();
        $arts = (Storage::disk('do_spaces')->files('/Assets/NCERT/Class-11'))[0];
        $url = 'https://specsbucket.sgp1.digitaloceanspaces.com/';
        //dd($url.$arts);
        //$articles = DB::table('articles_tables')->get()->all();
        
        //dd($metas);
        
        
        
        $article=['EDU102', 'EDU105', 'EDU103'];
        $window = 'articles';
        return View::make('articles', compact('article'))->with('window', $window)->with('arts', $url.$arts)->with('data', True);
        //return $arts;
    }

    public function save_article(Request $request){
        $tst = DB::table('articleMetaTags')->select()->get();
        //dd($tst);
        $data = $request->all();
       // $myfile = fopen(asset('newfile.txt'), "w");
       $d = DB::table('articleMetaTags')->get()->all();
       //dd($d);
        //dd($myfile);
        //dd($data);
        $file = $data['content'];
        $myfile = fopen("new.html", "w");
        $check = file_put_contents("new.html", $file);

        $artno = DB::table('articles_tables')->select('article_id')->count() + 1 + 100;
        $pre = strtoupper(substr($data['category'], 0, 3));
        
        $check = Storage::disk('do_spaces')->exists('Articles'.'/'.$data['category'].'/'.$data['topic']);
        //dd($check);
        if(!$check){
            Storage::disk('do_spaces')->makeDirectory('Articles'.'/'.$data['category'].'/'.$data['topic']);
            if(!Storage::disk('do_spaces')->exists('Articles'.'/'.$data['category'].'/'.$data['topic'].'/'.$data['subtopic'].'.txt')){
            Storage::disk('do_spaces')->put('Articles'.'/'.$data['category'].'/'.$data['topic'].'/'.$data['subtopic'].'.txt', $file);
            $loc = Storage::disk('do_spaces')->path('Articles'.'/'.$data['category'].'/'.$data['topic'].'/'.$data['subtopic'].'.txt');
            }else{
             dd('fuck off');
            }
        }else{
           if(!Storage::disk('do_spaces')->exists('Articles'.'/'.$data['category'].'/'.$data['topic'].'/'.$data['subtopic'].'.txt')){
           Storage::disk('do_spaces')->put('Articles'.'/'.$data['category'].'/'.$data['topic'].'/'.$data['subtopic'].'.txt', $file);
           $loc = Storage::disk('do_spaces')->path('Articles'.'/'.$data['category'].'/'.$data['topic'].'/'.$data['subtopic'].'.txt');
           }else{
            dd('fuck off');
           }
        }

        for($i=0; $i<=count($data['meta'])-1; $i++){
            if($data['prop'][$i] == "property"){
                $type = 'pro';
                $content = $data['myInputs'][$i];
                $name = $data['meta'][$i];
                $art = $pre.$artno;

                DB::table('articleMetaTags')->insert(['art_id' => $art, 'm_nam_or_m_pro' => $type, 'content' => $content, 'meta_name_or_prop' => $name, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            }else{
                $type = 'nam';
                $content = $data['myInputs'][$i];
                $name = $data['meta'][$i];
                $art = $pre.$artno;

                DB::table('articleMetaTags')->insert(['art_id' => $art, 'm_nam_or_m_pro' => $type, 'content' => $content, 'meta_name_or_prop' => $name, 'created_at' => date('Y-m-d H:i:s'),  'updated_at' => date('Y-m-d H:i:s')]);
            }

            if(isset($data['priority'])){
                $prior = $data['priority'];
            }else{
                $prior = 0;
            }

            if(isset($data['asso'])){
                $asso  = $data['asso'];
            }else{
                $asso = "EDU101";
            }

            if(isset($data['exturl'])){
                $exurl  = $data['exturl'];
            }else{
                $exurl = "http://http://159.89.165.193/";
            }
            DB::table('articles_tables')->insert(['article_id'=>$pre.$artno, 'category' => $data['category'], 'on_page' => 'Discussions',  'priority' => $prior, 'asso_art_id' => $asso, 'file_loc' => $loc, 'external_urls' => $exurl, 'created_on' => date('Y-m-d H:i:s'), 'updated_on' => date('Y-m-d H:i:s')]);
            
            
        }

        dd('chill');
        //$content = Storage::disk('do_spaces')->get('Articles'.'/'.$data['category'].'/'.$data['topic'].'/'.$data['subtopic'].'.txt');
        //dd($loc);
    }
}
