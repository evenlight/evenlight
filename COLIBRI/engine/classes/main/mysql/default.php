<?php

    namespace Main\MySQL;

    use \PDO;

    class InitDB extends PDO
    {

        public $DBH = null,
               $STMT = null,
               $query_num = 0,
               $query_list = [],
               $database = [
                    'host'      => 'localhost',
                    'dbname'    => '9246099050_eve',
                    'user'      => '046015069_tePaIe',
                    'password'  => '6TQNPz9BK,G*',
                    'engine'    => 'mysql',
                    'options' => [
                        //PDO::ATTR_PERSISTENT    => TRUE,
                        PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
                    ]
               ],
               $db_errorTPL = <<<HTML
    <!DOCTYPE html>
    <html>
        <head>
            <title>MySQL Error</title>
            <meta charset="UTF-8">
            <style>
                body{padding:10px;margin:50px auto;max-width:850px;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#333;background:#fff;}
                ul{margin:0;padding:0;}
                li{list-style:none;}
                .mysql_block {position:relative;padding:45px 15px 15px;border:1px solid #e5e5e5;border-radius:4px;}
                .mysql_title {position:absolute;top:15px;left:15px;font-size:18px;font-weight:700;color:#de3535;text-transform:uppercase;letter-spacing:1px;}
                .mysql_query {padding:9px 14px;background:#f7f7f9;border-top:1px solid #e1e1e8;margin:10px -15px -15px -15px;}
            </style>
        </head>
        <body>
        
            <div class="mysql_block">
                <span class="mysql_title">MySQL Error</span>
                    <span class="mysql_errorDescription">
                        <ul>
                            <li>
                                <b>File:</b>
                                {FILE} <b>at line {LINE}</b>
                            </li>
                            <li>
                                <b>Error number:</b>
                                {ERRNO}
                            </li>
                            <li>
                                <b>Error text:</b>
                                {ERROR} 
                            </li>
                        </ul>
                    </span>
                <div class="mysql_query">
                    <span>
                        {QUERY}
                    </span>
                </div>
            </div>
        
        </body>
    </html>
HTML;

        //Создаем подключение к БД
        public function __construct()
        {
            try
            {
                $dsn = $this->database["engine"] . ':dbname=' . $this->database["dbname"] . ";host=" . $this->database["host"];
                $this->DBH = new PDO($dsn, $this->database["user"], $this->database["password"], $this->database['options']);
                die('lol');
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }

            //$this->cfg = &$cfg;

        }

//Запросы к БД
        private function execute()
        {


        }

//Закрываем текущее соединение
        public function close()
        {
            $this->DBH = $this->STMT = null;

            return TRUE;
        }

//Ошибки MySQL
        private function db_error()
        {
            global $cfg;

            $trace = debug_backtrace();
            array_shift($trace);
            array_pop($trace);

            $file = str_replace(ROOT, "/", $trace[0]['file']);
            $line = $trace[0]['line'];
            $errno = mysqli_errno($this->db);
            $error = mysqli_connect_error() || mysqli_error($this->db);
            $query = preg_replace("/([0-9a-f]){32}/", "********************************", $this->db);

            $query = htmlspecialchars($query, ENT_QUOTES, 'ISO-8859-1');
            $error = htmlspecialchars($error, ENT_QUOTES, 'ISO-8859-1');

            if ($this->cfg['show_errors'] == 'show')
            {
                $this->db_errorTPL = str_replace(
                    ['{FILE}', '{LINE}', '{ERRNO}', '{ERROR}', '{QUERY}'],
                    [$file, $line, $errno, $error, $query],
                    $this->db_errorTPL);

                $this->output($this->db_errorTPL);
            }
            else
            {
                $this->db_errorTPL = str_replace(
                    ['{FILE}', '{LINE}', '{ERRNO}', '{ERROR}', '{QUERY}'],
                    ['***', '0', '0', '***', 'Log was created...'],
                    $this->db_errorTPL);

                $filename = LOGS . '/database/errors_' . date('j-m-Y') . '.txt';

                $msg_date = date("H:i:s");
                $mysqli_err = mysqli_connect_error();
                $message = <<<HTML
    ===============================
               $msg_date
    ===============================
    $mysqli_err
    
    

HTML;

                file_put_contents($filename, $message, FILE_APPEND);
            }

            exit($this->db_errorTPL);
        }

        //Вывод информации
        public function output($msg)
        {
            return $msg;
        }

    }