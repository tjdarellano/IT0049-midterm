<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
class PosSeeder extends Seeder
{
    public function run()
    {
        $now=date('Y-m-d H:i:s');
        $users = $this->db->table('users');
        if (!$users->where('username', 'admin')->countAllResults()) {
            $users->insert(['username'=>'admin','full_name'=>'System Administrator','password'=>password_hash('admin123',PASSWORD_DEFAULT),'created_at'=>$now]);
        }
        $products = $this->db->table('products');
        if ($products->countAllResults() === 0) {
            $products->insertBatch([['name'=>'Coffee','price'=>75,'stock_quantity'=>50,'created_at'=>$now],['name'=>'Sandwich','price'=>120,'stock_quantity'=>25,'created_at'=>$now]]);
        }
    }
}
