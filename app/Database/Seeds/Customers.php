<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Customers extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'            => 'Joãozinho',
                'email'           => 'joãozinho@gmail.com',
                'status'          => 'C',
                'admission_date'  => '2024-01-10',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'name'            => 'Mariazinha',
                'email'           => 'mariazinha@gmail.com',
                'status'          => 'C',
                'admission_date'  => '2022-02-20',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'name'            => 'Pedro',
                'email'           => 'pedro@gmail.com',
                'status'          => 'A',
                'admission_date'  => '2020-03-10',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'name'            => 'Mauricio',
                'email'           => 'mauricio@gmail.com',
                'status'          => 'F',
                'admission_date'  => '2024-04-05',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'name'            => 'Willian',
                'email'           => 'will@gmail.com',
                'status'          => 'D',
                'admission_date'  => '2023-02-05',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $customer) {
            $this->db->table('customers')->insert($customer);
        }
    }
}
