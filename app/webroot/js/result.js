var flag = false;
var name = null;

$(document).ready(function () {
	$(".table td").on("click", function () {
		if (flag == false) {
			flag = true;
			$(this).addClass("on");
			name = $(this).text();
			$(".on").css({ "background-color": "yellow" });
		} else {
			flag = false;
			$(".on").css({ "background-color": "initial" });
			$(".on").removeClass("on").text($(this).text());
			$(this).text(name);
			name = null;
		}
	});

	$(document).on("click", function (e) {
		if (!$(e.target).is(".table td")) {
			flag = false;
			name = null;
			$(".on").css({ "background-color": "initial" });
			$(".on").removeClass("on");
		}
	});

	$("#saveImage").on("click", function () {
		html2canvas(document.querySelector("#result")).then((canvas) => {
			let downloadEle = document.createElement("a");
			downloadEle.href = canvas.toDataURL("image/png");
			downloadEle.download = "result.png";
			downloadEle.click();
		});
	});
});
