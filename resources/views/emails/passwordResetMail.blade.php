<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Chipo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0">
    <table align="center" cellpadding="0" cellspacing="0" width="600"
        style="border-collapse: collapse; border: 1px solid #cccccc">
        <tr>
            <td align="center" bgcolor="#e6ecf0"
                style="padding: 0px 0 0px 0; color: #ffffff; border: 1px solid #cccccc">
                <img src="https://i.ibb.co/C52gyDv/Chipo-Logo-Landscape.png" alt="Chipo Logo" width="320" height="180"
                    style="display: block" />
            </td>
        </tr>
        <tr>
            <td bgcolor="#F4F5FA" style="padding: 40px 30px 40px 30px">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td>
                            <h2>Hello, {{ $details['name'] }}!</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 0 30px 0">
                            Kami mendengar Anda mengalami masalah saat login ke Chipo. Kami mendapat
                            pesan bahwa Anda lupa kata sandi. Jika ini Anda, Anda bisa mereset kata sandi Anda sekarang.
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="http://localhost:8000/account/reset-password/{{ $details['token'] }}" style="
                    color: #ffffff;
                    font-weight: 600;
                    font-size: 0.875rem;
                    line-height: 1.25rem;
                    padding-bottom: 0.5rem;
                    padding-top: 0.5rem;
                    padding-left: 1.25rem;
                    padding-right: 1.25rem;
                    background-color: #1a56db;
                    border-radius: 0.5rem;
                    text-decoration: inherit;
                  ">Reset kata sandi</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px 0 30px 0">
                            Jika Anda tidak meminta reset kata sandi, Anda bisa mengabaikan pesan
                            ini.
                            Hanya orang yang mengetahui kata sandi Anda atau mengklik tautan login di email ini
                            yang bisa masuk ke akun Anda.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#110B56" align="center" style="padding: 10px 0px 10px 0px; color: #ffffff; font-size: 12px">
                &copy; Chipo 2022. Jl. Dewi Sri, Legian, Kuta, Badung, Bali.
            </td>
        </tr>
    </table>
</body>

</html>
