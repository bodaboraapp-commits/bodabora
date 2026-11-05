<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Label Print</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-size: 17px;
        }

        .padding-5 {
            padding: 3px 10px;
        }

        .divider-h {
            width: 100%;
            height: 2px;
            background-color: #000;
        }

        .label {
            border: 2px solid #000;
            width: 380px;
            height: 573px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            width: 150px;
            margin-left: 10px;
            object-fit: contain;
        }

        .logo-img {
            width: 100%;
            object-fit: cover;
        }

        .domestic {
            border: 2px solid #000;
            text-align: center;
            font-weight: 600;
            margin: 5px 3px;
        }

        .domestic>span {
            padding: 5px 35px;
            display: block;
            text-transform: uppercase;
        }

        .location {
            border-top: 2px solid #000;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .location>span {
            text-transform: uppercase;
            padding: 0 5px;
        }

        .divider {
            display: block;
            height: 30px;
            width: 2px;
            background-color: #000;
        }

        .codd {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .codd>strong {
            font-size: 25px;
        }

        .account {
            font-weight: 600;
        }

        .account>span {
            font-weight: 700;
        }

        .shipper {
            font-weight: 200;
        }

        .shipper>span {
            font-weight: 700;
        }

        .reference {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .reference .re-text {
            font-size: 16px;
            font-weight: 600;
        }

        .reference .count {
            font-size: 22px;
            font-weight: 700;
        }

        .bold {
            font-weight: bold;
        }

        .barcode {
            text-align: center;
        }

        .address {
            font-weight: 300;
            text-transform: uppercase;
        }

        .remarks>span {
            display: block;
            margin-top: 5px;
        }

        .preferred {
            font-weight: 700;
        }

        .bold {
            font-weight: 700;
            text-transform: capitalize;
        }



        @media print {


            /* * {
                font-size: 10px !important;
            } */

            @page {
                size: 101mm 152mm;
                margin: 5px !important;
            }

            body {
                zoom: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="label">

        <div class="header">
            <div class="logo">
                <img class="logo-img" src="{{ settings()->logo_image }}" alt="">
            </div>
            <div class="domestic">
                <span>{{ __('deliveryType.'.$parcel->delivery_type_id) }}</span>
                <div class="location">
                    {{-- <span>dubai</span> --}}
                    <span></span>
                    <div class="divider"></div>
                    <span></span>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="divider-h"></div>
            <div class="codd padding-5"><span>{{ date('d/m/Y') }}</span> <strong>COD : {{ settings()->currency }} {{ $parcel->cash_collection }}</strong></div>
            <div class="divider-h"></div>
            {{-- <div class="account padding-5">Account: <span>SC1233</span></div> --}}
            <div class="account padding-5">Invoice: <span>#{{ $parcel->invoice_no }}</span></div>
            <div class="divider-h"></div>
            <div class="shipper padding-5"><span>Shipper : </span> {{ @$parcel->merchant->business_name }}</div>
            <div class="divider-h"></div>
        </div>

        <div class="barcode padding-5">
            <div style="display: inline-block;margin:auto;margin-top:3px">{!! $parcel->barcodeprint !!}</div>
            <div>{{ $parcel->tracking_id }}</div>
        </div>

        <div class="reference padding-5">
            <div class="re-text">Reference: <br /> N/A</div>
            <div> {{ $parcel->weight?? 0 }} KG / PCS <strong class="count">1</strong> of 1</div>
        </div>
        <div class="divider-h"></div>

        <div class="address padding-5">
            <div class="bold">Delivery Address:</div>
            {{ $parcel->customer_name }}<br/> 
            {{ $parcel->customer_address }}<br>
            Tel No:  {{ $parcel->customer_phone }}
        </div>
        <div class="divider-h"></div>

        <div class="remarks padding-5">
            <div class="bold">Remarks:</div>
            <span> {{ $parcel->note }}</span>
        </div>
        <div class="divider-h"></div>

        <div class="preferred padding-5">
            <div class="bold">Preferred Date & Time:</div>
            <div >{{ \Carbon\Carbon::parse($parcel->delivery_date)->format('d/m/Y') }}</div>
        </div>

    </div>

    <script>
        window.print();
    </script>

</body>

</html>
