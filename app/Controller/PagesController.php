<?php
App::uses('AppController', 'Controller');
/**
 * Pages Controller
 *
 * @property Page $Page
 */
class PagesController extends AppController {


	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Page->recursive = 0;
		$this->set('pages', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @throws NotFoundException
	 * @return void
	 */
	public function view($id = null) {
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		$this->set('page', $this->Page->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Page->create();
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'));
			}
		}
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @throws NotFoundException
	 * @return void
	 */
	public function edit($id = null) {
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Page->read(null, $id);
		}
	}

	/**
	 * delete method
	 *
	 * @param string $id
	 * @throws NotFoundException
	 * @throws MethodNotAllowedException
	 * @return void
	 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->Page->delete()) {
			$this->Session->setFlash(__('Page deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Page was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
