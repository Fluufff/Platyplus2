<?php

namespace App\Controllers;

use CodeIgniter\Shield\Controllers\LoginController as ShieldLogin;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Traits\Viewable;
use CodeIgniter\Shield\Validation\ValidationRules;
use OpenApi\Attributes as OA;

#[OA\Info(
  title: "Login",
  version: "1.0.0",
  description: "Returns login information" 
)]
class LoginController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return ResponseInterface
     */
    #[OA\Get(
        path: "/api/v1/login",
        summary: "Returns login information.",
        description: "Retrieves the connection state and, if connected, the user information."
    )]
    #[OA\Response(response: '200', description: 'User login information')]
    public function index()
    {
        $respond = [
            "user" => auth()->user()
        ];

        return $this->respond(
            $respond
        );
    }

    /**
     * Return the properties of a resource object
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return ResponseInterface
     */
    #[OA\Post(
        path: "/api/v1/login",
        summary: "Login the user.",
        description: "Send the username and password to connect the user"
    )]
    #[OA\Request(
        required: true,
        content: [application/x-www-form-urlencoded => ""]
    )]
    #[OA\Response(response: '200', description: 'User logged in')]
    #[OA\Response(response: '400', description: 'Login failed')]
    public function create()
    {
        return $this->loginAction();
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }

    /**
     * Attempts to log the user in.
     */
    public function loginAction(): ResponseInterface
    {
        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = $this->getValidationRules();

        if (! $this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
            return $this->respond( $this->validator->getErrors(), 400 );
        }

        /** @var array $credentials */
        $credentials             = $this->request->getPost(setting('Auth.validFields')) ?? [];
        $credentials             = array_filter($credentials);
        $credentials['password'] = $this->request->getPost('password');
        $remember                = (bool) $this->request->getPost('remember');

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // Attempt to login
        $result = $authenticator->remember($remember)->attempt($credentials);
        if (! $result->isOK()) {
            return $this->respond( ["reason"=> $result->reason()], 400 );
        }

        // If an action has been defined for login, start it up.
        if ($authenticator->hasAction()) {
//            return redirect()->route('auth-action-show')->withCookies();
        }

        return $this->index();
    }

    /**
     * Returns the rules that should be used for validation.
     *
     * @return array<string, array<string, array<string>|string>>
     * @phpstan-return array<string, array<string, string|list<string>>>
     */
    protected function getValidationRules(): array
    {
        $rules = new ValidationRules();

        return $rules->getLoginRules();
    }
}
