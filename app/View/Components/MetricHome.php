<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MetricHome extends Component
{
    
    public $title;
    public $value;

    public function __construct($title, $value)
    {
        $this->title = $title;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.metric-home');
    }
}
