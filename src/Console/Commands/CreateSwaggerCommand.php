<?php

namespace Miladev\LaravelSwagger\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CreateMigrationCommand extends Command
{
    protected $signature = 'lswagger:create';

    protected $description = 'Create a swagger model file based on migrations';

    public function handle()
    {

        $dir = database_path('migrations/');

        $model = [];
        // open the directory
        if ($handle = opendir($dir)) {
            // loop through each file in the directory
            while (($file = readdir($handle)) !== false) {
                // check if the file is a regular file
                if (is_file($file)) {


                    $searchString = "create";

                    if (strpos($file, $searchString) !== false) {
                        $migrationCode = file_get_contents($file);

                        $tablePattern = '/Schema::create\((\w+)::TABLE/';

                        $columnPattern = '/\$table->(\w+)\(\'(\w+)\'\)->/';

                        $columnData = [];

                        $tableName = '';
                        if (preg_match($tablePattern, $migrationCode, $tableMatch)) {
                            $tableName = $tableMatch[1];
                        }

                        preg_match_all($columnPattern, $migrationCode, $columnMatches, PREG_SET_ORDER);

                        foreach ($columnMatches as $match) {
                            $columnData[] = ['name' => $match[2], 'type' => $match[1]];
                        }
                        $data = [];
                        foreach ($columnData as $column) {
                            $name = $column['name'];
                            $type = $column['type'];
                            if ($type !== 'foreign') {
                                $data[$name]['type'] =  $type;

                            }
                        }
                        $model[$tableName]['type'] = 'object';
                        $model[$tableName]['properties'] = $data;
                    }


                }
            }

            $jsonData = json_encode($model, JSON_PRETTY_PRINT);
            $filePath = 'data.json';

            // Write the JSON data to the file
            if (file_put_contents($filePath, $jsonData)) {
                $this->info("JSON data has been successfully written to the file.");
            } else {
                $this->error("Unable to write JSON data to the file.");
            }

            closedir($handle);
        }
    }
}
