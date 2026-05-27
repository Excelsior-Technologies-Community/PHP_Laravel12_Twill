<?php

namespace App\View\Components;

use A17\Twill\Models\Menu as TwillMenu;  // Alias to avoid conflict with component name
use Illuminate\View\Component;

class Menu extends Component
{
    public $location;
    
    public function __construct($location = 'main')
    {
        $this->location = $location;
    }
    
    public function render()
    {
        $menu = TwillMenu::where('location', $this->location)->first();
        $links = $menu ? $menu->menuLinks()->with('page')->get() : collect();
        
        return view('components.menu', compact('links'));
    }
}