<?phpsession_start();require_once("config/config.inc.php");require_once("config/strings.inc.php");require_once("includes/Database.php");require_once("load.php");require_once("includes/verify_access.php");restrict_access($db,array("staff","admin"));require_once("includes/header.php");print("<div id='PageTitle'>Reports</div>\n");print("<div class='breadcrumb'><a href='http://library.pdx.edu'>Home</a> &raquo; <a href='index.php'>Reserve a Study Room</a> &raquo; Reports</div>\n");print("<br>\n");?><h2>All Reports</h2><br>Usage Reports<ul>	<li><a href='report_summary.php'>Summary Report</a></li>	<li><a href='report_usage.php'>Custom Report</a></li>	<li><a href='report_overdue.php'>Overdue Checkouts</a></li></ul><br>Fines<ul>	<li><a href='report_fines.php?start_date=07%2F01%2F2012&end_date=<?php print(urlencode(date("m/d/Y"))); ?>&selected_resolution_options%5B%5D=Unresolved&submitted=Create+Report'>All Unresolved</a></li>	<li><a href='report_fines.php'>Custom Report</a></li></ul><?phprequire_once("includes/footer.php");?>