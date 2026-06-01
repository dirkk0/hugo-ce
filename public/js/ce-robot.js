const logo = document.querySelector('#corner-logo');
const logoHead = logo.querySelector('.logo-head');
const logoAntenna = logo.querySelector('.antenna');
const logoAntennaRect = logo.querySelector('.antenna-rect');
const logoAntennaBall = logo.querySelector('.antenna-ball');
const logoEyes = Array.from(logo.querySelectorAll('.logo-eye'));
const signalLines = Array.from(logo.querySelectorAll('.signal > circle'));

let lerp = (start, end, amt) => (1 - amt) * start + amt * end;
let mouse = {
    x: 0,
    y: 0,
    targetX: 0,
    targetY: 0
}

document.addEventListener('mousemove', (e) => {
    updateMousePosition(e.clientX, e.clientY, this);
});
document.addEventListener('touchmove', (e) => {
    updateMousePosition(e.touches[0].pageX, e.touches[0].pageY, this);
});
document.addEventListener('click', () => {
    signal()
});
window.addEventListener('load', () => {
    antenna()
});
gsap.ticker.add(mouseEasingCallback);

blink();

function updateMousePosition(eX, eY) {
    mouse.targetX = eX;
    mouse.targetY = eY;
}
function mouseEasingCallback() {
    mouse.x = lerp(mouse.x, mouse.targetX, .1);
    mouse.y = lerp(mouse.y, mouse.targetY, .1);
    const angle = .3 * Math.atan2(mouse.y, mouse.x) * 180 / Math.PI;
    gsap.set(logoHead, {
        rotation: angle + 10,
        svgOrigin: '22 26'
    });
    gsap.set(logoEyes[0], {
        x: 3 * mouse.x / window.innerWidth,
        y: 1.5 * mouse.y / window.innerHeight
    });
    gsap.set(logoEyes[1], {
        x: 1.5 * mouse.x / window.innerWidth,
        y: 1.5 * mouse.y / window.innerHeight
    });
}

function blink() {
    gsap.timeline({
        onComplete: blink
    })
        .to(logoEyes, {
            duration: .2,
            scaleY: .1,
            transformOrigin: '50% 80%'
        }, Math.random() * 4)
        .to(logoEyes, {
            duration: .1,
            scaleY: 1,
        })
}

function signal() {
    gsap.timeline({})
        .to(signalLines, {
            duration: .2,
            stagger: .1,
            opacity: 1
        })
        .to(signalLines, {
            duration: .2,
            stagger: .1,
            opacity: 0,
        }, '>-.2')
}

function antenna() {
    gsap.timeline({
        delay: .4, // so it doesn't start immediately on load
    })
        .fromTo(logoAntenna, {
            duration: 1.2,
            x: .5,
            y: 7.6
        }, {
            x: 0,
            y: 0
        }, 0)
        .fromTo(logoAntennaRect, {
            duration: 1.2,
            attr: {
                height: 0
            }
        }, {
            attr: {
                height: 7.6
            }
        }, 0)
        .to(logoAntennaBall, {
            duration: 1,
            attr: {
                r: .9
            },
            ease: 'back(3).out'
        }, .1)
}