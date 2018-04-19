<?php
class PostsController extends AppController {
	public $helpers = array('Html', 'Form');
	public $components = array('Session');

	public function index() {
		$this->loadModel('User');
		$this->set('posts', $this->Post->find('all'));
		$this->set('users', $this->User->find('all'));
	}

	public function view($slug = null) {
		$this->loadModel('User');
		if (!$slug) {
			throw new NotFoundException(__('Đường dẫn không hợp lệ'));
		}

		$post = $this->Post->find('first', array('conditions' => array('slug' => $slug)));
		if (!$post) {
			throw new NotFoundException(__('Bài viết không tồn tại'));
		}
		$this->Post->id = $post['Post']['id'];
		$count = $post['Post']['view_count'] + 1;
		$this->Post->saveField('view_count', $count);
		$this->set('post', $post);
		$this->set('users', $this->User->find('all'));
		$this->set('posts', $this->Post->find('all', array('limit' => 2, 'order' => 'modified')));
	}

	public function list_ajax() {
		$this->layout = 'ajax';
		$this->autoRender = false;
		$this->set('posts', $this->Post->find('all', array('limit' => 2, 'order' => 'modified DESC')));
		$this->render('list_ajax');
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('Bài viết mới đã được thêm.'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Không thể thêm bài viết mới.'));
		}
	}

	public function edit($slug = null) {
		if (!$slug) {
			throw new NotFoundException(__('Đường dẫn không hợp lệ'));
		}

		$post = $this->Post->find('first', array('conditions' => array('slug' => $slug)));
		if (!$post) {
			throw new NotFoundException(__('Bài viết không tồn tại'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Post->id = $post['Post']['id'];
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('Bài viết đã được cập nhật'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('KHông thể cập nhật bài viết'));
		}

		if (!$this->request->data) {
			$this->request->data = $post;
		}
	}

	public function search() {
		$keyword = $this->params['url']['keyword'];
		if (!$keyword) {
			throw new NotFoundException(__('Đường dẫn không hợp lệ'));
		}
		$this->set('posts', $this->Post->find('all', array('conditions' => array('title LIKE' => "%$keyword%"))));
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Post->delete($id)) {
			$this->Session->setFlash(
				__('Bài viết có ID là %s đã bị xóa.', h($id))
			);
		} else {
			$this->Session->setFlash(
				__('Không thể xóa bài viết có ID %s.', h($id))
			);
		}

		$this->redirect(array('action' => 'index'));
	}
}