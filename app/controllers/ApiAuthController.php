
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiAuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
    }

    public function login()
    {
        $data = $this->api->body();

        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        $user = $this->db->table('users')
            ->where('username', $username)
            ->row();

        if (!$user || !password_verify($password, $user->password)) {
            $this->api->respond_error('Invalid credentials', 401);
            return;
        }

        if (isset($user->is_active) && !$user->is_active) {
            $this->api->respond_error('Account is inactive', 403);
            return;
        }

        $tokens = $this->api->issue_tokens([
            'id' => $user->id,
            'role' => $user->role
        ]);

        $this->api->respond($tokens);
    }

    public function logout()
    {
        $this->api->require_jwt();

        $data = $this->api->body();
        $refreshToken = $data['refresh_token'] ?? '';

        if ($refreshToken !== '') {
            $this->api->revoke_refresh_token($refreshToken);
        }

        $this->api->respond(['message' => 'Logged out']);
    }
}
