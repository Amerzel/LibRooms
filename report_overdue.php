<?phpsession_start();require_once("config/config.inc.php");require_once("config/strings.inc.php");require_once("includes/Database.php");require_once("load.php");require_once("includes/verify_access.php");restrict_access($db,array("staff","admin"));$format = $_GET['format'];if(strcmp($format,'excel')){	require_once("includes/header.php");	?><script type="text/javascript" language="javascript" src="js/jquery.ui.core.js"></script><script type="text/javascript" language="javascript" src="js/jquery.ui.datepicker.js"></script><script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script><script type="text/javascript" charset="utf-8">	jQuery(document).ready(function($)	{			// turn off caching for ajax calls, fixes IE caching issue		jQuery.ajaxSetup({ cache: false });						var overdue_report_table = $('#overdue_report_table').dataTable({			"bJQueryUI": true,			"sPaginationType": "full_numbers",			"iDisplayLength": 50,			"aaSorting": [[ 5, "desc" ]],			"aoColumns": [				{ },				{ },				{ "bSortable": false},				{ "bSortable": false},				{ "bSortable": false},				{ },				{ },				{ "sWidth": "100px"},				{ "bSortable": false}			]		});	});	</script><link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="all" /><link rel="stylesheet" href="css/results_table.css" type="text/css" media="all" /><?php	print("<div id='PageTitle'>Overdue Checkouts</div>\n");	print("<div class='breadcrumb'><a href='http://library.pdx.edu'>Home</a> &raquo; <a href='index.php'>Reserve a Study Room</a> &raquo; <a href='reports.php'>Reports</a> &raquo; Overdue Checkouts</div>\n");	print("<br>\n");		print("<div style='float:right; margin-right:10px'><a href='?".$_SERVER['QUERY_STRING']."&format=excel'>Export to Excel</a></div>\n");	print("<table id='overdue_report_table' width='100%' border><thead><tr><th>Date</th><th>Room</th><th>Sched Start</th><th>Sched End</th><th>Checkout Time</th><th>Hours Overdue</th><th>Patron ID</th><th>Status</th><th></th>");	print("</tr></thead>\n");	print("<tbody>\n");		$options = array();	$options['active'] = 1;	$options['overdue'] = 1;		$reservations = load_reservations($options);		foreach($reservations as $reservation)	{		print("<tr><td align='center'>".date('m/d/Y',strtotime($reservation->date))."</td>");		print("<td align='center'>".$reservation->room->room_number."</td>");		print("<td align='center'>".date('g:ia',strtotime($reservation->sched_start_time))."</td>");		print("<td align='center'>".date('g:ia',strtotime($reservation->sched_end_time))."</td>");		if(strcmp($reservation->key_checkout_time,''))			print("<td align='center'>".date('g:ia',strtotime($reservation->key_checkout_time))."</td>");		else			print("<td></td>");				$overdue_by = number_format(round((strtotime('now') - strtotime($reservation->sched_end_time))/(3600),2),2);		print("<td align='center'>$overdue_by</td>");				$user = get_user_by_id($reservation->user_id);		print("<td align='center'>".$user->patron_id."</td>");		print("<td align='center'>$reservation->status</td>");		print("<td align='center'><a href='reservation_details.php?reservation_id=$reservation->id'>details</a></td>");		print("</tr>\n");	}		print("</tbody>\n");	print("</table>\n");		require_once("includes/footer.php");}else{	header("Content-Type: application/vnd.ms-excel");	header("Content-Disposition: attachment; filename=study_rooms_usage_report.xls");		print("<table id='overdue_report_table' width='100%' border><thead><tr><th>Date</th><th>Room</th><th>Sched Start</th><th>Sched End</th><th>Checkout Time</th><th>Hours Overdue</th><th>Patron ID</th><th>Status</th>");	print("</tr></thead>\n");	print("<tbody>\n");		$options = array();	$options['active'] = 1;	$options['overdue'] = 1;		$reservations = load_reservations($options);		foreach($reservations as $reservation)	{		print("<tr><td align='center'>".date('m/d/Y',strtotime($reservation->date))."</td>");		print("<td align='center'>".$reservation->room->room_number."</td>");		print("<td align='center'>".date('g:ia',strtotime($reservation->sched_start_time))."</td>");		print("<td align='center'>".date('g:ia',strtotime($reservation->sched_end_time))."</td>");		if(strcmp($reservation->key_checkout_time,''))			print("<td align='center'>".date('g:ia',strtotime($reservation->key_checkout_time))."</td>");		else			print("<td></td>");				$overdue_by = number_format(round((strtotime('now') - strtotime($reservation->sched_end_time))/(3600),2),2);		print("<td align='center'>$overdue_by</td>");				$user = get_user_by_id($reservation->user_id);		print("<td align='center'>".$user->patron_id."</td>");		print("<td align='center'>$reservation->status</td>");		print("</tr>\n");	}		print("</tbody>\n");	print("</table>\n");}?>