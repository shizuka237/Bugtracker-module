<?php

	require_once('include/class.db.php');
	error_reporting(0);
	class user
	{
		var $m_db;
		
	
		//==========================	
		function user()
		{
			global $db;
			$this->m_db		= &$db;
		}
	} // end class user
?>
