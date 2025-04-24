<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 500px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            font-size: 22px;
            font-weight: bold;
            color: #000;
        }
        .registration_no {
            font-size: 18px;
            font-weight: bold;
            color: rgb(46, 0, 64);
            background:#ffffff;
            padding: 10px;
            display: inline-block;
            border-radius: 4px;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            background: #623873;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            margin-top: 20px;
            transition: 0.3s ease-in-out;
        }
        .btn:hover {
            background: #512E5F;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        /* Responsive Design */
        @media screen and (max-width: 480px) {
            .container {
                width: 95%;
                padding: 15px;
            }
            .header {
                font-size: 20px;
            }
            .registration_no {
                font-size: 16px;
                padding: 8px;
            }
            .btn {
                font-size: 14px;
                padding: 10px 16px;
            }
            .footer {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        
        <p>Dear Candidate,</p>
        <p>Your One Time Password (OTP) for login: <span class="registration_no">{{$otp}} </span></p>
        <p class="footer">If you did not request this OTP, please connect with us immediately at xyz.in@gmail.com.</p>
        <p class="footer">Regards,<br><strong>DCG Team</strong></p>
    </div>
</body>

</html>
