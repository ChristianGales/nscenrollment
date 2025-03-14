<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate of Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #ccc;
            padding: 20px;
            background-color: #fff;
        }

       

        .certificate-title {
            font-size: 18pt;
            font-weight: bold;
            text-align: center;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 2px;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .student-info-table {
            width: 100%;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .student-info-table td {
            padding: 5px;
        }

        .schedule {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 30px;
            font-size: 12px;
        }

        .schedule th,
        .schedule td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        .schedule th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .signature-table {
            width: 100%;
            font-size: 12px;
            margin-top: 40px;
        }

        .signature-table td {
            text-align: center;
            padding-top: 30px;
        }

        .signature-line {
            border-top: 1px solid #333;
            width: 80%;
            margin: 0 auto;
        }

        .signature-title {
            font-style: italic;
        }

        .header-table {
        width: 100%;
    }

    .header-table td {
        vertical-align: middle;
    }

    .header-logo {
        text-align: center;
    }

    .header-logo img {
        width: 450px; /* Adjust size as needed */
        height: auto;
    }

    .info-box {
        text-align: right;
        font-size: 8px;
    }

    .info-box p {
        margin: 2px 0;
    }
    </style>
</head>

<body>
    <div class="container">
        <table class="header-table">
            <tr>
                <td class="header-logo">
                    <img src="{{ public_path('img/pdf-bg.png') }}" alt="school-logo">
                </td>
                
                <td class="info-box">
                    <p><strong>Learner Reference No:</strong> __________</p>
                    <p><strong>Date of Registration:</strong> __________</p>
                    <p><strong>School Year:</strong> __________</p>
                </td>
            </tr>
        </table>

        <div class="certificate-title">
            CERTIFICATE OF REGISTRATION
        </div>

        <table class="student-info-table">
            <tr>
                <td><strong>Name:</strong> ___________________________</td>
                <td><strong>Grade:</strong> _______</td>
                <td><strong>Section:</strong> _______</td>
            </tr>
        </table>

        <table class="schedule">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Time</th>
                    <th>Day</th>
                    <th>Room</th>
                    <th>Teacher</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scheduleData as $schedule)
                <tr>
                    <td>{{ $schedule['subject'] }}</td>
                    <td>{{ $schedule['time'] }}</td>
                    <td>{{ $schedule['day'] }}</td>
                    <td>{{ $schedule['room'] }}</td>
                    <td>{{ $schedule['teacher'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="signature-table">
            <tr>
                <td>
                    <div class="signature-line"></div>
                    <div class="signature-title">Enrollment Coordinator : </div>
                </td>
                <td>
                    <div class="signature-line"></div>
                    <div class="signature-title">Assessed By : </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>