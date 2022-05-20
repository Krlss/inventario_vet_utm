<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LinkModule extends Component
{

    public $name;
    public $desc;
    public $route;

    public function __construct($name, $desc, $route)
    {
        $this->name = $name;
        $this->desc = $desc;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.link-module');
    }
}
