<?php
namespace App;

use Illuminate\Http\Request;

class ImageEditingContext
{
    private $strategy;

    public function setStrategy(ImageEditingStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy(Request $request)
    {
        return $this->strategy->process($request);
    }
}
