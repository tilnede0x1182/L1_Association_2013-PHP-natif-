<?php
		if (!empty($_SESSION['style'])) {
			if ($_SESSION['style']==1) echo '    <link rel="stylesheet" href="Styles/style1.css">';
			if ($_SESSION['style']==2) echo '    <link rel="stylesheet" href="Styles/style2.css">';			
		}
		else echo '    <link rel="stylesheet" href="Styles/style1.css">';

		echo "\n";
?>