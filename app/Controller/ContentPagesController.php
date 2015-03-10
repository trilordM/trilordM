<?php
App::uses('AppController', 'Controller');

/**
 * ContentPages Controller
 *
 * @property ContentPage $ContentPage
 * @property PaginatorComponent $Paginator
 */
class ContentPagesController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Useful');

    public function beforeFilter()
    {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('view');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->ContentPage->recursive = 0;
        $this->set('contentPages', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($slug = null)
    {
        if (empty($slug)) {
            throw new NotFoundException(__('Invalid content page'));
        }
        $contentPage = $this->ContentPage->findBySlug($slug);

        $user_stats = $this->ContentPage->query("select count(id) NewProfile,
										(select count(id) from users where role='ServiceProvider' and status=1) TotalProvider,
										(select count(id) from service_categories where is_active=1) TotalCategory,
										(select count(id) from users where role='ServiceSeeker' and status=1) TotalSeeker,
										(select count(id) from seeker_provider_requests where  status='Completed') Completed
										 from users
										 where 
										 status = 1 and role = 'ServiceProvider' and created_date between  (CURDATE()- INTERVAL 30 DAY) and CURDATE()");

        $title_for_layout = $contentPage['ContentPage']['title'];
        $hideSearchBar = true;
        $this->set(compact('contentPage', 'title_for_layout', 'user_stats', 'hideSearchBar'));
    }


    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->ContentPage->recursive = 0;
        $this->set('contentPages', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {
        if (!$this->ContentPage->exists($id)) {
            throw new NotFoundException(__('Invalid content page'));
        }
        $options = array('conditions' => array('ContentPage.' . $this->ContentPage->primaryKey => $id));
        $this->set('contentPage', $this->ContentPage->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $getMaxOrder = $this->ContentPage->find('first', array(
                'fields' => array('MAX(ContentPage.content_order) as max_order')
            ));

            $this->request->data['ContentPage']['content_order'] = $getMaxOrder[0]['max_order'] + 1;
            $this->request->data['ContentPage']['slug'] = $this->Useful->stringToSlug($this->request->data['ContentPage']['title']);
            $this->ContentPage->create();
            if ($this->ContentPage->save($this->request->data)) {
                $this->Session->setFlash('The content page has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The content page could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        }
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        if (!$this->ContentPage->exists($id)) {
            throw new NotFoundException(__('Invalid content page'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['ContentPage']['slug'] = $this->Useful->stringToSlug($this->request->data['ContentPage']['title']);
            if ($this->ContentPage->save($this->request->data)) {
                $this->Session->setFlash('The content page has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The content page could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ContentPage.' . $this->ContentPage->primaryKey => $id));
            $this->request->data = $this->ContentPage->find('first', $options);
        }
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null)
    {
        $this->ContentPage->id = $id;
        if (!$this->ContentPage->exists()) {
            throw new NotFoundException(__('Invalid content page'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ContentPage->delete()) {
            $this->Session->setFlash('The content page has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The content page could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }
}
