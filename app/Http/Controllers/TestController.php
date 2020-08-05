<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KubAT\PhpSimple\HtmlDomParser;

class TestController extends Controller
{
    public function index()
    {
        $dom = HtmlDomParser::file_get_html('D:/OSPanel/domains/laravel/public/list.htm');
        $ids = '';
        foreach($dom->find('tr') as $tr){
            $spec = (trim($tr->find('td')[7]->plaintext));
            if (preg_match('/Русский язык и литература/u', $spec)){
                $id = explode('-', trim($tr->find('td')[6]->plaintext))[1];
                $ids .= $id .", ";
            }
        }
        echo $ids;
    }
}
