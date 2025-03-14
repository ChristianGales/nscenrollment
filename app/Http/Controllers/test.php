<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class test extends Controller
{
    public function download()
    
    {
        // Dummy Schedule Data
        $scheduleData = [
            [
                'subject' => 'Mathematics',
                'time' => '8:00 AM - 9:00 AM',
                'day' => 'Monday',
                'section' => 'A',
                'room' => '101',
                'teacher' => 'Ms. Dela Cruz',
            ],
            [
                'subject' => 'Science',
                'time' => '9:00 AM - 10:00 AM',
                'day' => 'Monday',
                'section' => 'A',
                'room' => '102',
                'teacher' => 'Mr. Reyes',
            ],
            [
                'subject' => 'English',
                'time' => '10:30 AM - 11:30 AM',
                'day' => 'Tuesday',
                'section' => 'B',
                'room' => '201',
                'teacher' => 'Mrs. Smith',
            ],
            [
                'subject' => 'History',
                'time' => '1:00 PM - 2:00 PM',
                'day' => 'Tuesday',
                'section' => 'B',
                'room' => '202',
                'teacher' => 'Mr. Jones',
            ],
            [
                'subject' => 'Filipino',
                'time' => '8:00 AM - 9:00 AM',
                'day' => 'Wednesday',
                'section' => 'A',
                'room' => '103',
                'teacher' => 'Gng. Santos',
            ],
            [
                'subject' => 'PE',
                'time' => '9:00 AM - 10:00 AM',
                'day' => 'Wednesday',
                'section' => 'A',
                'room' => 'Gym',
                'teacher' => 'Mr. Cruz',
            ],
        ];

        $pdf = Pdf::loadView('pdf', ['scheduleData' => $scheduleData]);

        return $pdf->stream('class_schedule.pdf'); // Use stream() and provide a filename
    }
}