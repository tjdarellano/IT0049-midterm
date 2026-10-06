<?php
namespace App\Controllers;
use App\Models\ProductModel; use App\Models\CustomerModel; use App\Models\SaleModel; use App\Models\UserModel;
class Dashboard extends BaseController { public function index(){return view('dashboard', ['counts'=>['products'=>(new ProductModel())->countAll(),'customers'=>(new CustomerModel())->countAll(),'staff'=>(new UserModel())->countAll(),'sales'=>(new SaleModel())->countAll()]]); } }
