<?php

namespace App\View\Components;

use Illuminate\View\Component;

class cardKardex extends Component
{
    public $id;
    public $date;
    public $detail;

    public function __construct($id, $date, $detail)
    {
        $this->id = $id;
        $this->date = $date;
        $this->detail = $detail;
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
