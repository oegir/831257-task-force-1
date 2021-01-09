<?php

require_once 'vendor/autoload.php';

use TaskForce\import\ImportCsv;

$fields = [['category'=>'string'], ['icon'=>'string']];
$file_sql = 'src/import/categories.sql';
$importer = new ImportCsv("data/categories.csv", 'categories', $fields);

run($importer, $file_sql);

$fields = [['city'=>'string'], ['latitude'=>'string'], ['longitude'=>'string']];
$file_sql = 'src/import/cities.sql';
$importer = new ImportCsv("data/cities.csv", 'cities', $fields);

run($importer, $file_sql);

$fields = [['email'=>'string'], ['login'=>'string'], ['password'=>'string'], ['date_add'=>'string'], ['city_id'=>'int'], ['birthday'=>'string'], ['about_me'=>'string'], ['phone'=>'string'], ['skype'=>'string']];
$file_sql = 'src/import/users.sql';
$importer = new ImportCsv("data/users-profiles.csv", 'users', $fields);

run($importer, $file_sql);

$fields = [['date_add'=>'string'], ['category_id'=>'int'],['description'=>'string'], ['date_expire'=>'string'], ['job'=>'string'], ['address'=>'string'], ['budget'=>'int'], ['latitude'=>'string'], ['longitude'=>'string'], ['customer_id'=>'int']];
$file_sql = 'src/import/tasks.sql';
$importer = new ImportCsv("data/tasks.csv", 'tasks', $fields);

run($importer, $file_sql);

$fields = [['user_id'=>'int'], ['task_id'=>'int'], ['review_author_id'=>'int'], ['date_add'=>'string'], ['rating'=>'int'], ['description'=>'string']];
$file_sql = 'src/import/opinions.sql';
$importer = new ImportCsv("data/opinions.csv", 'opinions', $fields);

run($importer, $file_sql);

$fields = [['date_add'=>'string'], ['task_id'=>'int'], ['user_id'=>'int'],  ['cost'=>'int'], ['comment'=>'string']];
$file_sql = 'src/import/responses.sql';
$importer = new ImportCsv("data/replies.csv", 'responses', $fields);

run($importer, $file_sql);

function run($importer, $file_sql)
{
    try {
        $importer->import();
        $importer->writeSQL($file_sql);
    } catch (\Exception $e) {
        error_log("Не удалось обработать csv файл: " . $e->getMessage());
    }
}
