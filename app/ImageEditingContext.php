<?php
namespace App;

use Illuminate\Http\Request;

class ImageEditingContext
{
    // The strategy to be used for image editing
    private $strategy;

    // Set the strategy for the context
    public function setStrategy(ImageEditingStrategy $strategy)
    {
        $this->strategy = $strategy;
    }
    
    // Execute the image editing strategy based on the given request
    public function executeStrategy(Request $request)
    {
        // Delegate the image processing to the assigned strategy
        return $this->strategy->process($request);
    }
}
