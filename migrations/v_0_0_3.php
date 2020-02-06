<?php

namespace kemrash\dontcopy\migrations;

class v_0_0_3 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['kemrash_dontcopy']) && version_compare($this->config['kemrash_dontcopy'], '0.0.3', '>=');
	}
	
	public static function depends_on()
	{
		return array('\phpbb\db\migration\data\v320\v320');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('kemrash_dontcopy', '0.0.3')),
			array('permission.add', array('f_kemrash_dontcopy', 0, 1, 0)),
		);
	}
}