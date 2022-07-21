<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DisplayError extends Component
{
    public $nameInput;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($nameInput)
    {
        $this->nameInput = $nameInput;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.display-error');
    }
}
