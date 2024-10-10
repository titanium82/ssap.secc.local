<?php

namespace App\Core\View\Components\Input;

class InputCheckbox extends Input
{
    public $label;
    public $checked;
    public $value;
    public $depth;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $depth = 0, array $checked = [], $value = '', $type = 'text', $required = false)
    {
        //
        parent::__construct($type, $required);
        $this->label = $label;
        $this->value = $value;
        $this->checked = $checked;
        $this->depth = $depth * 15;
    }
    public function isRequired(){
        return $this->required === true ? [
            'required' => true, 
            'data-parsley-required-message' => __('Trường này không được bỏ trống.')
        ] : [];
    }
    
    public function isChecked($checked)
    {
        return  $this->value == $checked ? 'checked' : '';
    }
    
    public function isCheckedIn($checked)
    {
        return  in_array($this->value, $checked) ? 'checked' : '';
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.checkbox');
    }
}
