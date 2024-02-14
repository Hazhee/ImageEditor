<?php

namespace App;

use Illuminate\Http\Request;

interface ImageEditingStrategy
{
    public function process(Request $request);
}
