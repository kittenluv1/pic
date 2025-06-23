
const button = document.querySelector('button[value="Login"]');
const input = (document.getElementById('password'));
let ha = "";
button.addEventListener('click', mock);
input.addEventListener('keyup', function (enter) {
	if (enter.key === "Enter")
		mock();
});

function mock() {
	const mockSection = document.createElement('p');
	mockSection.innerHTML = 'Somebody knows the password you like to use is <strong>' + input.value + '</strong>.';
	const section = document.getElementsByTagName('section')[0];
	section.appendChild(mockSection);

	const mockHeading = document.getElementsByTagName('h1')[0];
	ha += "HA";
	mockHeading.innerHTML = ha;
}
