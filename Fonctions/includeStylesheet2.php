<?php
	function includeStylesheet2() {
		if (!empty($_SESSION['style'])) {
			if ($_SESSION['style']==1) $style = '    <link rel="stylesheet" href="Styles/style1.css">';
			if ($_SESSION['style']==2) $style = '    <link rel="stylesheet" href="Styles/style2.css">';			
		}
		else $style = '    <link rel="stylesheet" href="Styles/style1.css">';

		return $style."\n";
	}
?>