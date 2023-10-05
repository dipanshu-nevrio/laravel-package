<?php

namespace Test\Jouren\Controller;

use App\Http\Controllers\Controller;
use App\Http\Resources\JourenCollection;
use App\Http\Resources\JourenResource;
use App\Models\Jouren;

class JourenController extends Controller
{
    public function index()
    {
        $jouren = Jouren::get();
        return new JourenCollection($jouren);
    }

    public function show(string $id)
    {
        $jouren = Jouren::findorfail($id);
        return new JourenResource($jouren);
    }

}
