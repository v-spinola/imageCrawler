<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;

class GetImages extends Controller
{

    const DEFAULT_URL = 'https://www.fifarosters.com/playerslist.php?&listlayout=cards&pageNum=1';

    public function index($url = false) {

        // dd(storage_path() );

        $images_source_url = is_string($url) ? $url : self::DEFAULT_URL;

        // dd($images_source_url);

        $number_of_images_to_process = 1;

        $dir_delimiter = date("d-m-Y_h_i_s");
        $destination_dir = storage_path() . '/app/' . $dir_delimiter . '/';
        Storage::makeDirectory($dir_delimiter);


        for ($i=0; $i < $number_of_images_to_process; $i++) { 
            
            Browsershot::url($images_source_url)
                ->hideBackground()
                ->select('.playercard-container')
                ->save($destination_dir . 'image_' . $i . '.png');

        }


        return view('images', compact('i'));

    }
}
