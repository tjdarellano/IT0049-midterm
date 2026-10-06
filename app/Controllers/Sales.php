<?php
namespace App\Controllers;
use App\Models\ProductModel; use App\Models\CustomerModel; use App\Models\SaleModel;
class Sales extends BaseController
{
    public function index()
    {
        $db=\Config\Database::connect(); $sales=$db->table('sales s')->select('s.*,p.name product_name,c.full_name customer_name,u.full_name staff_name')->join('products p','p.id=s.product_id')->join('customers c','c.id=s.customer_id','left')->join('users u','u.id=s.sold_by')->orderBy('s.id','DESC')->get()->getResultArray(); return view('sales/index',['sales'=>$sales]);
    }
    public function create()
    {
        $products=new ProductModel();
        if ($this->request->is('post')) {
            $product=$products->find($this->request->getPost('product_id')); $quantity=(int)$this->request->getPost('quantity');
            if (! $product || $quantity<1) return redirect()->back()->withInput()->with('error','Select a valid product and quantity.');
            if ($quantity>(int)$product['stock_quantity']) return redirect()->back()->withInput()->with('error','Sale rejected: requested quantity exceeds available stock.');
            $db=\Config\Database::connect(); $db->transStart(); $products->update($product['id'],['stock_quantity'=>$product['stock_quantity']-$quantity]); (new SaleModel())->insert(['product_id'=>$product['id'],'customer_id'=>$this->request->getPost('customer_id')?:null,'sold_by'=>session()->get('user_id'),'quantity'=>$quantity,'total_price'=>$quantity*(float)$product['price'],'created_at'=>date('Y-m-d H:i:s')]); $db->transComplete();
            if (! $db->transStatus()) return redirect()->back()->withInput()->with('error','The sale could not be saved.'); return redirect()->to('/sales')->with('success','Sale recorded and inventory updated.');
        }
        return view('sales/form',['products'=>$products->where('stock_quantity >',0)->findAll(),'customers'=>(new CustomerModel())->orderBy('full_name')->findAll()]);
    }
}
