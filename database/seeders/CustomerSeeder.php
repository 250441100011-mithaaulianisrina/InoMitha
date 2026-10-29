<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [

            [
                'customer_code' => 'CUST001',
                'name' => 'Alya Rahma Putri',
                'phone' => '081234567801',
                'email' => 'alya.rahma@example.com',
                'address' => 'Bangkalan, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST002',
                'name' => 'Nabila Putri Maharani',
                'phone' => '082234567802',
                'email' => 'nabila.maharani@example.com',
                'address' => 'Surabaya, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST003',
                'name' => 'Salsabila Nur Aini',
                'phone' => '085734567803',
                'email' => 'salsabila.aini@example.com',
                'address' => 'Sampang, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST004',
                'name' => 'Dinda Ayu Lestari',
                'phone' => '081334567804',
                'email' => 'dinda.lestari@example.com',
                'address' => 'Pamekasan, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST005',
                'name' => 'Citra Maharani',
                'phone' => '085234567805',
                'email' => 'citra.maharani@example.com',
                'address' => 'Sumenep, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST006',
                'name' => 'Nadya Safitri',
                'phone' => '081234567806',
                'email' => 'nadya.safitri@example.com',
                'address' => 'Gresik, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST007',
                'name' => 'Aulia Zahra',
                'phone' => '082134567807',
                'email' => 'aulia.zahra@example.com',
                'address' => 'Sidoarjo, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST008',
                'name' => 'Keisya Ramadhani',
                'phone' => '085634567808',
                'email' => 'keisya.ramadhani@example.com',
                'address' => 'Surabaya, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST009',
                'name' => 'Putri Amelia',
                'phone' => '081934567809',
                'email' => null,
                'address' => 'Bangkalan, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST010',
                'name' => 'Fira Anindya',
                'phone' => '083834567810',
                'email' => 'fira.anindya@example.com',
                'address' => 'Lamongan, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST011',
                'name' => 'Rania Khairunnisa',
                'phone' => '081234567811',
                'email' => 'rania.khairunnisa@example.com',
                'address' => 'Malang, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST012',
                'name' => 'Syifa Nurhaliza',
                'phone' => '082234567812',
                'email' => 'syifa.nurhaliza@example.com',
                'address' => 'Mojokerto, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST013',
                'name' => 'Nasywa Azzahra',
                'phone' => '085734567813',
                'email' => 'nasywa.azzahra@example.com',
                'address' => 'Bangkalan, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST014',
                'name' => 'Tiara Febrianti',
                'phone' => '081334567814',
                'email' => null,
                'address' => 'Surabaya, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST015',
                'name' => 'Amelia Nuraini',
                'phone' => '085234567815',
                'email' => 'amelia.nuraini@example.com',
                'address' => 'Sampang, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST016',
                'name' => 'Shafira Aulia',
                'phone' => '081234567816',
                'email' => 'shafira.aulia@example.com',
                'address' => 'Pamekasan, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST017',
                'name' => 'Najwa Fadhilah',
                'phone' => '082134567817',
                'email' => 'najwa.fadhilah@example.com',
                'address' => 'Sumenep, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST018',
                'name' => 'Salma Nur Azizah',
                'phone' => '085634567818',
                'email' => 'salma.azizah@example.com',
                'address' => 'Gresik, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST019',
                'name' => 'Aisyah Maharani',
                'phone' => '081934567819',
                'email' => null,
                'address' => 'Sidoarjo, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST020',
                'name' => 'Zahra Nabila',
                'phone' => '083834567820',
                'email' => 'zahra.nabila@example.com',
                'address' => 'Surabaya, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST021',
                'name' => 'Farah Azzahra',
                'phone' => '081234567821',
                'email' => 'farah.azzahra@example.com',
                'address' => 'Bangkalan, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST022',
                'name' => 'Intan Permata Sari',
                'phone' => '082234567822',
                'email' => 'intan.permata@example.com',
                'address' => 'Malang, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST023',
                'name' => 'Naila Putri',
                'phone' => '085734567823',
                'email' => 'naila.putri@example.com',
                'address' => 'Lamongan, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST024',
                'name' => 'Vania Maharani',
                'phone' => '081334567824',
                'email' => null,
                'address' => 'Mojokerto, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST025',
                'name' => 'Raisa Amalia',
                'phone' => '085234567825',
                'email' => 'raisa.amalia@example.com',
                'address' => 'Bangkalan, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST026',
                'name' => 'Anindya Larasati',
                'phone' => '081234567826',
                'email' => 'anindya.larasati@example.com',
                'address' => 'Surabaya, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST027',
                'name' => 'Kirana Ayu',
                'phone' => '082134567827',
                'email' => 'kirana.ayu@example.com',
                'address' => 'Sidoarjo, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST028',
                'name' => 'Aurelia Safira',
                'phone' => '085634567828',
                'email' => null,
                'address' => 'Gresik, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST029',
                'name' => 'Laras Sekar Wangi',
                'phone' => '081934567829',
                'email' => 'laras.sekar@example.com',
                'address' => 'Malang, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST030',
                'name' => 'Fadhila Rahmani',
                'phone' => '083834567830',
                'email' => 'fadhila.rahmani@example.com',
                'address' => 'Pamekasan, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST031',
                'name' => 'Almira Putri',
                'phone' => '081234567831',
                'email' => 'almira.putri@example.com',
                'address' => 'Bangkalan, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST032',
                'name' => 'Hana Aprilia',
                'phone' => null,
                'email' => 'hana.aprilia@example.com',
                'address' => 'Surabaya, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST033',
                'name' => 'Naura Fitria',
                'phone' => '085734567833',
                'email' => 'naura.fitria@example.com',
                'address' => null,
            ],

            [
                'customer_code' => 'CUST034',
                'name' => 'Kayla Rahmadani',
                'phone' => '081334567834',
                'email' => null,
                'address' => 'Sampang, Jawa Timur',
            ],

            [
                'customer_code' => 'CUST035',
                'name' => 'Adelia Putri Utami',
                'phone' => '085234567835',
                'email' => 'adelia.utami@example.com',
                'address' => 'Bangkalan, Jawa Timur',
            ],

        ];


        foreach ($customers as $customer) {

            $existingCustomer = DB::table('customers')
                ->where(
                    'customer_code',
                    $customer['customer_code']
                )
                ->first();


            DB::table('customers')->updateOrInsert(

                [
                    'customer_code' =>
                        $customer['customer_code'],
                ],

                [
                    'name' =>
                        $customer['name'],

                    'phone' =>
                        $customer['phone'],

                    'email' =>
                        $customer['email'],

                    'address' =>
                        $customer['address'],

                    'created_at' =>
                        $existingCustomer
                            ? $existingCustomer->created_at
                            : now(),

                    'updated_at' =>
                        now(),
                ]
            );
        }
    }
}