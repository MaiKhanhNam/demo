<?php
class Posts extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'Posts';

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
					'title' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 255, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'content' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'slug' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 255, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
		$posts = ClassRegistry::init('Post');
		if ($direction == 'up') {
			for ($i = 0; $i < 500000; $i++) {
				$data['Post']['title'] = $this->randomText();
				$data['Post']['content'] = $this->randomText(50);
				$posts->create();
				$posts->save($data);
			}
			$this->callback->out('posts table has been initialized');
		}
		return true;
	}

	private function randomText($number = 10) {
		$sample = array('Lorem','ipsum','dolor','sit','amet','consectetur','adipiscing','elit','Suspendisse','et','nibh','vel','sem','vulputate','hendrerit','finibus','nunc','Curabitur','metus','ac','imperdiet','Donec','lectus','est','sollicitudin','leo','sed','aliquet','porta','urna','Pellentesque','eu','malesuada','magna','quis','mi','Vestibulum','in','iaculis','nulla','Nam','sodales','risus','viverra','sapien','laoreet','Nunc','condimentum','lobortis','facilisis','neque','interdum','purus','vitae','volutpat','molestie','massa','In','hac','habitasse','platea','dictumst','Fusce','ligula','feugiat','tristique','id','Aliquam','erat','Ut','nec','ut','ante','ultrices','Nullam','blandit','felis','mattis','ullamcorper','eget','libero','rutrum','Phasellus','velit','eros','auctor','Sed','egestas','quam','bibendum','non','odio','sagittis','congue','Nulla','posuere','fermentum','dignissim','tellus','orci','at','Etiam','vestibulum','vehicula','a','mauris','Integer','pretium','porttitor','scelerisque','efficitur','Aenean','turpis','Orci','varius','natoque','penatibus','magnis','dis','parturient','montes','nascetur','ridiculus','mus','tincidunt','cursus','pulvinar','lorem','semper','dapibus','Mauris','Praesent','venenatis','mollis','lacus','Maecenas','pellentesque','Duis','tempus','Quisque','eleifend','dictum','nisi','lacinia','Vivamus','convallis','diam','ultricies','gravida','maximus','ex','arcu','justo','rhoncus','consequat','augue','enim','tortor','dui','commodo','luctus','ornare','nisl','aliquam','faucibus','tempor','potenti','pharetra','Cras');
		$text = $sample[array_rand($sample)];
		for ($i = 0; $i < $number - 1; $i++) {
			$text .= ' '.$sample[array_rand($sample)];
		}
		return ucfirst($text).'.';
	}
}
