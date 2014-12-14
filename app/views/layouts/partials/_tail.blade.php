        <script src="{{ URL::asset('assets/scripts/vendor.min.js') }}"></script>

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-28868343-7', 'auto');
          ga('send', 'pageview');

        </script>

        <script src="//code.jquery.com/jquery.js"></script>
        <script>
            $(document).ready(function() {
                var menu = $('#navigation-menu');
                var menuToggle = $('#js-mobile-menu');
                var signUp = $('.sign-up');

                $(menuToggle).on('click', function(e) {
                  e.preventDefault();
                  menu.slideToggle(function(){
                    if(menu.is(':hidden')) {
                      menu.removeAttr('style');
                    }
                  });
            });

            // underline under the active nav item
            $(".nav .nav-link").click(function() {
                  $(".nav .nav-link").each(function() {
                    $(this).removeClass("active-nav-item");
                  });
                  $(this).addClass("active-nav-item");
                  $(".nav .more").removeClass("active-nav-item");
                });
            });

        </script>
    </body>
</html>