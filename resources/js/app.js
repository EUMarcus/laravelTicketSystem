import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { gsap } from 'gsap';

// Initialize AOS (Animate On Scroll) when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 1200,
        easing: 'ease-out-cubic',
        once: false,
        offset: 0, // Changed to 0 so elements trigger immediately when in view
        delay: 0,
        disable: false,
        mirror: true,
        startEvent: 'DOMContentLoaded' // Start animations immediately
    });
    
    // Force refresh AOS to check initial viewport
    AOS.refresh();

    // Smooth parallax effect with GSAP for hero background
    const heroParallax = document.querySelector('.hero-parallax');
    if (heroParallax) {
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * 0.3;
            gsap.to(heroParallax, {
                y: rate,
                duration: 0.5,
                ease: 'power1.out'
            });
            lastScroll = scrolled;
        });
    }

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

    // Smooth scroll reveal for stats cards
    const statCards = document.querySelectorAll('.stat-card');
    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                gsap.from(entry.target, {
                    opacity: 0,
                    scale: 0.8,
                    y: 50,
                    duration: 1,
                    delay: index * 0.1,
                    ease: 'back.out(1.7)'
                });
                statObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

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

    // Smooth number counting with GSAP
    const numberObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const finalNumber = parseInt(target.textContent) || 0;
                
                gsap.fromTo(
                    { value: 0 },
                    {
                        value: finalNumber,
                        duration: 2,
                        ease: 'power2.out',
                        onUpdate: function() {
                            target.textContent = Math.floor(this.targets()[0].value);
                        }
                    }
                );
                numberObserver.unobserve(target);
            }
        });
    }, { threshold: 0.5 });

    // Observe all stat numbers
    document.querySelectorAll('.text-5xl, .stat-number').forEach(stat => {
        const num = parseInt(stat.textContent);
        if (!isNaN(num) && num > 0) {
            stat.textContent = '0';
            numberObserver.observe(stat);
        }
    });

    // Smooth scroll reveal for sections
    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                gsap.from(entry.target, {
                    opacity: 0,
                    y: 100,
                    duration: 1.5,
                    delay: index * 0.1,
                    ease: 'power3.out'
                });
                sectionObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('section, .mb-20, .mb-24').forEach(section => {
        sectionObserver.observe(section);
    });

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
});
