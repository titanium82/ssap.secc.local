<?php

namespace App\Core\View\Components\Input;

class InputGalleryCkfinder extends Input
{
    public $value;

    public $name;
    public $label;
    public $btntext;
    public $preview;
    public $readonly;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $type = 'text', $value = '', $required = false, $label = '', $btntext = '', $readonly = false)
    {
        //
        parent::__construct($type, $required);
        $this->name = $name;
        $this->value = $value;
        $this->label = $label ? $label : __('Gallery');
        $this->btntext = $btntext ? $btntext : __('Add Image');
        $this->preview = 'galleryPreview'.uniqid_real(5);
        $this->readonly = $readonly;
    }
    public function marcoValue($value)
    {
        if(gettype($value) == 'object')
        {
            return $value ? implode(',', $value->toArray()) : '';
        }elseif(gettype($value) == 'array') {
            
            return $value ? implode(',', $value) : '';
        }elseif(gettype($value) == 'string') {

            return $value;
        }
        return '';
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.gallery-ckfinder');
    }
}
