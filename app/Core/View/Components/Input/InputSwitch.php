<?php

namespace App\Core\View\Components\Input;

class InputSwitch extends Input
{
    public $label;
    public $checked;
    public $value;
    public $linkLabel;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $checked = false, $value = '', $type = 'text', $required = false, $linkLabel = false)
    {
        //
        parent::__construct($type, $required);
        $this->label = $label;
        $this->value = $value;
        $this->checked = $checked;
        $this->linkLabel = $linkLabel;
    }
    public function isRequired()
    {
        return $this->required === true ? [
            'required' => true, 
            'data-parsley-required-message' => __('msgValidateFieldEmpty')
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
        return view('components.input.switch');
    }
}
