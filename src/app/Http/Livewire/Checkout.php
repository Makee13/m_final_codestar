<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Checkout extends Component
{
    public $total;

    protected $listeners = ['setCartTotal'];

    public function mount()
    {
        $this->total = Auth::user()->cart->total;
    }

    public function render()
    {
        return view('livewire.checkout');
    }

    public function setCartTotal($decreasedPrice)
    {
        $this->total = $decreasedPrice;
    }
}
