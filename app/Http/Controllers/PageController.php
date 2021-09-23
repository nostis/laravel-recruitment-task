<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('page', [
            'text' => Redis::get('second_section:texts')
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

            $lastPosition = $this->getLastPosition($texts);

            $texts[] = ['content' => $text, 'position' => $lastPosition + 1];

            Redis::set('second_section:texts', json_encode($texts));
        }

        return response('', 200)
            ->header('Content-Type', 'application/json');
    }

    private function getLastPosition(array $texts): int
    {
        if(count($texts)) {
            usort($texts, function($a, $b) {
                return ($a['position'] < $b['position']) ? 1 : -1;
            });

            return $texts[0]['position'];
        }

        return 0;
    }
}
