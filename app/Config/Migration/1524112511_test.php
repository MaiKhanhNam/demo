<?php
class Test extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'test';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'posts' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'title' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'content' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'slug' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'created' => array('type' => 'integer', 'null' => true, 'default' => null),
					'modified' => array('type' => 'integer', 'null' => true, 'default' => null),
					'view_count' => array('type' => 'integer', 'null' => true, 'default' => '0'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'slug' => array('column' => 'slug', 'unique' => 1),
						'title' => array('column' => 'title', 'unique' => 0),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'users' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'username' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'email' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'password' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'role' => array('type' => 'boolean', 'null' => true, 'default' => null),
					'created' => array('type' => 'integer', 'null' => true, 'default' => null),
					'created_by' => array('type' => 'integer', 'null' => true, 'default' => null),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'unix_username' => array('column' => 'username', 'unique' => 1),
						'unix_email' => array('column' => 'email', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'posts', 'users'
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		App::uses('Post', 'Model');
		$posts = new Post();
//		$posts = ClassRegistry::init('Post');
		if ($direction == 'up') {
			$data = [];
			for ($i = 0; $i >= 2; $i++) {
				$data[$i]['Post']['title'] = file_get_contents('https://loripsum.net/api/1/short/plaintext');
				$data[$i]['Post']['content'] = file_get_contents('https://loripsum.net/api/4/long/decorate');
			}
			$posts->create();
			if ($posts->saveAll($data)) {
				$this->callback->out('posts table has been initialized');
			}
		}
		return true;
	}
}
