import './bootstrap';

// Simple initialization with snowfall effect
document.addEventListener('DOMContentLoaded', function() {
    // Ensure all content is visible immediately
    document.querySelectorAll('[data-aos]').forEach(element => {
        element.style.opacity = '1';
        element.style.visibility = 'visible';
        element.style.transform = 'none';
    });
    
    // Ensure hero content is visible
    const heroContent = document.querySelector('section.relative.min-h-screen .relative.max-w-7xl');
    if (heroContent) {
        heroContent.style.opacity = '1';
        heroContent.style.visibility = 'visible';
        
        if (heroContent.children) {
            Array.from(heroContent.children).forEach((child) => {
                child.style.opacity = '1';
                child.style.visibility = 'visible';
            });
        }
    }
    
    // Ensure stat cards are visible
    document.querySelectorAll('.stat-card').forEach(card => {
        card.style.opacity = '1';
        card.style.visibility = 'visible';
    });
    
    // Ensure stat numbers are visible
    document.querySelectorAll('.stat-card .text-5xl').forEach(stat => {
        stat.style.opacity = '1';
        stat.style.visibility = 'visible';
        stat.style.display = 'block';
    });
    
    // Snowfall Effect
    initSnowfall();
});

// Snowfall Animation Function
function initSnowfall() {
    const canvas = document.getElementById('snowfall-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let animationId;
    
    // Set canvas size - prevent horizontal overflow
    function resizeCanvas() {
        const maxWidth = Math.min(canvas.offsetWidth, window.innerWidth);
        canvas.width = maxWidth;
        canvas.height = canvas.offsetHeight;
    }
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    // Snowflake class
    class Snowflake {
        constructor() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.radius = Math.random() * 3 + 1;
            this.speed = Math.random() * 2 + 0.5;
            this.opacity = Math.random() * 0.5 + 0.3;
            this.wind = Math.random() * 0.5 - 0.25;
        }

        update() {
            this.y += this.speed;
            this.x += this.wind + Math.sin(this.y * 0.01) * 0.5;

            // Reset if snowflake goes off screen
            if (this.y > canvas.height) {
                this.y = -10;
                this.x = Math.random() * canvas.width;
            }
            if (this.x > canvas.width + 10) {
                this.x = -10;
            }
            if (this.x < -10) {
                this.x = canvas.width + 10;
            }
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`;
            ctx.fill();
            
            // Add sparkle effect
            if (Math.random() > 0.98) {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius * 2, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity * 0.5})`;
                ctx.fill();
            }
        }
    }

    // Create snowflakes
    const snowflakes = [];
    const snowflakeCount = Math.floor((canvas.width * canvas.height) / 15000);
    
    for (let i = 0; i < snowflakeCount; i++) {
        snowflakes.push(new Snowflake());
    }

    // Animation loop
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        snowflakes.forEach(snowflake => {
            snowflake.update();
            snowflake.draw();
        });
        
        animationId = requestAnimationFrame(animate);
    }

    // Start animation
    animate();

    // Pause animation when page is not visible (performance optimization)
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            cancelAnimationFrame(animationId);
        } else {
            animate();
        }
    });
}
