<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>
<body>
    <h4>{{ $title }}</h4>

    <p>{!! $content !!}</p>

    <h4>@lang('Files payment')</h4>

    <p>@lang('File'): <a href="{{ asset($contractPayment->file_send_mail) }}">{{ basename($contractPayment->file_send_mail) }}</a></p>

    @if(count($files))
    <h4>@lang('Files contract')</h4>
    @foreach ($files as $file)
        <p>@lang('File :num', ['num' => $loop->iteration]): <a href="{{ asset($file) }}">{{ basename($file) }}</a></p>
    @endforeach
    @endif

    <hr>
    <h4>@lang('Info contract payment')</h4>
    <p>@lang('Contract code: :code', ['code' => $contractPayment->contract->code])</p>
    <p>@lang('Contract name: :name', ['name' => $contractPayment->contract->name])</p>
    <p>@lang('Contract payment period: :period', ['period' => $contractPayment->period])</p>
    <p>@lang('Contract payment expired at: :expired_at', ['expired_at' => $contractPayment->expired_at->format('d-m-Y')])</p>
    <p>@lang('Contract payment amount: :amount', ['amount' => format_price($contractPayment->amount)])</p>
</body>
</html>