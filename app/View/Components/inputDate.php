<?php

namespace App\View\Components;

use Illuminate\View\Component;

class inputDate extends Component
{
    public $max_date;

    public $label;
    public $element;

    public function __construct($label, $element)
    {
        $this->max_date = date('Y-m-d');
        $this->label = $label;
        $this->element = $element;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-date');
    }
}
