<!DOCTYPE html>
<html <meta name="Receivables" content="Receivables">
    <head>
        <title>
            Contract Payment
        </title>
    </head>
    <body style="align-content: center; width: 800px; margin:0 auto;">
        <h1 style="text-align: center; font-size: 14px; font-weight: bold;">
            SOCIALIST REPUBLIC of VIETNAM
        </h1>
        <h2 style="text-align: center; font-size: 14px;">
            Independence - Freedom - Happiness
        </h2>
        <h3 style="text-align: center;font-size: 14px;">
            ------o0o------
        </h3>
        <p></p>
        <h3 style="text-align: center; font-size: 36px; font-weight: bold; margin-bottom: 2px;">
            THƯ NHẮC THANH TOÁN
        </h3>
        <h4 style="text-align: center; font-size: 36px; font-weight: bold; margin-top: 5px;">
            PAYMENT REQUEST
        </h4>
        Kính gửi/<i>To</i>: <strong>{{ $contractPayment->getFullnameCustomer() }}</strong><br><p></p>
        Triển Lãm/<i>For</i>: <strong>{{ $contractPayment->getNameContract() }} - {{ $contractPayment->getExhibitionLocationsContract() }}</strong><br><p></p>
        <table style="border: 1px solid black; width: 800px; border-collapse: collapse; padding: 10px 10px 10px 0;">
            <tr>
                <th style="height: 30px;">
                    <u><strong>NỘI DUNG/DESCRIPTION</u></strong>
                </th>
                <th>
                    <u><strong>SỐ TIỀN/AMOUNT(VNĐ)</u></strong>
                </th>
            </tr>
            <tr>
                <td style="height: 40px; padding-left: 10px;">
                    Căn cứ Hợp đồng thuê mặt bằng triển lãm số: {{ $contractPayment->contract?->code }}, ký ngày {{ $contractPayment->contract?->day_begin->format(config("core.format.date")) }} / <i>Contract No.{{ $contractPayment->contract?->code }}, signed on {{ $contractPayment->contract?->day_begin->format(config("core.format.date")) }}</i>
                </td>
                <td rowspan="2" style="text-align: center;">{{ format_price($contractPayment->amount) }}<br>(đã bao gồm 10% thuế GTGT/ <i>included VAT</i>)
                </td>
            </tr>
            <tr>
                <td style="height: 40px; padding-left: 10px;">
                    Thời hạn thanh toán đợt {{ $contractPayment->period }}, {{ $contractPayment->isLate() ? 'đã trễ hạn' : 'trước hoặc' }} vào ngày {{ $contractPayment->expired_at->format(config("core.format.date")) }} / <i>The reminder for the 4th payment before or on date {{ $contractPayment->expired_at->format(config("core.format.date")) }}</i>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; padding-bottom: 10px;">
                    <strong>Tổng cộng/Total: {{ format_price($contractPayment->amount) }}</strong><br>
                    <i style="font-size: 14px;">({{ number_to_word($contractPayment->amount) }} đồng)</i>
                </td>
            </tr>
        </table><p></p>
        <i>(Số tiền này chưa bao gồm phí chuyển khoản qua ngân hàng/Please note that this amount has not been counted the bank transfer fee)</i><p></p>
        Xin vui lòng thanh toán theo thông tin sau/<i>Make all cash or cheque or T/T payable to:</i><p>
        Đơn vị thụ hưởng/<i>Beneficiary</i>:<p>
        
        <h1 style="text-align: center; font-size: 14px;">Phòng Kinh doanh – Tiếp thị</h1>
        <h1 style="text-align: center; font-size: 14px; font-style: italic;">Sales & Marketing Department</h1>
        <br>
        <br>
        <br>
        <br>
    </body>
</html>