<?php

namespace App\View\Components;

use Illuminate\View\Component;

class buttonAddModal extends Component
{
    public $target;

    public function __construct($target)
    {
        $this->target = $target;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-add-modal');
    }
}
