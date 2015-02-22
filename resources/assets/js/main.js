/**
 * ParticleJS @landingpage
 */
particlesJS('particles-js', {
    particles: {
        color: '#E64A19',
        shape: 'circle', // "circle", "edge" or "triangle"
        opacity: .8,
        size: 2,
        size_random: true,
        nb: 200,
        line_linked: {
            enable_auto: true,
            distance: 100,
            color: '#E64A19',
            opacity: .8,
            width: 1,
            condensed_mode: {
                enable: true,
                rotateX: 600,
                rotateY: 600
            }
        },
        anim: {
            enable: true,
            speed: 1.5
        }
    },
    interactivity: {
        enable: false,
        mouse: {
            distance: 250
        },
        detect_on: 'canvas', // "canvas" or "window"
        mode: 'grab',
        line_linked: {
            opacity: .5
        },
        events: {
            onclick: {
                enable: true,
                mode: 'push', // "push" or "remove" (particles)
                nb: 4
            }
        }
    },
    /* Retina Display Support */
    retina_detect: true
});