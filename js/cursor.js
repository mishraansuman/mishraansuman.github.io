const follower = document.querySelector('.follower');
const cursor = document.querySelector('.cursor');

// 0.01 : 0.35
let acceleration = 0.1;

// Just for initial positioning
let x = currX = innerWidth / 2;
let y = currY = innerHeight / 2;


// Store the mouse position
window.addEventListener('mousemove', event => {
	let e = event.touches ? event.touches[0] : event;
	x = e.pageX;
	y = e.pageY;
});

const update = (elm, prop, val) => {
	elm.style.setProperty(prop, val);
};

const lerp = (_new, _old) => {
	return (_new += (_old - _new) * acceleration);
};

const animate = () => {
	currX = lerp(currX, x);
	currY = lerp(currY, y);

	update(follower, '--mouse-x', currX);
	update(follower, '--mouse-y', currY);

	update(cursor, '--mouse-x', x);
	update(cursor, '--mouse-y', y);

	requestAnimationFrame(animate);
};

animate();
