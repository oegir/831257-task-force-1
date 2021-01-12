<?php

require_once 'vendor/autoload.php';

use TaskForce\import\ImportCsv;

$file_csv = 'data/categories.csv';
$table = 'categories';
$fields = [['category'=>'string'], ['icon'=>'string']];
$file_sql = 'src/import/categories.sql';

$importer = new ImportCsv($file_csv, $table, $fields);
$importer->import($file_sql);

$file_csv = 'data/cities.csv';
$table = 'cities';
$fields = [['city'=>'string'], ['latitude'=>'string'], ['longitude'=>'string']];
$file_sql = 'src/import/cities.sql';

$importer = new ImportCsv($file_csv, $table, $fields);
$importer->import($file_sql);

$file_csv = 'data/users-profiles.csv';
$table = 'users';
$fields = [['email'=>'string'], ['login'=>'string'], ['password'=>'string'], ['date_add'=>'string'], ['city_id'=>'int'], ['birthday'=>'string'], ['about_me'=>'string'], ['phone'=>'string'], ['skype'=>'string']];
$file_sql = 'src/import/users.sql';

$importer = new ImportCsv($file_csv, $table, $fields);
$importer->import($file_sql);

$file_csv = 'data/tasks.csv';
$table = 'tasks';
$fields = [['date_add'=>'string'], ['category_id'=>'int'],['description'=>'string'], ['date_expire'=>'string'], ['job'=>'string'], ['address'=>'string'], ['budget'=>'int'], ['latitude'=>'string'], ['longitude'=>'string'], ['customer_id'=>'int']];
$file_sql = 'src/import/tasks.sql';

$importer = new ImportCsv($file_csv, $table, $fields);
$importer->import($file_sql);

$file_csv = 'data/opinions.csv';
$table = 'opinions';
$fields = [['user_id'=>'int'], ['task_id'=>'int'], ['review_author_id'=>'int'], ['date_add'=>'string'], ['rating'=>'int'], ['description'=>'string']];
$file_sql = 'src/import/opinions.sql';

$importer = new ImportCsv($file_csv, $table, $fields);
$importer->import($file_sql);

$file_csv = 'data/replies.csv';
$table = 'responses';
$fields = [['date_add'=>'string'], ['task_id'=>'int'], ['user_id'=>'int'],  ['cost'=>'int'], ['comment'=>'string']];
$file_sql = 'src/import/responses.sql';

$importer = new ImportCsv($file_csv, $table, $fields);
$importer->import($file_sql);
