<?php

namespace App;

interface UserInterFace
{
    const ADMIN_ROLE_ID = 1;
    const ADMIN_ROLE_TEXT = 'Admin';

    const TEACHER_ROLE_ID = 2;
    const TEACHER_ROLE_TEXT = 'Teacher';

    const STUDENT_ROLE_ID = 3;
    const STUDENT_ROLE_TEXT = 'Student';

    const MALE = 1;
    const MALE_TEXT = 'Male ';

    const FEMALE = 2;
    const FEMALE_TEXT = 'Female';

    const  USER_ID = 1;
    const CURRENCY_SYMBOL = '$';
    const CURRENCY_NAME = 'USD';
    const CURRENCY_RATE = '171';

    const ZOOM_MEETING_INTERVAL = 30;
    const PAYPAL_ID = 'mrmehranrajpoot@gmail.com';
    const PAYPAL_SANDBOX = true;
    const PAYPAL_RETURN_URL = '/payment/return';
    const PAYPAL_CANCEL_URL = 'payment/cancel';
    // Change not required
    const PAYPAL_URL =  (PAYPAL_SANDBOX == true)? "https://www.sandbox.paypal.com/cgi-bin/webscr" :"https://www.paypal.com/cgi-bin/webscr";
}
