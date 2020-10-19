<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        a {
            color: blue;
            text-decoration: none;
        }
        a:hover {
            color: darkblue;
        }
        body {
            background-color: rgba(0,0,0,.05);
            font-family: sans-serif;
            font-size: 14px;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table > thead > tr > th {
            font-weight: normal;
        }
        table > thead > tr > th > a {
            margin-left: 2px;
            font-size: 12px;
        }
        table > tbody > tr > td {
            text-align: center;
        }
        ul {
            list-style: none;
            padding-left: 0;
            border: 1px solid rgba(0,0,0,.05);
        }
        ul > li {
            display: flex;
        }
        ul > li:nth-child(odd) {
            background-color: rgba(0,0,0,.05);
        }
        ul > li > span {
            width: 50%;
        }
        ul > li > span:first-child {
            padding-left: 10px;
        }
        ul > li > span:last-child {
            padding-right: 10px;
            text-align: left;
        }
        body, p {
            margin: 0;
        }
        table > thead > tr, table > tbody > tr:nth-child(even) {
            background-color: rgba(0,0,0,.05);
        }
        ul, .content > p:nth-child(3), .header, .table {
            margin: 0 0 20px;
        }
        .wrapper {
            background-color: #fff;
            width: calc(100% - 40px);
            max-width: 720px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: rgba(0,0,0,.05);
            padding: 10px;
            display: flex;
            align-items: center;
            border: 1px solid rgba(0,0,0,.05);
        }
        .header > img {
            height: 48px;
        }
        .header > div {
            margin-left: 10px;
        }
        .header > div > p:first-child {
            margin-bottom: 5px;
            font-weight: bold;
        }
        .header > div > p:last-child {
            font-size: 12px ;
        }
        .content > p:first-child {
            margin-bottom: 10px;
        }
        .table {
            overflow-x: auto;
            white-space: nowrap;
            border: 1px solid rgba(0,0,0,.05);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div>
                <p>TB - Delima</p>
                <p>{{ $details['alamat_toko'] }}. Telepon : {{ $details['telepon_toko'] }}. Email : {{ $details['email_toko'] }}</p>
            </div>
        </div>
        <div class="content">
            <p>Halo {{ $details['name'] }},<br>
                Akun kamu berhasil direset. Silahkan login:
            </p>
            <ul>
                <li><span>Email</span><span>{{ $details['email'] }}</span></li>
                <li><span>Password</span><span>{{ $details['password'] }}</span></li>
            </ul>
            <p>Silahkan ganti password untuk memudahkan kamu login kembali.<br><br>

            Email ini hanya bersifat informasi dan tidak bisa merima balasan jika ada yang belum jelas terkait pesan yang disampaikan silahkan hubungi call center kami.<br><br>Terimakasih,<br>Admin TB - Delima.</p>
        </div>
    </div>
</body>
</html>