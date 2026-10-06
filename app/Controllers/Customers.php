<?php
namespace App\Controllers;
use App\Models\CustomerModel;
class Customers extends BaseController
{
    public function index() { return view('customers/index', ['customers'=>(new CustomerModel())->orderBy('id','DESC')->findAll()]); }
    public function create()
    {
        if ($this->request->is('post')) {
            if (! $this->validate(['full_name'=>'required|max_length[100]','email'=>'required|valid_email','phone'=>'permit_empty|max_length[20]'])) return view('customers/form',['errors'=>$this->validator->getErrors()]);
            (new CustomerModel())->insert(['full_name'=>$this->request->getPost('full_name'),'email'=>$this->request->getPost('email'),'phone'=>$this->request->getPost('phone'),'created_at'=>date('Y-m-d H:i:s')]); return redirect()->to('/customers')->with('success','Customer added.');
        }
        return view('customers/form');
    }
    public function edit($id)
    {
        $model=new CustomerModel(); $customer=$model->find($id); if (! $customer) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($this->request->is('post')) { $model->update($id,['full_name'=>$this->request->getPost('full_name'),'email'=>$this->request->getPost('email'),'phone'=>$this->request->getPost('phone')]); return redirect()->to('/customers')->with('success','Customer updated.'); }
        return view('customers/form',['customer'=>$customer]);
    }
    public function delete($id) { (new CustomerModel())->delete($id); return redirect()->to('/customers')->with('success','Customer deleted.'); }
}
