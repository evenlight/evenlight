<?PHP

	namespace Main\MySQL;

	class Init
	{

		private $db = [];

		//Создаем подключение к БД
		function __construct()
		{

			global $cfg;

			try
			{

				$this->db_host = $cfg['mysql']['connect'][0];
				$this->db_name = $cfg['mysql']['connect'][1];
				$this->db_userLogin = $cfg['mysql']['connect'][2];
				$this->db_userPass = $cfg['mysql']['connect'][3];

				$db = new PDO($cfg['mysql']['type'] . ":host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_userLogin, $this->db_userPass);

				if ( $cfg['mysql']['show_errors'] === 'show' )
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			}
			catch ( PDOException $e )
			{

				$db_error_tpl = <<<HTML
<!DOCTYPE html>
<html>
<head>
	<title>MySQL Fatal Error</title>
	<meta charset="{$cfg['charset']}">
</head>
<body>

	<p style="font-weight:bold;">A Database Error Occurred</p>
	<p>{MESSAGE}</p>
	
</div>

</body>
</html>
HTML;

				if ( $cfg['mysql']['show_errors'] === 'show' )
					$db_error_tpl = str_replace('{MESSAGE}', $e->getMessage(), $db_error_tpl);

				else
				{

					$db_error_tpl = str_replace('{MESSAGE}', 'Log was created...', $db_error_tpl);

					$filename = DB_LOGS . '/errors' . date('j-m-Y') . '.txt';

					$message = "===============================\n" .
									date("H:i:s") .
							   "===============================\n" .
									$e->getMessage();

					file_put_contents($filename, $message, FILE_APPEND);

				}

				exit($db_error_tpl);

			}

		}

		//Закрываем текущее соединение
		public function close()
		{

			$db = NULL;

		}

	}