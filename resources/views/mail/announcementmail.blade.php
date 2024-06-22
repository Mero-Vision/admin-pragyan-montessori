<!-- resources/views/mail/announcementmail.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>New Announcement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .header h3 {
            margin: 0;
            color: #333;
        }
        .header p {
            margin: 0;
            color: #666;
        }
        .content {
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h3>Pragyan Montessori & Childcare, PMC</h3>
            <p>Address: New Naikap, Pragati Sangam Marg</p>
            <p>Phone: 9810212323 | Email:  support@pragyanmontessori.com</p>
        </div>
        <div class="content">
            <h4>{{ $announcement->title }}</h4>
            <p>{!! $announcement->content !!}</p>
        </div>
        <div class="footer">
            <p>Regards,<br>{{ $announcement->author }}</p>
        </div>
    </div>
</body>
</html>
