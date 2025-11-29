import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { gsap } from 'gsap';

// Initialize AOS (Animate On Scroll) when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true, // Animate only once - prevents repeat animations on scroll
        offset: 100, // Trigger when element is 100px from viewport
        delay: 0,
        disable: false,
        mirror: false, // Disable mirror - prevents animations from repeating
        startEvent: 'DOMContentLoaded'
    });
    
    // Force refresh AOS to check initial viewport
    AOS.refresh();

    // Removed parallax scroll effect to reduce scroll behavior
    // Parallax was causing constant scroll event listeners

    // Smooth fade-in animation for hero content - ensure visible first
    const heroContent = document.querySelector('section.relative.min-h-screen .relative.max-w-7xl');
    if (heroContent) {
        // Make sure hero content is visible immediately
        heroContent.style.opacity = '1';
        heroContent.style.visibility = 'visible';
        
        // Ensure all children are visible
        if (heroContent.children) {
            Array.from(heroContent.children).forEach((child) => {
                child.style.opacity = '1';
                child.style.visibility = 'visible';
            });
        }
    }

    // Enhanced floating particles animation
    document.querySelectorAll('.particle').forEach((particle, index) => {
        const randomY = Math.random() * 60 - 30;
        const randomX = Math.random() * 40 - 20;
        const randomDuration = 3 + Math.random() * 3;
        const randomDelay = index * 0.5;

        gsap.to(particle, {
            y: randomY,
            x: randomX,
            rotation: 360,
            duration: randomDuration,
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut',
            delay: randomDelay
        });
    });

    // Magnetic hover effect for buttons and cards
    document.querySelectorAll('a.group, button, .magnetic').forEach(element => {
        element.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const moveX = (x - centerX) * 0.15;
            const moveY = (y - centerY) * 0.15;

            gsap.to(this, {
                x: moveX,
                y: moveY,
                duration: 0.4,
                ease: 'power2.out'
            });
        });

        element.addEventListener('mouseleave', function() {
            gsap.to(this, {
                x: 0,
                y: 0,
                duration: 0.6,
                ease: 'elastic.out(1, 0.5)'
            });
        });
    });

    // Smooth scroll reveal for stats cards - ensure visible first
    const statCards = document.querySelectorAll('.stat-card');
    
    // Make sure stat cards are visible immediately
    statCards.forEach(card => {
        card.style.opacity = '1';
        card.style.visibility = 'visible';
    });
    
    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Only animate if not already visible
                if (entry.target.style.opacity !== '1') {
                    gsap.fromTo(entry.target, 
                        { opacity: 0, scale: 0.8, y: 50 },
                        {
                            opacity: 1,
                            scale: 1,
                            y: 0,
                            duration: 0.8,
                            delay: index * 0.1,
                            ease: 'back.out(1.7)'
                        }
                    );
                }
                statObserver.unobserve(entry.target); // Stop observing after animation
            }
        });
    }, { threshold: 0.1, rootMargin: '50px' }); // Lower threshold, add margin for earlier trigger

    statCards.forEach(card => statObserver.observe(card));

    // 3D tilt effect for service cards
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = (y - centerY) / 15;
            const rotateY = (centerX - x) / 15;

            gsap.to(this, {
                rotationX: rotateX,
                rotationY: rotateY,
                transformPerspective: 1000,
                duration: 0.3,
                ease: 'power1.out'
            });
        });

        card.addEventListener('mouseleave', function() {
            gsap.to(this, {
                rotationX: 0,
                rotationY: 0,
                duration: 0.6,
                ease: 'elastic.out(1, 0.5)'
            });
        });
    });

    // Ripple effect on button click
    document.querySelectorAll('a, button').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!this.classList.contains('ripple-container')) {
                this.classList.add('ripple-container');
            }

            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.className = 'animate-ripple';
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255, 255, 255, 0.6);
                border-radius: 50%;
                pointer-events: none;
                z-index: 1000;
            `;

            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);

            gsap.to(ripple, {
                scale: 4,
                opacity: 0,
                duration: 0.8,
                ease: 'power2.out',
                onComplete: () => ripple.remove()
            });
        });
    });

    // Smooth number counting with GSAP - ensure numbers are visible
    const statNumbers = document.querySelectorAll('.stat-card .text-5xl');
    
    statNumbers.forEach(stat => {
        const num = parseInt(stat.textContent);
        if (!isNaN(num) && num > 0) {
            // Store original number in data attribute
            stat.setAttribute('data-original', num);
            // Keep original number visible - don't reset to 0 yet
            stat.style.opacity = '1';
            stat.style.visibility = 'visible';
            stat.style.display = 'block';
        }
    });
    
    const numberObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const finalNumber = parseInt(target.getAttribute('data-original')) || parseInt(target.textContent) || 0;
                
                if (finalNumber > 0) {
                    // Only animate if we haven't already
                    if (!target.classList.contains('counting-animated')) {
                        target.classList.add('counting-animated');
                        // Set to 0 first, then animate
                        const currentText = target.textContent;
                        target.textContent = '0';
                        const counter = { value: 0 };
                        gsap.to(counter, {
                            value: finalNumber,
                            duration: 1.5,
                            ease: 'power2.out',
                            onUpdate: function() {
                                target.textContent = Math.floor(counter.value);
                            },
                            onComplete: function() {
                                target.textContent = finalNumber; // Ensure final number is set
                            }
                        });
                    }
                }
                numberObserver.unobserve(target);
            }
        });
    }, { threshold: 0.1, rootMargin: '100px' }); // Larger margin for earlier trigger

    // Observe all stat numbers - they'll keep their original values until animation triggers
    statNumbers.forEach(stat => {
        const num = parseInt(stat.getAttribute('data-original')) || parseInt(stat.textContent);
        if (!isNaN(num) && num > 0) {
            numberObserver.observe(stat);
        }
    });

    // Removed sectionObserver - redundant with AOS animations
    // This was causing duplicate animations and excessive scroll behavior

    // Enhanced card hover with scale and glow
    document.querySelectorAll('.bg-white.rounded-xl, .bg-white.rounded-2xl').forEach(card => {
        card.addEventListener('mouseenter', function() {
            gsap.to(this, {
                scale: 1.03,
                boxShadow: '0 20px 40px rgba(0, 0, 0, 0.15)',
                duration: 0.4,
                ease: 'power2.out'
            });
        });

        card.addEventListener('mouseleave', function() {
            gsap.to(this, {
                scale: 1,
                boxShadow: '',
                duration: 0.4,
                ease: 'power2.out'
            });
        });
    });

    // Smooth gradient animation for text
    document.querySelectorAll('.animate-gradient').forEach(text => {
        gsap.to(text, {
            backgroundPosition: '200% center',
            duration: 4,
            repeat: -1,
            ease: 'none'
        });
    });

    // Smooth page load animation
    gsap.from('body', {
        opacity: 0,
        duration: 0.5,
        ease: 'power2.in'
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
