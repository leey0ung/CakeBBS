<?php
	class Thread extends AppModel{
		public $name = 'Thread';
		//virtual field
		public $virtualFields = array(
				'replys' => 'COUNT(Thread.id)'
		);
		//validate
	public $validate = array(
		'title' => array(
			'rule'=> 'notEmpty',
			'message'=>'件名を記入してください。'
			),
		'name' => array(
				'rule'=> 'notEmpty',
				'message'=>'名前を記入してください。'
			),
		'email' => array(
				'rule'=> array('email', false),
				'allowEmpty' => true,
				'message'=>'正しいメールアドレスを記入してください。'
			),
		'pwd' => array(
				array(
						'rule' => 'numeric',
						'allowEmpty' => true,
						 'message' => '数字を記入してください。'
					),
				array(
						'rule' => array('maxlength', 8),
						'message' => '8桁以内で記入してください。'
					)
			),
			'comment' => array(
					'rule' => 'notEmpty',
					'message' => 'コメントを記入てください。'
				)
		);

	}
?>