<?phprequire_once("../../load.php");$id = $_GET['id'];print(json_encode(get_user_by_id($id)));?>