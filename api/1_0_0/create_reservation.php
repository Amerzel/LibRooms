<?phpsession_start();require_once("../../load.php");$selected_date = $_GET['selected_date'];$room_id = $_GET['room_id'];$room_section_id = $_GET['room_section_id'];$user_id = $_GET['user_id'];$selected_date = $_GET['selected_date'];$start_time = $_GET['start_time'];$end_time = $_GET['end_time'];$otf = $_GET['otf'];$mobile = $_GET['mobile'];print(json_encode(create_reservation($room_id,$room_section_id,$user_id,$selected_date,$start_time,$end_time,$otf,$mobile)));?>