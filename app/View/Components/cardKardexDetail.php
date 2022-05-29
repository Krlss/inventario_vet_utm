<?php

namespace App\View\Components;

use Illuminate\View\Component;

class cardKardexDetail extends Component
{
    public $label;
    public $value;
    public $class;
    public $full;
    public $two;

    public $date;
    public $readonly;
    public $autofocus;

    public function __construct($label, $value, $class = null, $full = null, $two = null, $date = null, $readonly = null, $autofocus = null)
    {
        $this->label = $label;
        $this->value = $value;
        $this->class = $class ?? '';
        $this->full = $full ?? false;
        $this->two = $two ?? false;
        $this->date = $date ?? false;
        $this->readonly = $readonly ?? false;
        $this->autofocus = $autofocus ?? false;
    }

    public function render()
    {
        return view('components.card-kardex-detail');
    }
}
