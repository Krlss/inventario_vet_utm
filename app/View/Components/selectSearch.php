<?php

namespace App\View\Components;

use Illuminate\View\Component;

class selectSearch extends Component
{
    public $label;
    public $optionDefault;
    public $array;
    public $element;


    public function __construct($label, $optionDefault, $array, $element)
    {
        $this->label = $label;
        $this->optionDefault = $optionDefault;
        $this->array = $array;
        $this->element = $element;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-search');
    }
}
