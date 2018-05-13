<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Symfony\Component\DomCrawler\Crawler;

class FrontEndController extends Controller
{
    //
    public function index()
    {
        $postsToShowCategoryAboutus=Post::where('status', 1)->where('category_id', 1)->orderBy('id', 'desc')->get();   
        $postsToShowCategoryProducts=Post::where('status', 1)->where('category_id', 2)->orderBy('id', 'desc')->get();         
        return view('welcome')->with("aboutus",$postsToShowCategoryAboutus)->with("products",$postsToShowCategoryProducts);
    }    

    //
    public function showArticle($id)
    {
        $post=Post::find($id); 
        return view('showpost')->with("post",$post);
    }
    
    
    public function sigmalive() {
 
        $html=$this->getHTML("http://www.sigmalive.com/news/local",10);

        $html=preg_replace('/\\t|\\n|[\r\n]|[\r]|[\n]/', ' ', $html); //\s
     
        $crawler = new Crawler($html);
        $arrayofElements=Array();
        $titles=$crawler->filter('.article--column')->each(function ($node) {
            if (strpos($node->text(), 'googletag.cmd.push') === false) {
                $title=trim($node->text());
            }
            else {
                $title="";
            }
            return [
                'title' => $title
            ];  

          });
          //clear empty ones
          foreach ($titles as $key=>$title) {
            $title2=preg_replace('/\\t|\\n|[\r\n]|[\r]|[\n]/', '', $title['title']); 
            $title2=preg_replace('/\s+/', ' ', $title2);             
            if (empty($title2) || strlen($title2)==0) {
                unset($titles[$key]);
            }
            else {
                $titles[$key]['title']=$title2;  
            }
          }
        $crawler = new Crawler($html);    
        $count=0;    
        $articles=Array();        
        $imagesinfo=$crawler->filter('.article--img > a')->each(function ($node,$count) {
            $arr=Array();
            $image=$node->filter('img')->attr('src');
            $link=$node->filter('a')->attr('href');     
           return [
            'link' => $link,
            'image' => $image,
        ];                
          });

          $arrayofAll=Array();
          $count=0;
          foreach ($titles as $key=>$title) {
            $array=Array();
            $array['title']=$title['title'];
            $array['link']=$imagesinfo[$count]['link'];
            $array['realimage']="http://www.sigmalive.com".$imagesinfo[$count]['image'];
            $array['image']=$imagesinfo[$count]['image'];
            $count++;
            $arrayofAll[]=$array;
          }
         // dd($arrayofAll);
          return view('sigmalive')->with("arrayofAll",$arrayofAll);
    }



       /**
* Returns an array representation of a DOMNode
* Note, make sure to use the LIBXML_NOBLANKS flag when loading XML into the DOMDocument
* @param DOMDocument $dom
* @param DOMNode $node
* @return array
*/
private    function nodeToArray( $dom, $node) {
   if(!is_a( $dom, 'DOMDocument' ) || !is_a( $node, 'DOMNode' )) {
       return false;
   }
   $array = false;
   if( empty( trim( $node->localName ))) {// Discard empty nodes
       return false;
   }
   if( XML_TEXT_NODE == $node->nodeType ) {
       return $node->nodeValue;
   }
   foreach ($node->attributes as $attr) {
       $array['@'.$attr->localName] = $attr->nodeValue;
   }
   foreach ($node->childNodes as $childNode) {
       if ( 1 == $childNode->childNodes->length && XML_TEXT_NODE == $childNode->firstChild->nodeType ) {
           $array[$childNode->localName] = $childNode->nodeValue;
       }  else {
           if( false !== ($a = self::nodeToArray( $dom, $childNode))) {
               $array[$childNode->localName] =     $a;
           }
       }
   }
   return $array;
}

 private function getHTML($url,$timeout)
{
       $ch = curl_init($url); // initialize curl with given url
       curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]); // set  useragent
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // write the response to a variable
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects if any
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); // max. seconds to execute
       curl_setopt($ch, CURLOPT_FAILONERROR, 1); // stop when it encounters an error
       return @curl_exec($ch);
}

}
