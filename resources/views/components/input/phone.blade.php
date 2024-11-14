<input type="text"
{{ $attributes
    ->class(['form-control'])
    ->merge([
        'placeholder' => __('phone'),
        'data-parsley-pattern' => "/((0[2|9|3|7|8|5]|[4|8])+([0-9]{8})\b)/g",
        'data-parsley-pattern-message' => __('msgValidatePhone')
    ])->merge($isRequired())
}}>
