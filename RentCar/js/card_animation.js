
$("#container_cards button").hover(function () {
	// приближение
	$(this).css("z-index", 1);
	$(this).animate({
		height: "107%",
		width: "107%",
		left: "-=6%",
		top: "-=6%"
	}, "fast");
}, function () {
	// отдаление
	$(this).css("z-index", 0);
	$(this).animate({
		height: "95%",
		width: "95%",
		left: "+=6%",
		top: "+=6%"
	}, "fast");
});
