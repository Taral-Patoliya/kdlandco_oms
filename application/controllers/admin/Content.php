<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers get a jumpstart their development of CodeIgniter applications
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2013, Bonfire Dev Team
 * @license   http://guides.cibonfire.com/license.html
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Content context controller
 *
 * The controller which displays the homepage of the Content context in Bonfire site.
 *
 * @package    Bonfire
 * @subpackage Controllers
 * @category   Controllers
 * @author     Bonfire Dev Team
 * @link       http://guides.cibonfire.com/helpers/file_helpers.html
 *
 */
class Content extends Admin_Controller
{


	/**
	 * Controller constructor sets the Title and Permissions
	 *
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('pending_tasks/pending_tasks_model');
		$this->load->model('roles/role_model');
		$this->load->model('users/user_model');
		$this->lang->load('pending_tasks/pending_tasks');
		Assets::add_js('jquery.dataTables.min.js');
		Assets::add_js('bootstrap-dataTables.js');
		Assets::add_css('datatable-rtl.css');
        Assets::add_css('bootstrap-dataTables.css');

		Template::set('toolbar_title', 'Dashboard');

		$this->auth->restrict('Site.Content.View');
	}//end __construct()

	//--------------------------------------------------------------------

	/**
	 * Displays the initial page of the Content context
	 *
	 * @return void
	 */
	public function index()
	{
		//$user = $this->auth->user();
		$records = array();
		$tasks = $this->pending_tasks_model->find_all();
		$users_collection = $this->user_model->find_all();
		$users = array();

        $today = date('Y-m-d');
		foreach ($tasks as $task) {
            $str = strtotime($task->created_on);
            $days = $task->remind_after;
            $date = date('Y-m-d',strtotime("+{$days} day",$str));
            if(strtotime($today) == strtotime($date)){
                $records[] = $task;
            }
		}
		foreach ($users_collection as $user_item) {
			$users[$user_item->id] = $user_item->username;
		}

		Template::set('records', $records);
		Template::set('users',$users);
		Template::set_block('pending_tasks','pending_tasks/content/dashboard');
		Template::set_view('admin/content/index');
		Template::render();
	}

}