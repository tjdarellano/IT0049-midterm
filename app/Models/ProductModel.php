<?php
namespace App\Models; use CodeIgniter\Model;
class ProductModel extends Model { protected $table='products'; protected $returnType='array'; protected $allowedFields=['name','price','stock_quantity','image','created_at']; }
