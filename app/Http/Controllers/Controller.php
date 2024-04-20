<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $emp_role = [
        ['เจ้าของร้าน', 'Owner'],
        ['ผู้ดูแลระบบ', 'Admin'],
        ['พนักงาน', 'Employee'],
        ['พนักงานจัดส่งของ', 'Delivery Worker']
    ];

    protected $gender = [
        ['ชาย','Male'],
        ['หญิง','Female']
    ];
}
