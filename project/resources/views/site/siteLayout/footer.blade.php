<!-- Footer -->
<footer id="footer">
    <div class="inner">
        <ul class="icons">
            <li><a href="https://www.facebook.com/mahmoud.h.hammad.1" target="_blank" class="icon fa-facebook">
                    <span class="label">Facebook</span>
                </a>
            </li>
            <li><a href="https://twitter.com/MahmoudHammad93" target="_blank" class="icon fa-twitter">
                    <span class="label">Twitter</span>
                </a>
            </li>
            <li><a href="https://www.instagram.com/mahmoud_._hammad/" target="_blank" class="icon fa-instagram">
                    <span class="label">Instagram</span>
                </a>
            </li>
            <li><a href="https://www.linkedin.com/in/mahmoud-hammad-29a3ab15a" target="_blank" class="icon fa-linkedin">
                    <span class="label">LinkedIn</span>
                </a>
            </li>
        </ul>
        <ul class="copyright">
            <li>&copy; Made By <i class="fa fa-heart heart"></i> With <a href="https://www.facebook.com/mahmoud.h.hammad.1" target="_blank">Mahmoud Hammad</a> </li>
        </ul>
    </div>
</footer>
@include('site.siteLayout.sideBar')

<!-- Scripts -->
<script src="{{ asset('site/assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('site/assets/js/popper.min.js')}}"></script>
<script src="{{asset('site/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('site/assets/js/skel.min.js') }}"></script>
<script src="{{ asset('site/assets/js/util.js') }}"></script>
<script src="{{ asset('js/sweetalert.js') }}"></script>
<script src="{{ asset('js/iziToast.min.js') }}"></script>
<!--[if lte IE 8]><script src="{{ asset('site/assets/js/ie/respond.min.js') }}"></script><![endif]-->
<script src="{{ asset('site/assets/js/main.js') }}"></script>
<!-- VueJs -->
<script src="{{ asset('js/vue.min.js') }}"></script>
@yield('script')
<script>
    $(document).ready(function () {
        if (!$('.wrapper').hasClass('style1')){
            $('.head').css('background-color', '#f7f7f7');
        }
    });

    // To show result of search
    $(document).ready(function () {
        function fetch_customer_data(query = '')
        {
            $.ajax({
                url:"{{ route('search') }}",
                method:'GET',
                data:{query:query},
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                dataType:'json',
                success:function(data)
                {
                    if (data.length !== ''){
                        console.log(data)
                        var resule = '';
                        data.forEach(function (element) {
                            var resule = '';
                            resule = '<p><a href="{{ url('site/product/') }}/'+element.id+'/details">'+element.name+'--'+element.desc+'</a></p>';
                            $('.search-result').append(resule);
                            $('.search-result').slideDown(0);
                        });
                    }else {
                        $('.search-result').html('');
                    }
                }
            })
        }
        $(document).on('keyup', '#search-field', function () {
            var query = $(this).val();
            if (query !== ''){
                fetch_customer_data(query);
                $('#search-field').css({'border-color': '#fff'});
            }else{
                $('.search-result').html('');
                $('.search-result').slideUp();
            }
        });
    });

    $(document).on('blur', '#search-field', function () {
        $('.search-result').slideUp();
    });

    $(document).on('submit', '#search-submit', function () {
        var input = $('#search-field').val();
        if (input === ""){
            return false;
            $('#search-field').css({'border-color': 'red'});
        }
    });

</script>
</body>
</html>
