<?php
/*
# Task: Apply logic which will convert dot (.) to array.

EG 1 : config('database.local.username')
    - This should return "root"

EG 2 : config('database.production.username')
    - This should return "production_root"

EG 3 : config('database.local')
    - This should return the whole local array like below result:
        Array (
            [username] => root
            [password] => root_pw
        )

EG 4 : config('google')
    - This should return "www.google.com"

Means when we pass anything in "config" function by dot (.) seperate 
the function should convert that to access the array and give the result.

Note:   if invalid key is passed like config('my_database')
        then it should return NULL or '' (empty string).    

Code is given below:

*/


$result = config('database.local');
echo '<pre>';
print_r($result);

function config()
{
    return getConfig();
}

function getConfig()
{
    return [
        'database' => [
            'local' => [
                'username' => 'root',
                'password' => 'root_pw'
            ],
            'production' => [
                'username' => 'production_root',
                'password' => 'production_root_pw'
            ]
        ],
        'google' => 'www.google.com'
    ];
}

?>