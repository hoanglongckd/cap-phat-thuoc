<?php
	session_start();
	
	class Session {
		
		public function checkUser() {
			if ( !empty($_SESSION['user']) )
				return true;
			else
				return false;
		}
		
	}
?>