<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PDF;
use \DataTables;
use Illuminate\Support\Facades\Redirect;
use PDFMerger;

class IndexController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $search_query = $request->q;
        
        $base_url = 'https://www.jugantor.com/';
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', $base_url);
        $links = $crawler->selectLink($search_query)->links();
        $data = array();
        $url = array();
        foreach ($links as $key=>$link) {
            $url_link = $link->getUri();
            if(isset($url) and in_array($url_link, $url)){
                continue;
            }
            $crawler = $client->click($link);
            $data[] = $crawler->filter('h1,.dtl_img_section p,.dtl_img_section img')->each(function ($node) use ($base_url) {
                
                

                if ($node->getNode(0)->nodeName == 'img') {
                    $data['image'] = '<img src="' . $base_url . $node->getNode(0)->getAttribute('src') . "\" />";
                }elseif($node->getNode(0)->nodeName == 'h1'){
                 $data['h1'] = '<h1>'.$node->text().'</h1>';
                }else{
                    $data['text'] = $node->text();
                }
                return $data;
            });
            
             $url[$key] = $url_link;
        }
        
        return view('paper_view', compact('data',$url));
    }
    public function search(){
       return view('search'); 
    }
    
    public function collectNews(){
        $newspaper = \App\Model\Newspaper::all();
        $meta = array(
            'title'=>'MOFA || Collect News',
            'active_page'=>'collect_news'
        );
       return view('news.collect_news', compact('newspaper','meta'));  
    }
    public function NewsCollect(Request $request){
        $tags = explode(',', $request->related_keyword);
        
         $session_data = Session::get('login_detail');
        $newspaper = \App\Model\Newspaper::find($request->newspaper);
        if($newspaper){
            
        
        $base_url = $request->newspaper;
        $url = $request->url;
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', $url);
         $data[] = $crawler->filter($newspaper->dom_element)->each(function ($node) use ($newspaper) {
                if ($node->getNode(0)->nodeName == 'img') {
                    $data['image'] = '<img src="'.$newspaper->image_base_url. $node->getNode(0)->getAttribute('src') . "\" />";
                }elseif($node->getNode(0)->nodeName == 'h1'){
                 $data['headline'] = '<h1>'.$node->text().'</h1>';
                }elseif($node->getNode(0)->nodeName == 'h2'){
                 $data['headline'] = '<h2>'.$node->text().'</h2>';
                }elseif($node->getNode(0)->nodeName == 'h3'){
                 $data['headline'] = '<h3>'.$node->text().'</h3>';
                }elseif($node->getNode(0)->nodeName == 'h4'){
                 $data['headline'] = '<h4>'.$node->text().'</h4>';
                }elseif($node->getNode(0)->nodeName == 'h5'){
                 $data['headline1'] = '<h5>'.$node->text().'</h5>';
                }else{
                    $data['text'] = $node->text();
                }
                return $data;
            });
            $text = '';
            $image = '';
            $headline = '';
            $spechial_comment = '';
             $i= 0;
             $h = 0;
            foreach ($data as $datam) {
                foreach ($datam as $value) {
                    if (isset($value['image'])) {
                        $image .= $value['image'];
                    } elseif (isset($value['headline'])) {
                        if ($h == 0) {
                            $headline .=$value['headline'];
                            $h++;
                        }
                    } elseif (isset($value['headline1'])) {
                        $spechial_comment .= $value['headline1'];
                    } else {
                        $text .=$value['text'];
                    }
                    $i++;
                }
            }
            
            $news = new \App\Model\News();

            $data['data'] = $data;
            $data['paper_name'] = $newspaper->name;
            $pdf = PDF::loadView('paper_view', $data);
            $file_name = time().'.pdf';
            
            $pdf->save(storage_path('upload').'/' . $file_name);
             
            
            $news->headline = $headline;
            $news->spechial_news = $spechial_comment;
            $news->news_description = $text;
            $news->image_link  = $image;
            $news->news_url  = $url;
            $news->collected_by = $session_data['login_id'];
            $news->news_date = date('Y-m-d');
            $news->pdf_file = $file_name;
             $news->newspaper_id = $newspaper->id;
              $news->newspaper_name = $newspaper->name;
            if($news->save()){
                foreach ($tags as $tag){
                    $newstag = new \App\NewsTag();
                    $newstag->tag_name = $tag;
                    $newstag->news_id = $news->id;
                    $newstag->save();
                }
                return redirect(url('news-list'))
                 ->with('success', 'Collected Successfully');
            }
            
       
       }else{
           return redirect()->back()
            ->with('error', 'No Data Found');
       }
            
    }
    
    public function NewsList(){
         $meta = array(
            'title'=>'MOFA || News List',
            'active_page'=>'news_list'
        );
         return view('news.news_list',  compact('meta'));
    }
    
    public function searchNews(){
        $meta = array(
            'title'=>'MOFA || Search News',
            'active_page'=>'search-news'
        );
         return view('news.search-news',  compact('meta'));
    }
    
    public function searchByTag(Request $request){
        $searchTerm = $request->term;
        $tags = \App\NewsTag::where('tag_name', 'LIKE', "%{$searchTerm}%")->get();
        $newslist = array();
        foreach($tags as $tag){
            $news_detail = \App\Model\News::find($tag->id);
            $newslist[] = array(
                'id'=>$news_detail->id,
                'label'=>  strip_tags($news_detail->headline),
                'value'=>strip_tags($news_detail->headline),
            );
        }
        return json_encode($newslist);
    }

        public function newsAjaxList(Request $request){
            if($request->id){
                $newslist = \App\Model\News::where('id',$request->id)->get();
            }else{
                $newslist = \App\Model\News::all();
            }
         
        return Datatables::of($newslist)
                        ->addColumn('pdf_file', function($value) {
                            $action = '<a href="' . url('storage/upload/', $value->pdf_file) . '" class="btn btn-primary" target="__blank">View Details</a>';

                            return $action;
                        })
                        ->addColumn('headline', function($value) {
                            $headline = strip_tags($value->headline);

                            return $headline;
                        })
                        ->addColumn('checkbox',function($value){
                            $checkbox = '<input type="checkbox" class="check_id" name="pdf_id[]" value="'.$value->id.'">';
                            return $checkbox;                    
                        })
                        ->rawColumns(['headline','pdf_file','checkbox'])
                        ->make(true);
    }

   public function makePdf(Request $request){
        $news_id = $request->check_all;
        $ids = explode('_', $news_id);
        $merger = PDFMerger::init();
        foreach ($ids as $key => $value) {
            $news[] =$news_details = \App\Model\News::find($value);
            $merger->addPathToPDF(storage_path('upload').'/' .$news_details->pdf_file, 'all', 'P');
        }
        $merger->merge();
        $file   = time().'merged.pdf';
        $merger->save(storage_path('upload').'/'.$file);

            $return_array = array(
                'status'=>200,
                'download_url' =>'upload'.'/' . $file
            );
            return json_encode($return_array);
    }
    
    public function newsSearchList(Request $request){
        $newslist = \App\Model\News::where('id',$request->id)->get();
        return Datatables::of($newslist)
                        ->addColumn('pdf_file', function($value) {
                            $action = '<a href="' . url('storage/upload/', $value->pdf_file) . '" class="btn btn-primary" target="__blank">View Details</a>';

                            return $action;
                        })
                        ->addColumn('headline', function($value) {
                            $headline = strip_tags($value->headline);

                            return $headline;
                        })
                        ->addColumn('checkbox',function($value){
                            $checkbox = '<input type="checkbox" class="check_id" name="pdf_id[]" value="'.$value->id.'">';
                            return $checkbox;                    
                        })
                        ->rawColumns(['headline','pdf_file','checkbox'])
                        ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
