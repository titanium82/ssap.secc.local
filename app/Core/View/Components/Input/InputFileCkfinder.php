<?php

namespace App\Core\View\Components\Input;

class InputFileCkfinder extends Input
{
    public $value;

    public $showFile;

    public $name;

    public $multiple;

    public $btntext;

    public $label;

    public $preview;

    public $readonly;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $type = 'text', $value = '', $required = false, $multiple = false, $btntext = '', $label = '', $readonly = false)
    {
        //
        parent::__construct($type, $required);
        $this->name = $name;
        $this->multiple = $multiple;
        $this->label = $label ? $label : __('Files');
        $this->btntext = $btntext ? $btntext : __('Add file');
        $this->preview = 'filePreview'.uniqid_real(5);
        $this->value = $value;
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

    public function urlFeature($path)
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg')
        {
            $path = $path;
        }else {
            $path = '/public/admins/assets/images/icon-'.pathinfo($path, PATHINFO_EXTENSION) . '.png';
        }
        return asset($path);
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.file-ckfinder');
    }
}
