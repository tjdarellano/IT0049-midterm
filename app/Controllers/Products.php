<?php
namespace App\Controllers;
use App\Models\ProductModel;
class Products extends BaseController
{
    private function pageData(): array { return ['title' => 'Products']; }
    public function index() { return view('products/index', array_merge($this->pageData(), ['products' => (new ProductModel())->orderBy('id', 'DESC')->findAll()])); }
    public function create()
    {
        if ($this->request->is('post')) {
            $rules = ['name'=>'required|max_length[100]', 'price'=>'required|decimal', 'stock_quantity'=>'required|is_natural'];
            if (! $this->validate($rules)) return view('products/form', array_merge($this->pageData(), ['errors'=>$this->validator->getErrors()]));
            $row = ['name'=>trim($this->request->getPost('name')), 'price'=>$this->request->getPost('price'), 'stock_quantity'=>$this->request->getPost('stock_quantity'), 'created_at'=>date('Y-m-d H:i:s')];
            $file = $this->request->getFile('image');
            if ($file && $file->isValid() && ! $file->hasMoved() && in_array($file->getMimeType(), ['image/jpeg','image/png','image/webp'], true)) { $name=$file->getRandomName(); $file->move(FCPATH.'uploads/products', $name); $row['image']=$name; }
            (new ProductModel())->insert($row); return redirect()->to('/products')->with('success','Product added.');
        }
        return view('products/form', $this->pageData());
    }
    public function edit($id)
    {
        $model=new ProductModel(); $product=$model->find($id); if (! $product) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($this->request->is('post')) {
            $rules=['name'=>'required|max_length[100]','price'=>'required|decimal','stock_quantity'=>'required|is_natural'];
            if (! $this->validate($rules)) return view('products/form', array_merge($this->pageData(), ['product'=>$product,'errors'=>$this->validator->getErrors()]));
            $row=['name'=>trim($this->request->getPost('name')),'price'=>$this->request->getPost('price'),'stock_quantity'=>$this->request->getPost('stock_quantity')]; $file=$this->request->getFile('image');
            if ($file && $file->isValid() && ! $file->hasMoved() && in_array($file->getMimeType(), ['image/jpeg','image/png','image/webp'], true)) { $name=$file->getRandomName(); $file->move(FCPATH.'uploads/products',$name); $row['image']=$name; }
            $model->update($id,$row); return redirect()->to('/products')->with('success','Product updated.');
        }
        return view('products/form', array_merge($this->pageData(), ['product'=>$product]));
    }
    public function delete($id) { (new ProductModel())->delete($id); return redirect()->to('/products')->with('success','Product deleted.'); }
}
