<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        //Redis::del('second_section:texts');

        return view('page', [
            'texts' => $this->sortByPosition(json_decode(Redis::get('second_section:texts'), true), true)
        ]);
    }

    public function saveText(Request $request)
    {
        $request->validate([
           'text' => 'required'
        ]);

        $text = strip_tags($request->text); //some sanitization

        $texts = Redis::get('second_section:texts');

        if($texts == null) {
            Redis::set('second_section:texts', json_encode([['content' => $text, 'position' => 0]]));
        }
        else {
            $texts = json_decode($texts, true);

            $lastPosition = $this->sortByPosition($texts, false)[0]['position'];

            $texts[] = ['content' => $text, 'position' => $lastPosition + 1];

            Redis::set('second_section:texts', json_encode($texts));
        }

        return response('', 200)
            ->header('Content-Type', 'application/json');
    }

    private function sortByPosition(?array $texts, bool $asc)
    {
        if(!$texts) {
            return [];
        }

        if($asc) {
            usort($texts, function($a, $b) {
                return ($a['position'] > $b['position']) ? 1 : -1;
            });
        }
        else {
            usort($texts, function($a, $b) {
                return ($a['position'] < $b['position']) ? 1 : -1;
            });
        }

        return $texts;
    }
}
