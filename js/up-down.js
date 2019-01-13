/**
 * File up-down.js.
 *
 * Scroll up box.
 *
 * This is convenient when you have a long page, and you want to give your visitors an easy way to get back to the top.
 */
var updownElem = document.getElementById( 'up-down' ),
	pageYLabel = 0;

updownElem.onclick = function() {
	var pageY = window.pageYOffset || document.documentElement.scrollTop;

	switch ( this.className ) {
		case 'up' :
			pageYLabel = pageY;
			window.scrollTo( 0, 0 );
			this.className = 'down';
		break;

		case 'down' :
			window.scrollTo( 0, pageYLabel );
			this.className = 'up';
	}
}

window.onscroll = function() {
	var pageY = window.pageYOffset || document.documentElement.scrollTop,
		innerHeight = document.documentElement.clientHeight;

	switch ( updownElem.className ) {
		case '' :
			if ( pageY > innerHeight ) {
				updownElem.className = 'up';
			}
		break;

		case 'up' :
			if ( pageY < innerHeight ) {
				updownElem.className = '';
			}
		break;

		case 'down' :
			if ( pageY > innerHeight ) {
				updownElem.className = 'up';
			}
		break;
	}
}
