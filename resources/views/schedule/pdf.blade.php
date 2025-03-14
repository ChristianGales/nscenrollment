<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Class Schedule</title>

    <style>
        body {
            font-family: sans-serif;
            /* Use a more readable font */
            font-size: 12pt;
            /* Adjust base font size */
        }

        .w-full {
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            /* Add space below the header */
        }

        .header img {
            width: 450px;
            /* Adjust logo size */
            height: auto;
            margin-bottom: 10px;
        }

        .header h4 {
            font-size: 16pt;
            margin-bottom: 5px;
        }

        .schedule {
            width: 100%;
            border-collapse: collapse;
            /* Essential for proper border display */
        }

        .schedule th,
        .schedule td {
            border: 1px solid #ddd;
            /* Lighter border color */
            padding: 10px;
            /* More padding in cells */
            text-align: left;
        }

        .schedule td {
            font-size: 10px;
        }

        .schedule th {
            background-color: #f0f0f0;
            /* Light gray header background */
            font-weight: bold;
            /* Bold header text */
        }

        .margin-top {
            margin-top: 20px;
        }

        .signature {
            margin-top: 90px;
            /* Increased margin */
            text-align: center;
            font-style: italic;
            /* Italic signature text */
        }
    </style>
    
</head>

<body>
    <div class="header">
        <img src="{{ public_path('img/pdf-bg.png') }}" alt="school-logo">
       
        <h4>Class Schedule: {{ $gradeLevel }} - {{ $section->name }}</h4>
        <h5>School Year {{ $activeSy->name }} </h5>
    </div>

    <div class="margin-top">
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
                @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->subject->subject_name }}</td>
                    <td>{{ date('h:i A', strtotime($schedule->time_from)) }} - {{ date('h:i A', strtotime($schedule->time_to)) }}</td>
                    <td>{{ $schedule->day }}</td>
                    <td>{{ $schedule->room }}</td>
                    <td>{{ $schedule->teacher->fullname }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="signature">
        ___________________<br>
        Assessed By:
    </div>
</body>

</html>