<?php

namespace App\Admin\View\Components\Layouts;

use Illuminate\View\Component;

class SidebarLeft extends Component
{
    /**
     * The alert type.
     *
     * @var array
     */
    public $menu;

    public $logo;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->menu = config('admin.sidebar_left', []);

        $this->logo = config('core.images.logo');
    }

    public function routeName($route_name, $param){
        return $route_name ? route($route_name, $param) : '#';
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.layouts.sidebar-left');
    }
}