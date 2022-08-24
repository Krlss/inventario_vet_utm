<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Livewire\Features\Placeholder;

class inputSearch extends Component
{
    public $element;
    public $placeholder;
    public $label;

    public function __construct($element, $placeholder, $label)
    {
        $this->element = $element;
        $this->placeholder = $placeholder;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-search');
    }
}
