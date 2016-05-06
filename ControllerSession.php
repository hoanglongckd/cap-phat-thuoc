<?php

	class Session {
		
		public function checkUserLogin() {
			if ( !empty($_SESSION['user']) )
				return true;
			else
				return false;
		}
		
	}
?>