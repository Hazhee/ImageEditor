<?php

namespace App;

use Illuminate\Http\Request;

// Interface defining the contract for image editing strategies
interface ImageEditingStrategy
{
    // Method to process image editing based on the given request
    public function process(Request $request);
}
