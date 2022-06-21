// Ansuman Mishra(Ansuman.tech)

// ░█████╗░███╗░░██╗░██████╗██╗░░░██╗███╗░░░███╗░█████╗░███╗░░██╗  ███╗░░░███╗██╗░██████╗██╗░░██╗██████╗░░█████╗░
// ██╔══██╗████╗░██║██╔════╝██║░░░██║████╗░████║██╔══██╗████╗░██║  ████╗░████║██║██╔════╝██║░░██║██╔══██╗██╔══██╗
// ███████║██╔██╗██║╚█████╗░██║░░░██║██╔████╔██║███████║██╔██╗██║  ██╔████╔██║██║╚█████╗░███████║██████╔╝███████║
// ██╔══██║██║╚████║░╚═══██╗██║░░░██║██║╚██╔╝██║██╔══██║██║╚████║  ██║╚██╔╝██║██║░╚═══██╗██╔══██║██╔══██╗██╔══██║
// ██║░░██║██║░╚███║██████╔╝╚██████╔╝██║░╚═╝░██║██║░░██║██║░╚███║  ██║░╚═╝░██║██║██████╔╝██║░░██║██║░░██║██║░░██║
// ╚═╝░░╚═╝╚═╝░░╚══╝╚═════╝░░╚═════╝░╚═╝░░░░░╚═╝╚═╝░░╚═╝╚═╝░░╚══╝  ╚═╝░░░░░╚═╝╚═╝╚═════╝░╚═╝░░╚═╝╚═╝░░╚═╝╚═╝░░╚═╝

// 𝘞𝘢𝘳𝘯𝘪𝘯𝘨:𝘠𝘰𝘶 𝘊𝘢𝘯 𝘙𝘦𝘱𝘭𝘪𝘤𝘢𝘵𝘦 𝘛𝘩𝘦 𝘜𝘐 𝘉𝘶𝘵 𝘋𝘰 𝘕𝘖𝘛 𝘵𝘳𝘺 𝘵𝘰 𝘊𝘰𝘱𝘺 𝘛𝘩𝘦 𝘊𝘰𝘯𝘵𝘦𝘯𝘵 𝘈𝘯𝘥 𝘛𝘩𝘦 𝘗𝘦𝘳𝘴𝘰𝘯𝘢𝘭 𝘋𝘦𝘵𝘢𝘪𝘭𝘴.
// 𝘚𝘰𝘶𝘳𝘤𝘦𝘊𝘰𝘥𝘦 𝘈𝘷𝘢𝘪𝘭𝘢𝘣𝘭𝘦@ 𝘩𝘵𝘵𝘱𝘴://𝘨𝘪𝘵𝘩𝘶𝘣.𝘤𝘰𝘮/𝘢𝘯𝘴𝘮𝘪𝘴-𝘭𝘪𝘵/𝘢𝘯𝘴𝘮𝘪𝘴-𝘭𝘪𝘵.𝘨𝘪𝘵𝘩𝘶𝘣.𝘪𝘰


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