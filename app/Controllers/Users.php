<?php
namespace App\Controllers;
use App\Models\UserModel;
class Users extends BaseController
{
    public function index() { return view('users/index',['users'=>(new UserModel())->orderBy('id','DESC')->findAll()]); }
    public function create()
    {
        if ($this->request->is('post')) {
            if (! $this->validate(['username'=>'required|max_length[50]','full_name'=>'required|max_length[100]','password'=>'required|min_length[6]'])) return view('users/form',['errors'=>$this->validator->getErrors()]);
            $row=['username'=>$this->request->getPost('username'),'full_name'=>$this->request->getPost('full_name'),'password'=>password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),'created_at'=>date('Y-m-d H:i:s')]; $file=$this->request->getFile('avatar');
            if ($file && $file->isValid() && ! $file->hasMoved() && in_array($file->getMimeType(),['image/jpeg','image/png','image/webp'],true)) { $name=$file->getRandomName(); $file->move(FCPATH.'uploads/avatars',$name); $row['avatar']=$name; }
            (new UserModel())->insert($row); return redirect()->to('/staff')->with('success','Staff member added.');
        }
        return view('users/form');
    }
    public function edit($id)
    {
        $model=new UserModel(); $user=$model->find($id); if (! $user) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        if ($this->request->is('post')) { $data=['username'=>$this->request->getPost('username'),'full_name'=>$this->request->getPost('full_name')]; if ($this->request->getPost('password')) $data['password']=password_hash($this->request->getPost('password'),PASSWORD_DEFAULT); $file=$this->request->getFile('avatar'); if ($file && $file->isValid() && ! $file->hasMoved() && in_array($file->getMimeType(),['image/jpeg','image/png','image/webp'],true)) { $name=$file->getRandomName(); $file->move(FCPATH.'uploads/avatars',$name); $data['avatar']=$name; } $model->update($id,$data); return redirect()->to('/staff')->with('success','Staff member updated.'); }
        return view('users/form',['user'=>$user]);
    }
    public function delete($id) { if ((int)$id===(int)session()->get('user_id')) return redirect()->to('/staff')->with('error','You cannot delete your own account.'); (new UserModel())->delete($id); return redirect()->to('/staff')->with('success','Staff member deleted.'); }
}
