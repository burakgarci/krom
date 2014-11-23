/* == Geliştiriye Not ==
 * script.js sadece "SCRIPT_DEBUG", wp-config.php dosyasında "true" olarak tanımlanmışsa çağırılır.
 * Bu temayı yüklediğiniz site herkese açıksa, bu dosyayı düzenleyin ve sıkıştırılmış halini script.min.js olarak kaydedin.
 * Herkese açık bir sitede bu dosyayı çağırmak için "SCRIPT_DEBUG" sabitini "true" olarak tanımlaMAyın. 
*/

// "selectText" kaynağı: http://stackoverflow.com/questions/985272/
// Kodun aynısı adreste olmayabilir; yazar cevabını değiştirmiş olabilir.
jQuery.fn.selectText = function () {
	var doc = document,
	element = this[0],
	range, selection;
	if (doc.body.createTextRange) {
		range = document.body.createTextRange();
		range.moveToElementText(element);
		range.select();
	} else if (window.getSelection) {
		selection = window.getSelection();
		range = document.createRange();
		range.selectNodeContents(element);
		selection.removeAllRanges();
		selection.addRange(range);
	}
};

// pre ve code elementi içindekileri çift tıklandığında seç
$('pre, code').dblclick(function () {
	$(this).selectText();
});


// Arama formu geçiş
$("div#ust-arama-gecis").click(function() {
	$("#ust-arama").slideToggle(100, function() {
		$("#ust-arama-metni").focus();
	});
})

// Ana menü geçiş
$("div#ana-menu-gecis").click(function() {
	$(".ana-menu").slideToggle(100);
})
