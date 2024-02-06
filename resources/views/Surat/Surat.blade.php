<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        @page {
            size: A4;
            /* Ganti dengan ukuran yang Anda inginkan */
            margin: 1cm;
            /* Atur margin halaman sesuai kebutuhan Anda */
        }


        body {
            font-family: Arial, sans-serif;
            /* Use a consistent font */
            margin: 0;
            padding: 0;
        }

        .row {
            display: flex;
            margin: 0;

        }

        header {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        #logo {
            margin: auto;
            margin-left: 25%;
            margin-right: auto;
        }

        .header-text {
            margin-left: 25%;
            text-align: center;
            /* Spacing between text and right side */
        }

        .kablogo,
        .keclogo,
        .alamatlogo,
        .kodeposlogo {
            margin: 0;
            line-height: 1.2;
            /* Adjust line spacing */
        }

        .kablogo {
            font-size: 18px;
            /* Adjust font size as needed */
        }

        .keclogo {
            font-size: 24px;
            /* Adjust font size as needed */
            font-weight: bold;
        }

        .alamatlogo {
            font-size: 14px;
            /* Adjust font size as needed */
        }

        .kodeposlogo {
            font-size: 16px;
            /* Adjust font size as needed */
        }

        .garis1 {
            border-top: 3px solid black;
            height: 2px;
            border-bottom: 1px solid black;
            margin-top: 10px;
        }
    </style>


</head>


<body>
    {!! $kop->content ?? '' !!}
    <div class="container">
        <hr class="garis1" />
        {!! $content ?? '' !!}
    </div>
</body>

</html>
