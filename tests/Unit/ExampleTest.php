<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    function getData()
    {
        return  [
            "customer_name" => "PTa",
            "customer_code" => "1678593",
            "transaction_amount" => "70700",
            "transaction_discount" => "0",
            "transaction_additional_field" => null,
            "transaction_payment_type" => "29",
            "transaction_state" => "PAID",
            "transaction_code" => "CGKFT20200715121",
            "transaction_order" => 121,
            "location_id" => "5cecb20b6c49615b174c3e74",
            "organization_id" => 6,
            "transaction_payment_type_name" => "Invoice",
            "transaction_cash_amount" => 0,
            "transaction_cash_change" => 0,
            "connote_id" => "f70670b1-c3ef-4caf-bc4f-eefa702092ed",
            "customer_attribute" => [
                "Nama_Sales" => "Radit Fitrawikarsa",
                "TOP" => "14 Hari",
                "Jenis_Pelanggan" => "B2B"
            ],
            "origin_data" => [
                "customer_name" => "PT. NARA OKA PRAKARSA",
                "customer_address" => "JL. KH. AHMAD DAHLAN NO. 100, SEMARANG TENGAH 12420",
                "customer_email" => "info@naraoka.co.id",
                "customer_phone" => "024-1234567",
                "customer_address_detail" => null,
                "customer_zip_code" => "12420",
                "zone_code" => "CGKFT",
                "organization_id" => 6,
                "location_id" => "5cecb20b6c49615b174c3e74"
            ],
            "destination_data" => [
                "customer_name" => "PT AMARIS HOTEL SIMPANG LIMA",
                "customer_address" => "JL. KH. AHMAD DAHLAN NO. 01, SEMARANG TENGAH",
                "customer_email" => "ma.syaputra@gmail.com",
                "customer_phone" => "0248453499",
                "customer_address_detail" => "KOTA SEMARANG SEMARANG TENGAH KARANGKIDUL",
                "customer_zip_code" => "50241",
                "zone_code" => "SMG",
                "organization_id" => 6,
                "location_id" => "5cecb20b6c49615b174c3e74"
            ],
            "koli_data" => [
                [
                    "koli_length" => 0,
                    "awb_url" => "https://tracking.mile.app/label/AWB00100209082020.1",
                    "created_at" => "2022-04-13 23:30:05",
                    "koli_chargeable_weight" => 9,
                    "koli_width" => 0,
                    "koli_surcharge" => [
                    ],
                    "koli_height" => 0,
                    "updated_at" => "2022-04-13 23:30:05",
                    "koli_description" => "V WARP",
                    "koli_formula_id" => null,
                    "connote_id" => "f70670b1-c3ef-4caf-bc4f-eefa702092ed",
                    "koli_volume" => 0,
                    "koli_weight" => 9,
                    "koli_id" => "e2cb6d86-0bb9-409b-a1f0-389ed4f2df2d",
                    "koli_custom_field" => [
                        "awb_sicepat" => null,
                        "harga_barang" => null
                    ],
                    "koli_code" => "AWB00100209082020.1"
                ],
                [
                    "koli_length" => 0,
                    "awb_url" => "https://tracking.mile.app/label/AWB00100209082020.2",
                    "created_at" => "2022-04-13 23:30:05",
                    "koli_chargeable_weight" => 9,
                    "koli_width" => 0,
                    "koli_surcharge" => [
                    ],
                    "koli_height" => 0,
                    "updated_at" => "2022-04-13 23:30:05",
                    "koli_description" => "V WARP",
                    "koli_formula_id" => null,
                    "connote_id" => "f70670b1-c3ef-4caf-bc4f-eefa702092ed",
                    "koli_volume" => 0,
                    "koli_weight" => 9,
                    "koli_id" => "3600f10b-4144-4e58-a024-cc3178e7a709",
                    "koli_custom_field" => [
                        "awb_sicepat" => null,
                        "harga_barang" => null
                    ],
                    "koli_code" => "AWB00100209082020.2"
                ],
                [
                    "koli_length" => 0,
                    "awb_url" => "https://tracking.mile.app/label/AWB00100209082020.3",
                    "created_at" => "2022-04-13 23:30:05",
                    "koli_chargeable_weight" => 2,
                    "koli_width" => 0,
                    "koli_surcharge" => [
                    ],
                    "koli_height" => 0,
                    "updated_at" => "2022-04-13 23:30:05",
                    "koli_description" => "LID HOT CUP",
                    "koli_formula_id" => null,
                    "connote_id" => "f70670b1-c3ef-4caf-bc4f-eefa702092ed",
                    "koli_volume" => 0,
                    "koli_weight" => 2,
                    "koli_id" => "2937bdbf-315e-4c5e-b139-fd39a3dfd15f",
                    "koli_custom_field" => [
                        "awb_sicepat" => null,
                        "harga_barang" => null
                    ],
                    "koli_code" => "AWB00100209082020.3"
                ]
            ],
            "custom_field" => [
                "catatan_tambahan" => "JANGAN DI BANTING / DI TINDIH"
            ],
            "currentLocation" => [
                "name" => "Hub Jakarta Selatan",
                "code" => "JKTS01",
                "type" => "Agent"
            ]
        ];

    }

    public function test_list_package_request()
    {
        $response = $this->get('api/v1/package');
        $response->assertStatus(200);
    }

    public function test_post_package_request(){
        $response = $this->post('api/v1/package',self::getData());
        $response->assertStatus(201);
    }
    public function test_put_package_request(){
        $response = $this->put('api/v1/package/3ba89417-6ba2-4e68-b616-c1ffd1773d31',self::getData());
        $response->assertStatus(200);
    }

    public function test_patch_package_request(){
        $data = [
            "customer_name" => "PT. AMARA Sejahtera"
        ];
        $response = $this->patch('api/v1/package/3ba89417-6ba2-4e68-b616-c1ffd1773d31',$data);
        $response->assertStatus(200);
    }
    public function test_delete_package_request(){
        $response = $this->delete('api/v1/package/3ba89417-6ba2-4e68-b616-c1ffd1773d31');
        $response->assertStatus(200);
    }

    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }
}
