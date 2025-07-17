<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            // Students
            [
                'name' => 'John Smith',
                'email' => 'john.smith@schoolmail.com',
                'phone' => '555-0101',
                'student_id' => 'STU-2024-001',
                'type' => 'student',
                'class_grade' => 'Grade 10A',
                'balance' => 25.00,
                'is_active' => true
            ],
            [
                'name' => 'Emily Johnson',
                'email' => 'emily.johnson@schoolmail.com',
                'phone' => '555-0102',
                'student_id' => 'STU-2024-002',
                'type' => 'student',
                'class_grade' => 'Grade 9B',
                'balance' => 30.50,
                'is_active' => true
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown@schoolmail.com',
                'phone' => '555-0103',
                'student_id' => 'STU-2024-003',
                'type' => 'student',
                'class_grade' => 'Grade 11C',
                'balance' => 15.75,
                'is_active' => true
            ],
            [
                'name' => 'Sarah Davis',
                'email' => 'sarah.davis@schoolmail.com',
                'phone' => '555-0104',
                'student_id' => 'STU-2024-004',
                'type' => 'student',
                'class_grade' => 'Grade 8A',
                'balance' => 40.00,
                'is_active' => true
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.wilson@schoolmail.com',
                'phone' => '555-0105',
                'student_id' => 'STU-2024-005',
                'type' => 'student',
                'class_grade' => 'Grade 12B',
                'balance' => 20.25,
                'is_active' => true
            ],
            
            // Staff
            [
                'name' => 'Dr. Jennifer Martinez',
                'email' => 'j.martinez@school.edu',
                'phone' => '555-0201',
                'student_id' => 'STAFF-001',
                'type' => 'staff',
                'class_grade' => null,
                'balance' => 50.00,
                'is_active' => true
            ],
            [
                'name' => 'Robert Anderson',
                'email' => 'r.anderson@school.edu',
                'phone' => '555-0202',
                'student_id' => 'STAFF-002',
                'type' => 'staff',
                'class_grade' => null,
                'balance' => 35.00,
                'is_active' => true
            ],
            [
                'name' => 'Lisa Thompson',
                'email' => 'l.thompson@school.edu',
                'phone' => '555-0203',
                'student_id' => 'STAFF-003',
                'type' => 'staff',
                'class_grade' => null,
                'balance' => 60.00,
                'is_active' => true
            ],
            
            // Visitors
            [
                'name' => 'Guest User',
                'email' => null,
                'phone' => null,
                'student_id' => null,
                'type' => 'visitor',
                'class_grade' => null,
                'balance' => 0.00,
                'is_active' => true
            ]
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
