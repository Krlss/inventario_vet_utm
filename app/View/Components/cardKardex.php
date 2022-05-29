<?php

namespace App\View\Components;

use Illuminate\View\Component;

class cardKardex extends Component
{
    public $id;
    public $date;
    public $detail;
    public $readonly;

    public function __construct($id, $date, $detail, $readonly = null)
    {
        $this->id = $id;
        $this->date = $date;
        $this->detail = $detail;
        $this->readonly = $readonly ?? false;
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
