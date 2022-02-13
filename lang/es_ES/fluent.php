<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

// Set the path to default lang file for this route
$files = Storage::disk('lang')->files("/".basename(dirname(__FILE__))."/".config('fluent.path'));

$output = collect([]);

foreach ($files as $path) {
    $data = json_decode(Storage::disk('lang')->get($path, true));
    $routeName = basename(Str::before($path, '.json'));
    foreach($data as $key => $value){
        $output->put($routeName.'_'.$key, $value);
    }
}

return $output->toArray();
