<?php

use App\Controllers\BaseController;
use CodeIgniter\Test\CIUnitTestCase;

/**
 * Exercises BaseController::verifyAndUpgradePassword() in isolation, using
 * a fake "model" double instead of a real database connection.
 *
 * This is the logic that fixed a real bug: login used to compare the
 * submitted password directly in the SQL WHERE clause, which only ever
 * matched plaintext rows — any account whose password had since been
 * hashed (e.g. via the admission edit flow) could never log in again.
 *
 * @internal
 */
final class PasswordVerificationTest extends CIUnitTestCase
{
    private function callVerify(string $plain, array $record, $model): bool
    {
        $controller = new class () extends BaseController {
            public function expose(string $plain, array $record, $model): bool
            {
                return $this->verifyAndUpgradePassword($plain, $record, $model);
            }
        };

        return $controller->expose($plain, $record, $model);
    }

    public function testRejectsWrongPasswordAgainstHash(): void
    {
        $record = ['id' => 1, 'password' => password_hash('correct-horse', PASSWORD_DEFAULT)];
        $model  = new class () {
            public function update($id, $data)
            {
                throw new \RuntimeException('update() should not be called on a failed login');
            }
        };

        $this->assertFalse($this->callVerify('wrong-password', $record, $model));
    }

    public function testAcceptsCorrectPasswordAgainstHash(): void
    {
        $record = ['id' => 1, 'password' => password_hash('correct-horse', PASSWORD_DEFAULT)];
        $model  = new class () {
            public function update($id, $data)
            {
                throw new \RuntimeException('a hashed row should not be re-written on login');
            }
        };

        $this->assertTrue($this->callVerify('correct-horse', $record, $model));
    }

    public function testAcceptsAndUpgradesLegacyPlaintextRow(): void
    {
        // Regression case: rows created before hashing was introduced
        // stored the password as plaintext. Login must still accept
        // them, and must rewrite them to a hash so the row is only ever
        // matched in plaintext once.
        $record = ['id' => 42, 'password' => 'student@123'];

        $updateCalls = [];
        $model       = new class ($updateCalls) {
            public array $calls = [];

            public function __construct(&$calls)
            {
                $this->calls = &$calls;
            }

            public function update($id, $data)
            {
                $this->calls[] = [$id, $data];

                return true;
            }
        };

        $this->assertTrue($this->callVerify('student@123', $record, $model));

        $this->assertCount(1, $model->calls);
        [$id, $data] = $model->calls[0];
        $this->assertSame(42, $id);
        $this->assertTrue(password_verify('student@123', $data['password']));
    }

    public function testRejectsWrongLegacyPlaintextPassword(): void
    {
        $record = ['id' => 42, 'password' => 'student@123'];
        $model  = new class () {
            public function update($id, $data)
            {
                throw new \RuntimeException('update() should not be called on a failed login');
            }
        };

        $this->assertFalse($this->callVerify('not-the-password', $record, $model));
    }

    public function testRejectsEmptyStoredPassword(): void
    {
        // Several seeded/legacy employee rows have password === '' —
        // that must never match any submitted password, including an
        // empty one.
        $record = ['id' => 4, 'password' => ''];
        $model  = new class () {
            public function update($id, $data)
            {
                throw new \RuntimeException('update() should not be called on a failed login');
            }
        };

        $this->assertFalse($this->callVerify('', $record, $model));
    }
}
