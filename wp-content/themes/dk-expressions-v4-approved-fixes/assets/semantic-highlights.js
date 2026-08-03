(function () {
	'use strict';

	var config = window.dkxHighlightConfig || {};
	var southAfricanPlaces = [
		'Johannesburg','Cape Town','Durban','Pretoria','Gqeberha','Port Elizabeth','Bloemfontein','East London','Polokwane','Mbombela','Nelspruit','Kimberley','Pietermaritzburg','Rustenburg','Soweto','Sandton','Midrand','Centurion','Roodepoort','Germiston','Benoni','Boksburg','Kempton Park','Alberton','Randburg','Krugersdorp','Vereeniging','Vanderbijlpark','George','Knysna','Stellenbosch','Paarl','Franschhoek','Hermanus','Mossel Bay','Oudtshoorn','Worcester','Somerset West','Bellville','Umhlanga','Ballito','Richards Bay','Newcastle','Ladysmith','Margate','Port Shepstone','Potchefstroom','Klerksdorp','Mahikeng','Mafikeng','Welkom','Bethlehem','Upington','Mthatha','Graaff-Reinet','Jeffreys Bay','Hartbeespoort','Fourways','Rosebank','Melrose','Illovo','Bryanston','Rivonia','Bedfordview','Glenhazel','Norwood','Houghton','Sandringham','Sydenham','Oaklands','Observatory','Gauteng','Western Cape','Eastern Cape','KwaZulu-Natal','Free State','Limpopo','Mpumalanga','North West','Northern Cape'
	];
	var countryCodes = 'AF AL DZ AD AO AG AR AM AU AT AZ BS BH BD BB BY BE BZ BJ BT BO BA BW BR BN BG BF BI CV KH CM CA CF TD CL CN CO KM CD CG CR CI HR CU CY CZ DK DJ DM DO EC EG SV GQ ER EE SZ ET FJ FI FR GA GM GE DE GH GR GD GT GN GW GY HT HN HU IS IN ID IR IQ IE IL IT JM JP JO KZ KE KI KP KR KW KG LA LV LB LS LR LY LI LT LU MG MW MY MV ML MT MH MR MU MX FM MD MC MN ME MA MZ MM NA NR NP NL NZ NI NE NG MK NO OM PK PW PA PG PY PE PH PL PT QA RO RU RW KN LC VC WS SM ST SA SN RS SC SL SG SK SI SB SO ZA SS ES LK SD SR SE CH SY TW TJ TZ TH TL TG TO TT TN TR TM TV UG UA AE GB US UY UZ VU VA VE VN YE ZM ZW'.split(' ');
	var displayNames = typeof Intl !== 'undefined' && Intl.DisplayNames ? new Intl.DisplayNames(['en'], { type: 'region' }) : null;
	var countries = displayNames ? countryCodes.map(function (code) { return displayNames.of(code); }) : [];
	countries = countries.concat(['South Africa','United States','United States of America','USA','United Kingdom','UK','United Arab Emirates','UAE']);
	var locations = southAfricanPlaces.concat(countries, config.additionalLocations || []).filter(Boolean);
	locations = Array.from(new Set(locations)).sort(function (a, b) { return b.length - a.length; });

	function escapeRegExp(value) { return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'); }
	var months = '(?:January|February|March|April|May|June|July|August|September|October|November|December|Jan|Feb|Mar|Apr|Jun|Jul|Aug|Sep|Sept|Oct|Nov|Dec)';
	var days = '(?:\\b(?:Monday|Tuesday|Wednesday|Thursday|Friday|Saturday|Sunday|Mon|Tue|Tues|Wed|Thu|Thur|Thurs|Fri|Sat|Sun)\\b)';
	var dates = '(?:\\b\\d{1,2}(?:st|nd|rd|th)?\\s+' + months + '(?:\\s+\\d{4})?\\b|\\b' + months + '\\s+\\d{1,2}(?:st|nd|rd|th)?(?:,?\\s+\\d{4})?\\b|\\b\\d{1,2}[\\/-]\\d{1,2}[\\/-]\\d{2,4}\\b)';
	var numbers = '(?:\\b\\d{1,4}(?:[,. ]\\d{3})*(?:[.,]\\d+)?(?:%|\\+)?\\b)';
	var places = locations.length ? '(?:\\b(?:' + locations.map(escapeRegExp).join('|') + ')\\b)' : '(?!)';
	var matcher = new RegExp(dates + '|' + days + '|' + places + '|' + numbers, 'gi');
	var excluded = 'script,style,noscript,textarea,input,select,option,button,code,pre,svg,.dk-auto-red,.dk-no-semantic-highlight,[contenteditable="true"]';

	function highlightTextNode(node) {
		if (!node.nodeValue || !node.nodeValue.trim() || !node.parentElement || node.parentElement.closest(excluded)) return;
		matcher.lastIndex = 0;
		if (!matcher.test(node.nodeValue)) return;
		matcher.lastIndex = 0;
		var fragment = document.createDocumentFragment();
		var last = 0;
		node.nodeValue.replace(matcher, function (match, offset) {
			fragment.appendChild(document.createTextNode(node.nodeValue.slice(last, offset)));
			var span = document.createElement('span'); span.className = 'dk-auto-red'; span.textContent = match; fragment.appendChild(span); last = offset + match.length;
			return match;
		});
		fragment.appendChild(document.createTextNode(node.nodeValue.slice(last)));
		node.parentNode.replaceChild(fragment, node);
	}

	function scan(root) {
		if (!root || root.nodeType !== 1 || root.closest && root.closest(excluded)) return;
		var walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT);
		var nodes = []; while (walker.nextNode()) nodes.push(walker.currentNode);
		nodes.forEach(highlightTextNode);
	}

	document.addEventListener('DOMContentLoaded', function () {
		scan(document.body);
		new MutationObserver(function (mutations) {
			mutations.forEach(function (mutation) { mutation.addedNodes.forEach(function (node) { if (node.nodeType === 1) scan(node); }); });
		}).observe(document.body, { childList: true, subtree: true });
	});
}());
