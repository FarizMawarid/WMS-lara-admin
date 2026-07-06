<?php

namespace Tests\Feature;

use App\Models\ProductType;
use App\Models\Rack;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionAndImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_transaction_in_page_shows_product_type_and_rack_options(): void
    {
        ProductType::create([
            'po' => 'PO-001',
            'kp' => 'KP-001',
            'season' => 'S1',
            'style' => 'STY-001',
            'destination' => 'JKT',
        ]);

        Rack::create([
            'rack_code' => 'R-001',
        ]);

        $response = $this->get('/admin/finish-goods-manual');

        $response->assertOk();
        $response->assertViewHas('productTypes', function ($productTypes) {
            return $productTypes->contains('po', 'PO-001');
        });
        $response->assertViewHas('racks', function ($racks) {
            return $racks->contains('rack_code', 'R-001');
        });
    }

    public function test_transaction_in_can_be_stored_and_template_can_be_downloaded(): void
    {
        ProductType::create([
            'po' => 'PO-001',
            'kp' => 'KP-001',
            'season' => 'S1',
            'style' => 'STY-001',
            'destination' => 'JKT',
        ]);

        Rack::create([
            'rack_code' => 'R-001',
        ]);

        $response = $this->post('/admin/finish-goods-manual', [
            'po' => 'PO-001',
            'style' => 'STY-001',
            'destination' => 'JKT',
            'qty_carton' => 10,
            'qty_garment' => 100,
            'rack_code' => 'R-001',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('finish_goods_transactions', [
            'po' => 'PO-001',
            'action_type' => 'in',
        ]);

        $download = $this->get('/admin/product-type/template');

        $download->assertOk();
        $download->assertHeader('content-type', 'text/csv; charset=UTF-8');
    }
}
