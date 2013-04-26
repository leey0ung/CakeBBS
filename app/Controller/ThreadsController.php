<?php
class ThreadsController extends AppController{
	/*
	 * controller name
	 * */
	// public
	public $name = 'Threads';
	/*
	 * model name
	 * */
	//public
	 public $uses = null;
	/*
	 * view
	 * */
	//public
	 public $autoRender = false;

	 public $autoLayout = false;

	 /* paginator*/
	 public $paginate = null;
	 public $limit = 10;
	 public $modulus = 6;

	 public $data = null;

	 /*
	  * JSヘルパー
	  */
	 public $helpers = array('Js');
//	public $helpers = array('Js' => array('Jquery'));

	public function index(){
		$this->name = 'Threads';
		$this->uses = null;
		$this->autoRender = true;
		/*
		 * フォワード
		 * */
		$this->setAction("displayThreads");

	}
/*****************************************************************************************/

	/*
	 *  新規スレッド作成の画面
	* ビュー関係: レンダリング+レイアウト
	* 関連ファイル：
	* 	テンプレート：\app\View\Threads\make_thread.ctp
	* 	レイアウト: \app\View\Layouts\CakeBBS.ctp
	*   スタイルシート: \app\webroot\css\cake.blue.css
	*
	* */
	public function makeThread(){
		$this->name = 'Threads';
		$this->uses = null;
		$this->autoRender = true;
		$this->autoLayout = true;
		$this->layout = 'CakeBBS';
	}

	/*
	 *  スレッド一覧画面
	* ビュー関係: レンダリング+レイアウト
	* 関連ファイル：
	* 	テンプレート：\app\View\Threads\make_thread.ctp
	* 	レイアウト: \app\View\Layouts\CakeBBS.ctp
	*   スタイルシート: \app\webroot\css\cake.blue.css
	*
	* 問題点: スレッド一つ当たりのレスの件数を取得(データベースを何回もアクセス)
	* */

	public function displayThreads(){
		$this->name = 'Threads';
		$this->uses = array('Thread','Response');

		$this->limit = 5;
		$this->modulus = 4;

/*
		$this->Response->bindModel(
			array(
				'belongsTo' => array(
					'Thread' => array(
						'className' => 'Thread',
						'conditions' => '',
						'order' =>'',
						'dependent' => false,
						'foreignKey' => 'threadid'
					)

				)
			)
		);
*/

		$this->paginate = array(
				'page' => 1,
				'conditions' => array(),
				'fields' => array('id','title','name','click','updatetime'),
				/*
			 	'joins' => array(
								array(
									 'type' => 'INNER',
									 'table' => 'responses',
									 'alias' => 'Response',
									 'conditions' => 'Thread.id = Response.threadid'
									)
							),
				'group' => 'Thread.id',
				*/
				'sort' =>'updatetime',
				'limit' => $this->limit,
				'direction' => 'desc',
				'recursive' => 0
		);

		$this->data = $this->paginate('Thread');


		for($i=0; $i <count($this->data); $i++){
			$count = $this->Response->find('count', array('conditions' => array('Response.threadid' => $this->data[$i]['Thread']['id'])));
			$this->data[$i]['Thread']['replys'] = $count;
		}

		$this->set('modulus', $this->modulus);
		$this->set('threads',$this->data);
		$this->autoRender = true;
		$this->autoLayout = true;
		$this->layout = 'CakeBBS';
	}

	public function viewThread(){
		$this->name = 'Threads';
		$this->uses = array('Thread','Response');

		if(empty($this->request->params['named']['id'])){
			$id = $this->request->data['threadid']; // post
		}else{
			$id = $this->request->params['named']['id']; //get
		}
		$this->limit = 5;
		$this->modulus = 4;

		$this->data = $this->Thread->findAllById($id);

		$this->Thread->id= $id;
		$this->Thread->saveField('click', ++$this->data[0]['Thread']['click']);

		$this->paginate = array(
				'page' => 1,
				'conditions' => array('Response.threadid' => $id),
				'fields' => array('id',' title','comment', 'name', 'email', 'updatetime', 'showflag'),
				'sort' =>'updatetime',
				'limit' => $this->limit,
				'direction' => 'asc',
				'recursive' => 0
		);

		$data = $this->paginate('Response');
//$data = $this->Response->find('all', array('conditions' => array('Response.threadid' => $id)));
		$this->data['responses']= $data;
		$this->set('modulus', $this->modulus);
		$this->set('thread',$this->data);

		$this->autoRender = true;
		$this->autoLayout = true;
		$this->layout = 'CakeBBS';

	}
	public function saveThread(){
		$this->uses = array('Thread', 'Response');

		$mode = $this->request->data['mode'];
		$date = date('Y-m-d H:i:s');

		$showflag = 0;
		if(!empty($this->request->data['pwd'])){
			$showflag =1;
		}

		if(strcmp( $mode, 'thread' ) == 0){
			$this->Thread->set(array(
					'title' => $this->request->data['title'],
					'name' => $this->request->data['name'],
					'email' => $this->request->data['email'],
					'pwd' => $this->request->data['pwd'],
					'showflag' => $showflag,
					'comment' => $this->request->data('comment'),
					'createtime' => $date,
					'updatetime' => $date
			));

			if($this->Thread->save()){
				$this->setAction('displayThreads');
			}else{
				$this->setAction('makeThread');
			}
		}else if(strcmp($mode, 'response') == 0){
			$id = $this->request->data['threadid'];
			$this->Response->set(array(
					'threadid' => $id,
					'title' => $this->request->data['title'],
					'name' => $this->request->data['name'],
					'email' => $this->request->data['email'],
					'pwd' => $this->request->data['pwd'],
					'showflag' => $showflag,
					'comment' => $this->request->data('comment'),
					'createtime' => $date,
					'updatetime' => $date
			));

			 if($this->Response->save()){
			 	$this->redirect('/threads/viewThread/id:'. $id);
			 }else{
				$this->setAction('viewThread');
			 }
		}else{}
	}

	public function editThread(){
		$this->name = 'Threads';
		$this->uses = array('Thread','Response');

		$mode = $this->request->data['edit']['mode'];
		$id = $this->request->data['edit']['id'];
		$selected = $this->request->data['edit']['selected'];
		if('delete' === $selected){
			if('thread' === $mode){
				$this->Thread->delete($id);
				$this->redirect('/threads/displayThreads');

			}else if('response' === $mode){
					$record = $this->Response->findAllById($id);
					$threadid = $record[0]['Response']['threadid'];
					//echo $threadid;
					$this->Response->delete($id);
					$this->redirect('/threads/viewThread/id:'. $threadid);
					// viewThread

			}
		}else if('edit' === $selected){
			//session
			$rec = null;
			if('thread' === $mode){
				$this->data = $this->Thread->findAllById($id);
				$rec = $this->data[0]['Thread'];
			}else if('response' === $mode){
				$this->data = $this->Response->findAllById($id);
				$rec = $this->data[0]['Response'];

			}
			$this->Session->write('title', $rec['title']);
			$this->Session->write('email', $rec['email']);
			$this->Session->write('comment', $rec['comment']);
			$this->redirect(array('action' => 'modifyThread', 'id' => $id, 'mode' => $mode));
		}
		//do error

	}

	public function modifyThread(){
		$this->name = 'Threads';
		if(empty($this->request->params['named']['id'])){
			$this->set('id',$this->request->data['id']); // post
		}else{
			$this->set('id',$this->request->params['named']['id']); //get
		}
		if(empty($this->request->params['named']['mode'])){
			$this->set('mode',$this->request->data['mode']); // post
		}else{
			$this->set('mode',$this->request->params['named']['mode']); //get
		}

		// from session
		if($this->request->isPost()){
			$this->set('title', $this->request->data['title']);
			$this->set('email', $this->request->data['email']);
			$this->set('comment',$this->request->data('comment'));
		}else{
			$this->set('title',$this->Session->read('title'));
			$this->set('email',$this->Session->read('email'));
			$this->set('comment',$this->Session->read('comment'));
		}

		$this->autoRender = true;
		$this->autoLayout = true;
		$this->layout = 'CakeBBS';
	}

	public function updateThread(){
		$this->name = 'Threads';
		$this->uses = array('Thread','Response');

		$id = $this->request->data['id'];
		$mode = $this->request->data['mode'];
	//	print_r($this->request->data);
		$date = date('Y-m-d H:i:s');
		if(strcmp( $mode, 'thread' ) == 0){
			$this->Thread->set(array(
					'id' => $id,
					'title' => $this->request->data['title'],
					'email' => $this->request->data['email'],
					'comment' => $this->request->data('comment'),
					'updatetime' => $date
			));
			if($this->Thread->save()){
				$this->redirect('/threads/viewThread/id:'. $id);
			}else{
				$this->setAction('modifyThread');
			}
		}else if(strcmp($mode, 'response') == 0){
			$this->Response->set(array(
					'id' => $id,
					'title' => $this->request->data['title'],
					'email' => $this->request->data['email'],
					'comment' => $this->request->data('comment'),
					'updatetime' => $date
			));
			if($this->Response->save()){
				$this->data = $this->Response->findAllById($id);
				$this->redirect('/threads/viewThread/id:'. $this->data[0]['Response']['threadid']);
			}else{
				$this->setAction('modifyThread');
			}
		}else{

		}
		//do error
	}
		public function ajaxcheck (){
			$this->name = 'Threads';
			$this->uses = array('Thread','Response');
			Configure::write('debug', 0);

			$mode = $this->request->data['edit']['mode'];
			$id = $this->request->data['edit']['id'];
			$pwd = $this->request->data['edit']['pwd'];

			$password =null;
			if('thread' === $mode){
				$record = $this->Thread->findAllById($id);
				$password = $record[0]['Thread']['pwd'];
			}else if('response' === $mode){
				$record = $this->Response->findAllById($id);
				$password = $record[0]['Response']['pwd'];
			}
			if(!empty($pwd) && strcmp($pwd, $password) == 0){
				echo 1;
			}else{
				echo 0;
			}
			$this->layout = 'ajax';
		}
		//test ajax
		public function disAjaxupdate(){
			$this->name = 'Threads';
			$this->uses = null;
			Configure::write('debug', 0);
			$this->autoRender = true;
			$this->autoLayout = true;
			$this->layout = 'CakeBBS';
		}

}
?>