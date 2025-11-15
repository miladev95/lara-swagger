<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateSwaggerCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Ensure migrations directory exists inside the framework's database_path()
        $migrationsDir = database_path('migrations');
        if (! is_dir($migrationsDir)) {
            mkdir($migrationsDir, 0777, true);
        }

        // Create a migration that exercises multiple data types
        $migration = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User
{
    public const TABLE = 'users';
}

return new class extends Migration
{
    public function up()
    {
        Schema::create(User::TABLE, function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->integer('age')->nullable();
            $table->boolean('is_active')->nullable();
            $table->date('birth_date')->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->json('settings')->nullable();
            $table->bigInteger('score')->nullable();
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    public function down()
    {
        Schema::dropIfExists(User::TABLE);
    }
};
PHP;

        file_put_contents($migrationsDir.'/2025_01_01_000000_create_users_table.php', $migration);
    }

    public function test_generates_swagger_models_with_correct_data_types()
    {
        // Run the command
        $this->artisan('lswagger:generate')->assertExitCode(0);

        // Resolve generated file path: command writes relative to CWD, not base_path
        $candidates = [
            getcwd().DIRECTORY_SEPARATOR.'swagger_models.json',
            base_path('swagger_models.json'),
        ];
        $file = null;
        foreach ($candidates as $path) {
            if (is_file($path)) {
                $file = $path;
                break;
            }
        }
        $this->assertNotNull($file, 'swagger_models.json was not found in expected locations.');

        $data = json_decode(file_get_contents($file), true);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('User', $data);

        $user = $data['User'];
        $this->assertSame('object', $user['type']);
        $this->assertArrayHasKey('properties', $user);

        $props = $user['properties'];

        // check each column type as currently produced by the command
        $this->assertSame('string', $props['name']['type']);
        $this->assertSame('integer', $props['age']['type']);
        $this->assertSame('boolean', $props['is_active']['type']);
        $this->assertSame('date', $props['birth_date']['type']);
        $this->assertSame('dateTime', $props['last_login_at']['type']);
        $this->assertSame('json', $props['settings']['type']);
        $this->assertSame('bigInteger', $props['score']['type']);

        // Ensure foreign type is excluded according to current implementation
        $this->assertArrayNotHasKey('team_id', $props);
    }
}

