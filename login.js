
const form = document.querySelector('form');
const input = (document.getElementById('username'));
input.value = get_username();
//event listeners
form.addEventListener('submit', check_input);	//some odd conflicting functionality w/ php form submission
input.addEventListener('keyup', function (enter) {
	if (enter.key === "Enter")
		check_input();
});

//functions
function check_input() {
	let username = input.value;
	if (validate_username(username)) {
		//create cookie which expires in 1 hour
		let hour_in_future = new Date();
		hour_in_future.setHours(hour_in_future.getHours() + 1);
		document.cookie = `username=${username}; expires=${hour_in_future.toUTCString()}`;
		input.value = get_username();
		console.log('submit');
		//redirect to index
		window.location.assign('index.php');
	}
	else {
		input.value = "";
	}
}
function validate_username(username) {

	//start with a valid string
	let errors = "";
	let leastChars = true;
	let mostChars = true;
	let noSpaces = true;
	let noCommas = true;
	let noSemicolons = true;
	let noEquals = true;
	let noAnd = true;
	let allValidChars = true;
	let validCharString = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^*()-_+[]{}:'|`~<.>/?"

	//loop through the string to find any errors
	if (username.length < 5)
		leastChars = false;
	if (username.length > 40)
		mostChars = false;
	for (let char of username) {
		if (char === " ")
			noSpaces = false;
		if (char === ",")
			noCommas = false;
		if (char === ";")
			noSemicolons = false;
		if (char === "=")
			noEquals = false;
		if (char === "&")
			noAnd = false;
		//test each of the characters for validity
		let validChar = false;
		for (let i of validCharString) {
			if (char === i)
				validChar = true;
		}
		if (!validChar)  //if any of the characters do not pass the test, allValidChars becomes false
			allValidChars = false;
	}

	//print error messages
	if (!leastChars)
		errors += "Username must be 5 characters or longer.\n";
	if (!mostChars)
		errors += "Username must be no more than 40 characters.\n";
	if (!noSpaces)
		errors += "Username cannot contain spaces.\n";
	if (!noCommas)
		errors += "Username cannot contain commas.\n";
	if (!noSemicolons)
		errors += "Username cannot contain semicolons. \n";
	if (!noEquals)
		errors += "Username cannot contain =.\n";
	if (!noAnd)
		errors += "Username cannot contain &.\n";
	if (leastChars && mostChars && noSpaces && noCommas && noSemicolons && noEquals && noAnd && !allValidChars)
		errors += "Username can only use characters from the following string:\nabcdefghijklmnopqrstuvwxyz\nABCDEFGHIJKLMNOPQRSTUVWXYZ\n0123456789\n!@#$%^*()-_+[]{ }:'|`~<.>/?\n";
	if (leastChars && mostChars && noSpaces && noCommas && noSemicolons && noEquals && noAnd && allValidChars)
		return true;

	//display error messages
	errors = errors.trim();
	alert(errors);
	return false;
}