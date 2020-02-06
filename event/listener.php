<?php
namespace kemrash\dontcopy\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.permissions' => 'add_permissions',
			'core.page_header_after' => 'dontcopy',
		);
	}

	protected $auth;
	protected $template;

	/**
	* Constructor
	*/
	public function __construct(\phpbb\auth\auth $auth, \phpbb\template\template $template)
	{
		$this->auth = $auth;
		$this->template = $template;
	}
	
	public function dontcopy($event)
	{
		if ($this->auth->acl_get('f_kemrash_dontcopy', $event['item_id']))
		{
			$this->template->assign_vars(array(
			'KEMRASH_DONTCOPY' => true,
			));
		}
	}

	public function add_permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions['f_kemrash_dontcopy'] = array('lang' => 'ACL_F_KEMRASH_DONTCOPY', 'cat' => 'actions');
		$event['permissions'] = $permissions;
	}
}
