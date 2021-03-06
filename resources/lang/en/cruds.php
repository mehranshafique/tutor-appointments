<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'     => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],

    'price'           => [
        'title'          => 'Prices',
        'title_singular' => 'Price',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Price',
            'title_helper'       => '',
            'price'        => 'Price',
            'price_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],

    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'introduction'        => 'Introduction',
            'introduction_helper' => '',
            'user_type'        => 'User Type',
            'user_type_helper' => '',
            'hourly_pay'        =>  'Hourly Pay',
            'hourly_pay_helper' => '',
            'status' => 'Status',
            'status_helper' => '',
            'phone' => 'Phone',
            'phone_helper' => '',
            'location'        => 'Location',
            'location_helper' => '',
            'country' => 'Country',
            'country_helper' => '',
            'dob' => 'Date of Birth',
            'dob_helper' => '',
            'picture' => 'Picture',
            'avatar_helper' => '',
            'gender'        => 'Gender',
            'gender_helper' => '',

            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',

            'male'           => 'Male',
            'female' => 'Female',
            'active' => 'Active',
            'block' => 'Block',
            'admin' => 'Admin',
            'teacher' => 'Teacher',
            'student'=> 'Student'
        ],
    ],
    'subject'        => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'price'             => 'Price',
            'price_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],

    'child_subjects'     => [
        'title'          => 'Curriculums',
        'title_singular' => 'Curriculum',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Category',
            'name_helper'       => '',
            'curriculum'        => 'Curriculum',
            'picture'         => 'Picture',
            'picture_helper' => '',
            'description' => 'Description',
            'description_helper' => '',
            'price_helper'      => '',
            'documents'        => 'Documents',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],

    'documents'     => [
        'title'          => 'Documents',
        'title_singular' => 'Document',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'file_name'         => 'File Name',
            'file_name_helper'  => '',
            'file_size'       => 'File Size',
            'file_size_helper' => '',
            'file_type' => 'File Type',
            'file_type_helper' => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],

    'teacher'       => [
        'title'          => 'Teachers',
        'title_singular' => 'Teacher',
        'find_teacher' =>  'Find Teacher',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'email'             => 'Email',
            'email_helper'      => '',
            'phone'             => 'Phone',
            'phone_helper'      => '',
            'photo'             => 'Photo',
            'photo_helper'      => '',
            'hourly_pay' => 'Pay/h',
            'hourly_pay_helper' => '',
            'services'          => 'Services',
            'services_helper'   => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],


    'teacherAvailbility'           => [
        'title'          => 'Teacher Availbilities',
        'title_singular' => 'Teacher Availbility',
        'calendar' => 'Teacher Calendar',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'start_time'              => 'Start Time',
            'start_time_helper'       => '',
            'end_time'             => 'Finish Time',
            'finish_time_helper'      => '',
            'teacher'             => 'Teacher Name',
            'teacher_helper'      => '',
            'comments'             => 'Comments',
            'photo_helper'      => '',
            'services'          => 'Services',
            'services_helper'   => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ''
        ],
    ],

    'teacherReport'     => [
        'title'          => 'Reports',
        'title_singular' => 'Report',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'file_name'         => 'File Name',
            'file_name_helper'  => '',
            'file_size'       => 'File Size',
            'file_size_helper' => '',
            'file_type' => 'File Type',
            'file_type_helper' => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],

    'client'         => [
        'title'          => 'Students',
        'title_singular' => 'Student',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'phone'             => 'Phone',
            'phone_helper'      => '',
            'email'             => 'Email',
            'email_helper'      => '',
            'classes'        => 'Class history',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],

    'appointment'    => [
        'title'          => 'Appointments',
        'title_singular' => 'Appointment',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'client'             => 'Student',
            'duration'           => 'Duration/h',
            'duration_helper' => '',
            'client_helper'      => '',
            'employee'           => 'Teacher',
            'employee_helper'    => '',
            'start_time'         => 'Start Time',
            'start_time_helper'  => '',
            'finish_time'        => 'Finish Time',
            'finish_time_helper' => '',
            'price'              => 'Price',
            'price_helper'       => '',
            'comments'           => 'Comments',
            'comments_helper'    => '',
            'class'               => 'Class',
            'class_helper'        => '',
            'rate'                => 'Rate',
            'status'             => 'Status',
            'status_helper' => '',
            'services'           => 'Subjects',
            'services_helper'    => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],

    'packages' =>  [
        'title'          => 'Packages',
        'title_singular' => 'Package',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'price'             => 'Price',
            'price_helper'      => '',
            'duration'             => 'Duration',
            'duration_helper'      => '',
            'duration_type'        => 'Duration Tpye',
            'duration_type_helper' => '',
            'auto_renew'        => 'Auto Renew',
            'auto_renew_helper' =>'',
            'allowed_classes'   => 'Allowed Classes',
            'allowed_classes_helper' => '',
            'description'       => 'Description',
            'description_helper' => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'duration_day' => 'Day',
            'duration_week' => 'Week',
            'duration_month' => 'Month',
            'duration_year' => 'Year',
            'auto_renew_yes' => 'Yes',
            'auto_renew_no' => 'No'
        ],
    ],
];
