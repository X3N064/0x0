const existingPix = document.querySelector('.pix');
const container = document.querySelector('.container');
const loginForm = document.querySelector('.login');

let dx = Math.random() * 5 + 2; // Initial horizontal speed
let dy = Math.random() * 5 + 2; // Initial vertical speed

function getRandomDirection() {
    // Randomly choose a direction: 1 or -1
    return Math.random() < 0.5 ? -1 : 1;
}

function getRandomSpeed() {
    // Random speed between 2 and 6
    return Math.random() * 2 + 2;
}

function movePix() {
    let newX = existingPix.offsetLeft + dx;
    let newY = existingPix.offsetTop + dy;

    // Calculate Pix's boundaries
    const pixLeft = newX;
    const pixRight = newX + existingPix.clientWidth;
    const pixTop = newY;
    const pixBottom = newY + existingPix.clientHeight;

    // Check if Pix hits the container walls
    if (pixLeft < 0 || pixRight > container.clientWidth) {
        dx = -dx; // Reverse horizontal direction
    }
    if (pixTop < 0 || pixBottom > container.clientHeight) {
        dy = -dy; // Reverse vertical direction
    }

    // Check if Pix hits the collision box
    const collisionBox = document.querySelector('.collision-box');
    const collisionBoxRect = collisionBox.getBoundingClientRect();
    const collisionBoxLeft = collisionBoxRect.left;
    const collisionBoxRight = collisionBoxRect.right;
    const collisionBoxTop = collisionBoxRect.top;
    const collisionBoxBottom = collisionBoxRect.bottom;

    if (
        pixRight > collisionBoxLeft &&
        pixLeft < collisionBoxRight &&
        pixBottom > collisionBoxTop &&
        pixTop < collisionBoxBottom
    ) {
        // Generate random direction vectors
        dx = getRandomSpeed() * getRandomDirection();
        dy = getRandomSpeed() * getRandomDirection();
    }

    // Update Pix's position
    newX = existingPix.offsetLeft + dx; // Update newX after collision handling
    newY = existingPix.offsetTop + dy; // Update newY after collision handling
    existingPix.style.left = newX + 'px';
    existingPix.style.top = newY + 'px';

    // Move Pix at approximately 60 frames per second
    requestAnimationFrame(movePix);
}

function createPix(event) {
    const newPix = document.createElement('img');
    newPix.src = 'pix.png';
    newPix.alt = 'Cute Pix';
    newPix.classList.add('pix');
    newPix.style.position = 'absolute';
    newPix.style.left = event.clientX - 30 + 'px'; // Adjust for Pix width
    newPix.style.top = event.clientY - 30 + 'px'; // Adjust for Pix height
    container.appendChild(newPix);

    // Start moving the new Pix
    movePix();
}

function toggleForm() {
    var loginForm = document.getElementById('loginForm');
    var registerForm = document.getElementById('registerForm');
    
    if (loginForm.style.display === 'none') {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
    } else {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    }
}

// Add click event listener to the existing Pix to create a new Pix
existingPix.addEventListener('click', createPix);
existingPix.addEventListener('click', toggleForm);
// Start moving the existing Pix
movePix();
