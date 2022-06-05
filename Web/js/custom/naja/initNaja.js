import naja from 'naja';
import netteForms from 'nette-forms';

naja.formsHandler.netteForms = netteForms;

document.addEventListener('DOMContentLoaded', function () {
	naja.initialize({
		timeout: 70000, // maximální délka requestu
		history: false
	});
});