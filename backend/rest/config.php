<?php 
// Set the reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

class Config {
    public static function DB_NAME(){
        return Config::get_env('DB_NAME', 'basketball');
    }
    public static function DB_PORT(){
        return Config::get_env('DB_PORT', 3306);
    }
    public static function DB_USER(){
        return Config::get_env('DB_USER', 'root');
    }
    public static function DB_PASSWORD(){
        return Config::get_env('DB_PASSWORD', '');
    }
    public static function DB_HOST(){
        return Config::get_env('DB_HOST', '127.0.0.1');
    }
    public static function JWT_SECRET(){
        return Config::get_env('JWT_SECRET', '#q4tJP7u$+F&1!UKu:Y-jrA[0*#RiK');
    }
    public static function get_env($name, $default){
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
    }
}

/*// Database access credentials
define('DB_NAME', 'basketball');
define('DB_PORT', 3306);
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1'); // localhost

// Attempt to connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//JWT SECRET
define('JWT_SECRET','#q4tJP7u$+F&1!UKu:Y-jrA[0*#RiK')*/
?>
