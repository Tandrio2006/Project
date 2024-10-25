let currentCaptcha = '';

function generatedCaptcha() {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let captcha = '';
    for (let i = 0; i < 6; i++) {
        captcha += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    currentCaptcha = captcha;

    const canvas = document.getElementById('captchaCanvas');
    const ctx = canvas.getContext('2d');

    // Clear the canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Set background color
    ctx.fillStyle = '#e0e0e0';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Draw noise lines
    for (let i = 0; i < 5; i++) {
        ctx.strokeStyle = '#ccc';
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(Math.random() * canvas.width, Math.random() * canvas.height);
        ctx.lineTo(Math.random() * canvas.width, Math.random() * canvas.height);
        ctx.stroke();
    }

    ctx.font = '36px Arial';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';

    const charSpacing = 30; // Space between characters
    const startX = (canvas.width - (charSpacing * captcha.length)) / 2 + charSpacing / 2; // Start position

    // Draw each character with rotation and random color
    for (let i = 0; i < captcha.length; i++) {
        ctx.save();
        ctx.fillStyle = getRandomColor();
        const x = startX + i * charSpacing; // Calculate position

        // Rotate character randomly
        const angle = (Math.random() - 0.5) * Math.PI / 6; // Rotate up to ±30 degrees
        ctx.translate(x, canvas.height / 2); // Center vertically
        ctx.rotate(angle);
        ctx.fillText(captcha[i], 0, 0);
        ctx.restore();
    }
}

function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function validateCaptcha() {
    const userInput = document.getElementById('userInput').value;
    const message = document.getElementById('messages');
    
    if (userInput === currentCaptcha) {
        message.textContent = 'CAPTCHA validated successfully!';
        message.style.color = 'green';
    } else {
        message.textContent = 'Incorrect CAPTCHA. Please try again.';
        message.style.color = 'red';
    }
}

window.onload = generatedCaptcha;
