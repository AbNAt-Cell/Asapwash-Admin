<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

// use App\User;

class AppHelper extends Controller
{
    public function paypaln(Request $request)
    {
        Log::info('This is some useful information. ' . json_encode($request->all()) . 'new Data ');

        return "done";
    }

    public function deleteFile($fileName)
    {

        if ($fileName != "default.jpg") {

            $image_path = "upload/" . $fileName;

            if (unlink("upload/" . $fileName)) {

                return true;
            } else {

                echo "No someone reach First:)";
            }
        }
    }

    public function saveImage($request)
    {

        $image = $request->file('icon');

        $input['imagename'] = uniqid() . '.' . $image->getClientOriginalExtension();

        $destinationPath = public_path('/upload');

        $image->move($destinationPath, $input['imagename']);

        return $input['imagename'];
    }

    public function getManagerBeach()
    {

        $beach = Beach::where('status', 0)->get();

        $master = array();

        foreach ($beach as $value) {

            if (in_array(Auth::user()->id, $value->manager_id)) {

                array_push($master, $value);
            }
        }

        return $master;
    }

    public function saveBase64($baseString)
    {

        $img = $baseString;

        $image_parts = explode(";base64,", $img);
        $image_type = explode("image/", $image_parts[0])[1];
        $image_data = base64_decode($image_parts[1]);

        $Iname = uniqid();
        $file_path = 'upload/' . $Iname . '.jpg'; // Change the file extension if necessary

        // Store the image
        file_put_contents(public_path($file_path), $image_data);

        return $Iname . '.jpg';
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {

        if (($lat1 == $lat2) && ($lon1 == $lon2)) {

            return 0;
        } else {

            $theta = $lon1 - $lon2;

            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));

            $dist = acos($dist);

            $dist = rad2deg($dist);

            $miles = $dist * 60 * 1.1515;

            $unit = strtoupper($unit);

            if ($unit == "K") {

                return number_format(($miles * 1.609344), 2, '.', '');
            } else if ($unit == "N") {

                return number_format(($miles * 0.8684), 2, '.', '');
            } else {

                return number_format($miles, 2, '.', '');
            }
        }
    }
}
