<?phprequire_once("../../load.php");$user_id = $_GET['user_id'];$selected_date = $_GET['selected_date'];$start_time = $_GET['start_time'];$end_time = $_GET['end_time'];$otf = $_GET['otf'];$reschedule_reservation_id = $_GET['reschedule_reservation_id'];$room_filter = array();$room_filter['out_of_order'] = "No";$room_filter['capacity gte'] = $_GET['capacity_gte'];$room_filter['group_by'] = "room_group_id";$otf = $_GET['otf'];$reschedule_reservation_id = $_GET['reschedule_reservation_id'];		($date,$start_time,$end_time,$room_filter,$user_id=null,$otf=0,$reschedule_reservation_id=null)	print(json_encode(get_available_rooms($selected_date,$start_time,$end_time,$room_filter,$user_id,$otf,$reschedule_reservation_id)));?>