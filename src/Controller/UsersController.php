<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event){
        $this -> Auth -> allow(['signup', 'forgotPassword']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {   
        $users;

        $session = $this->request->getSession();
        if($session->read('Auth.User.role_id') == 1){
            $users = $this->paginate($this->Users);
        }else{
            // echo $this->Users->get($session->read('Auth.User.id'));
            $query = $this->Users->find('all') -> where(['id'=>$session->read('Auth.User.id')]);
            $users = $this->paginate($query);
        }
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            //Set default role_id as 3(user)
            $user->role_id = 3;
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function signup(){

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

            //Set default role_id as 3(user)
            $user->role_id = 3;
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                $this->Auth->setUser($user);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function login(){
        
        // Write login function

        //If the user has already logged in
        if($this->Auth->user('id')){
            $this->Flash->warning(__('Already logged in !'));
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }
        
        //If the request is a post request
        if($this->request->is('post')){
            

            // Identify the user
            $user = $this->Auth->identify();
                
            if($user){
                // Store user details in session
                $this->Auth->setUser($user);
                $this->Flash->success(__('Login Successful'));
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);

                // $this -> set(compact('user'));
                // $this -> set('_serialize', ['user']);
            }
    
            $this -> Flash -> error(__('Sorry! The login was unsuccessful.'));
        }
    }

    public function logout(){
        $this -> Flash -> success(__('Logged out successfully!')); 
        return $this -> redirect($this->Auth->logout());
    }

    public function changePassword(){
        
        $session = $this->request->getSession();
        $user = $this->Users->get($session->read('Auth.User.id'), [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $user->password = $this->request->getData('password');
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Password changed successfully'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not change the password. Please, try again.'));
        }
        $this->set(compact('user'));
    }
}