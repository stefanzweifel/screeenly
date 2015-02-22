/**
 * Google Analytics Code
 */
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-28868343-7', 'auto');
ga('send', 'pageview');
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