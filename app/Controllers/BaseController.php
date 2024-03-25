<?php

namespace App\Controllers;

use App\Entities\Account;
use App\Models\Department;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;

    /**
     * Hold the current employee information from the session
     *
     * @var Account
     */
    protected $account;

    /**
     * Stores the default auth view functions such as old
     *
     * @var array
     */
    protected static $ADD_USER_CONFIG = [];

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->session = \Config\Services::session();

        self::$ADD_USER_CONFIG['old'] = function ($key) {
            return $this->request->getPost($key);
        };
        // there's no need to load departments when user is not logged in
        if (!$this->session->get('user')) return;
        $this->account = $this->session->get('user');
        self::$ADD_USER_CONFIG['departments'] = model(Department::class)->findAll();
    }
}
