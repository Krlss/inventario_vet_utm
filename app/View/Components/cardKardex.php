<?php

namespace App\View\Components;

use Illuminate\View\Component;

class cardKardex extends Component
{
    public $id;
    public $readonly;
    public $kardex;

    public function __construct($id, $readonly, $kardex)
    {
        $this->id = $id;
        $this->readonly = $readonly;
        $this->kardex = $kardex;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card-kardex');
    }
}
