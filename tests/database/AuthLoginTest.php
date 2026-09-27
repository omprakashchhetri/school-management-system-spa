<?php

use App\Database\Seeds\DatabaseSeeder;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * End-to-end check of the /api/login flow against a migrated + seeded
 * database — the same path DemoUsersSeeder sets up for local testing.
 *
 * Requires the `tests` database group to be a real MySQL/MariaDB
 * connection (see env / .env): the schema migration uses MySQL-specific
 * DDL and cannot run against CodeIgniter's SQLite3 test default.
 *
 * @internal
 */
final class AuthLoginTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $seed      = DatabaseSeeder::class;
    protected $basePath  = APPPATH . 'Database';
    protected $namespace = 'App';

    public function testEmployeeLoginSucceedsWithSeededDemoAccount(): void
    {
        $result = $this->withBodyFormat('form')->post('api/login', [
            'email'    => 'admin@example.test',
            'password' => 'DemoPass!123',
            'type'     => 'employee',
        ]);

        $result->assertOK();
        $json = json_decode($result->response()->getBody(), true);

        $this->assertSame(1, $json['status']);
        $this->assertNotEmpty($json['token']);
    }

    public function testStudentLoginSucceedsWithSeededDemoAccount(): void
    {
        $result = $this->withBodyFormat('form')->post('api/login', [
            'email'    => 'student@example.test',
            'password' => 'DemoPass!123',
            'type'     => 'student',
        ]);

        $result->assertOK();
        $json = json_decode($result->response()->getBody(), true);

        $this->assertSame(1, $json['status']);
        $this->assertNotEmpty($json['token']);
    }

    public function testLoginFailsWithWrongPassword(): void
    {
        $result = $this->withBodyFormat('form')->post('api/login', [
            'email'    => 'admin@example.test',
            'password' => 'not-the-password',
            'type'     => 'employee',
        ]);

        $result->assertOK();
        $json = json_decode($result->response()->getBody(), true);

        $this->assertSame(0, $json['status']);
        $this->assertArrayNotHasKey('token', $json);
    }

    public function testLoginFailsWithMissingCredentials(): void
    {
        $result = $this->withBodyFormat('form')->post('api/login', [
            'email'    => '',
            'password' => '',
            'type'     => 'student',
        ]);

        $result->assertOK();
        $json = json_decode($result->response()->getBody(), true);

        $this->assertSame(0, $json['status']);
        $this->assertSame('Please enter your email/ID and password.', $json['message']);
    }

    public function testLoginFailsWithInvalidType(): void
    {
        $result = $this->withBodyFormat('form')->post('api/login', [
            'email'    => 'admin@example.test',
            'password' => 'DemoPass!123',
            'type'     => 'bogus',
        ]);

        $result->assertOK();
        $json = json_decode($result->response()->getBody(), true);

        $this->assertSame(0, $json['status']);
        $this->assertArrayNotHasKey('token', $json);
    }

    public function testSuspendedStudentCannotLogIn(): void
    {
        $studentsModel = model('StudentsModel');
        $student       = $studentsModel->where('student_email', 'student@example.test')->first();
        $studentsModel->update($student['id'], ['status' => 'Suspended']);

        $result = $this->withBodyFormat('form')->post('api/login', [
            'email'    => 'student@example.test',
            'password' => 'DemoPass!123',
            'type'     => 'student',
        ]);

        $result->assertOK();
        $json = json_decode($result->response()->getBody(), true);

        $this->assertSame(0, $json['status']);
        $this->assertArrayNotHasKey('token', $json);
        $this->assertStringContainsString('inactive', $json['message']);
    }

    public function testProtectedRouteRejectsRequestWithoutToken(): void
    {
        $result = $this->post('post-login-employee/admin/dashboard');

        // JWTAuthFilter redirects browser requests without a token to
        // /pre-login rather than a bare 401 (see app/Filters/JWTAuthFilter.php).
        $result->assertRedirect();
    }

    public function testPublicFeeReceiptRouteIsNotBlockedByAuthFilter(): void
    {
        // Regression check: this route is documented as public
        // ("no login required") but used to be rejected by
        // JWTAuthFilter because 'fees' wasn't in its skip-list.
        $result = $this->get('fees/receipt/999999');

        // No matching payment: the controller redirects to '/' with an
        // error rather than to /pre-login — the key assertion is that we
        // never hit the auth filter's redirect-to-login branch.
        $result->assertRedirectTo('/');
    }
}
