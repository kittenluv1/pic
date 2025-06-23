const prices = [5.00, 5.00, 5.00, 5.00, 5.00];
const spans = document.getElementsByTagName('span');
const credit_span = spans[0];
const images = document.getElementsByTagName('img');
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
const checkout_btn = document.querySelector('button[value="checkout"]');
const sales_message = document.getElementById("receipt");
const coupon_box = (document.getElementById('code'));
let credit = Number(credit_span.innerHTML);

window.onload = function () {

	// Put the prices in the spans
	for (let i = 0; i < prices.length; i++) {
		spans[i + 1].innerHTML = '$' + prices[i].toFixed(2);
	}

	// add event listeners to images
	for (let i = 0; i < images.length; i++) {
		images[i].addEventListener('click', function () {
			if (!checkboxes[i].disabled) {
				checkboxes[i].checked = !checkboxes[i].checked;
			}
		});
	}

	// checkout button
	checkout_btn.addEventListener('click', function () {
		const checked_prices = [];
		for (let i = 0; i < checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				checked_prices.push(prices[i]);
			}
		};
		validate_coupon_code(coupon_box.value);
		sales_total(checked_prices);
		update_credit();
	});

	// coupon code box
	coupon_box.addEventListener('keyup', function (enter) {
		if (enter.key === "Enter") {
			validate_coupon_code(coupon_box.value);
			update_credit();
		}
	});

}

function update_credit() {
	const request = new XMLHttpRequest();
	request.onload = function () {
		if (this.status === 200) {
			credit_span.innerHTML = credit.toFixed(2);
		}
	};
	let username = get_username();
	request.open('POST', 'money.php');
	request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	request.send(`username=${username}&credit=${credit}`);
}

function validate_coupon_code(code) {
	if (code === "COUPON5")
		credit += 5;
	if (code === "COUPON10")
		credit += 10;
	if (code === "COUPON20")
		credit += 20;
	//clear the coupon box & sales messages
	coupon_box.value = '';
	sales_message.innerHTML = '';
}

function sales_total(arr) {
	// Calculate the price from only the checked checkboxes

	// Calculate the price with tax

	// Check if you have insufficient credit 

	// Otherwise update your credit

	// Change checked boxes to be disabled. 
	// Also, check if there are no checked boxes (no displayed message).
	// Update the message in the bottom <p> element. 


	//calculate total before tax
	let beforeTax = 0;
	for (const p of arr)
		beforeTax += p;

	//calculate tax and isolate digits for baker's rounding
	let amountTax = beforeTax * 725;
	const partialCent = Math.floor(amountTax % 100 / 10);
	const centVal = Math.floor((amountTax % 1000 - (amountTax % 100)) / 100);

	//if sales tax needs to be rounded: 
	if (partialCent !== 0) {
		if (partialCent > 5 || (partialCent === 5 && centVal % 2 === 1)) {
			amountTax += 100;   //add $.01 * 10,000
		}
	}

	//compute final total with factor of 10000
	beforeTax *= 10000;
	let finalTotal = beforeTax + amountTax;

	//reset values to floats
	beforeTax /= 10000;
	finalTotal = Math.floor(finalTotal / 100) / 100;

	if (finalTotal > credit) {
		alert('insufficient credit (• ᴖ •｡)');
		sales_message.innerHTML = '';
	}
	else {
		credit -= finalTotal;

		sales_message.innerHTML = '&nbsp&nbsp $' + beforeTax + '<br> + sales tax (7.25%)<br> = $' + finalTotal;

		let noneChecked = true;
		for (const checkbox of checkboxes) {
			if (checkbox.checked) {
				checkbox.checked = false;
				checkbox.disabled = true;
				noneChecked = false;
			}
		};
		if (noneChecked) {
			sales_message.innerHTML = '';
		}
	}
}