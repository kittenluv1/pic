
function get_username() {
	const cookies = document.cookie.split('; ');
	for (const cookie of cookies) {
		if (cookie.startsWith('username=')) {
			return cookie.substring('username='.length);
		}
	}
	return "";
}