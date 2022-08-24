<?php

namespace App\View\Components;

use Illuminate\View\Component;

class tabs extends Component
{

    public $routeTo;
    public $routeCurrent;
    public $title;

    public function __construct($routeTo, $routeCurrent, $title)
    {
        $this->routeTo = $routeTo;
        $this->routeCurrent = $routeCurrent;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.tabs');
    }
}
