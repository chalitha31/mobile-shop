// // Initialize ball position and velocity
// let x = 0;
// let y = 0;
// let vx = 5;
// let vy = 5;

// // Create an HTML canvas element
// const canvas = document.createElement('canvas');
// document.body.appendChild(canvas);
// const ctx = canvas.getContext('2d');

// // Set canvas dimensions to match the size of the browser window
// canvas.width = window.innerWidth;
// canvas.height = window.innerHeight;

// // Create a callback function that will be executed repeatedly
// const animate = () => {
//     // Clear the canvas
//     ctx.clearRect(0, 0, canvas.width, canvas.height);

//     // Draw the ball at its current position
//     ctx.beginPath();
//     ctx.arc(x, y, 10, 0, 2 * Math.PI);
//     ctx.fill();

//     // Update the ball's position based on its velocity
//     x += vx;
//     y += vy;

//     // If the ball hits a wall, reverse its velocity
//     if (x < 0 || x > canvas.width) vx *= -1;
//     if (y < 0 || y > canvas.height) vy *= -1;
// };

// // Use setInterval() to execute the animate callback
// // at a rate of 60 frames per second
// setInterval(animate, 1000 / 60);


var flipCard = document.querySelector(".flip-card");

flipCard.addEventListener("click", function() {
    flipCard.classList.toggle("flip");
})