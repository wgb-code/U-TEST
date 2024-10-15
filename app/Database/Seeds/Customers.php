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
                'status'          => 'A',
                'admission_date'  => '2024-01-15',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'name'            => 'Mariazinha',
                'email'           => 'mariazinha@gmail.com',
                'status'          => 'A',
                'admission_date'  => '2024-02-20',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'name'            => 'Pedro',
                'email'           => 'pedro@gmail.com',
                'status'          => 'I',
                'admission_date'  => '2024-03-10',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'name'            => 'Mauricio',
                'email'           => 'mauricio@gmail.com',
                'status'          => 'A',
                'admission_date'  => '2024-04-05',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $customer) {
            $this->db->table('customers')->insert($customer);
        }
    }
}
