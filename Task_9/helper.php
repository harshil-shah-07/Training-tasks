<?php
    function config($str = NULL)
    {
        if ($str == NULL) {
            return getConfig();
        } else {
            $config = explode(".", $str);
            $array = getConfig();

            for ($i = 0; $i < count($config); $i++) { 

                if (!empty($array[$config[$i]])) {
                    $array = $array[$config[$i]];   
                } 
            }
            return $array;
        }
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