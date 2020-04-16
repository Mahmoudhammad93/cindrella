@extends('welcome')

@section('content')
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    <!-- Banner -->
    <section id="banner">
        <i class="icon fa-diamond"></i>
        <h2>Etiam adipiscing</h2>
        <p>Magna feugiat lorem dolor egestas</p>
        <ul class="actions">
            <li><a href="#" data-value="about-us" class="button big special">Learn More</a></li>
        </ul>
    </section>

    <!-- Two -->
    <section id="about-us" class="wrapper special">
        <div class="inner">
            <div class="header">
                <h2>ABOUT US</h2>
            </div>
            <div class="about-content">
                <div class="about-title">
                    <h5>About us</h5>
                </div>
                <div class="about-body">
                    <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam asperiores, at
                        corporis deserunt dolores error expedita impedit iste iure, iusto modi necessitatibus nulla
                        officia quisquam ratione veniam veritatis voluptates!
                    </div>
                    <div>Accusantium asperiores aut cum delectus dolore, ea error et expedita, explicabo fuga in
                        incidunt ipsa iure nisi nobis numquam officiis quibusdam ratione repudiandae sed tempore tenetur
                        totam velit voluptatem voluptatibus!
                    </div>
                </div>
            </div>
            <div class="about-content">
                <div class="about-title">
                    <h5>How We Work</h5>
                </div>
                <div class="about-body">
                    <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A doloribus obcaecati optio ratione
                        tenetur? Architecto assumenda consequuntur deserunt ducimus ea et illum incidunt, placeat porro
                        possimus quia repellendus similique voluptas.
                    </div>
                    <div>Eaque enim ex labore necessitatibus nulla numquam optio tempore voluptate. Ad culpa cumque
                        debitis eaque laboriosam perspiciatis vel. Ducimus iusto laudantium modi obcaecati quis. Autem
                        cum esse excepturi hic nisi?
                    </div>
                    <div>Esse maxime molestias quo tempore vero? Debitis minima molestias nisi optio quas ratione
                        reprehenderit? Assumenda, blanditiis cupiditate error hic, ipsa laboriosam molestiae numquam
                        obcaecati odit reiciendis repudiandae, sequi sit ullam.
                    </div>
                </div>
            </div>
            <div class="about-content">
                <div class="about-title">
                    <h5>Rate For Us</h5>
                </div>
                <div class="about-body">
                    <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A doloribus obcaecati optio ratione
                        tenetur? Architecto assumenda consequuntur deserunt ducimus ea et illum incidunt, placeat porro
                        possimus quia repellendus similique voluptas.
                    </div>
                    <div>Eaque enim ex labore necessitatibus nulla numquam optio tempore voluptate. Ad culpa cumque
                        debitis eaque laboriosam perspiciatis vel. Ducimus iusto laudantium modi obcaecati quis. Autem
                        cum esse excepturi hic nisi?
                    </div>
                    <div>Esse maxime molestias quo tempore vero? Debitis minima molestias nisi optio quas ratione
                        reprehenderit? Assumenda, blanditiis cupiditate error hic, ipsa laboriosam molestiae numquam
                        obcaecati odit reiciendis repudiandae, sequi sit ullam.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Two -->
    <section id="two" class="wrapper special">
        <div class="inner">
            <header class="major narrow">
                <h2>Aliquam Blandit Mauris</h2>
                <p>Ipsum dolor tempus commodo turpis adipiscing Tempor placerat sed amet accumsan</p>
            </header>
            <div class="image-grid">
                <div class="row">
                    @php
                    if ($products->count() )
                    @endphp
                    @foreach($products as $product)
                        <div class="col col-12 col-lg-3 col-md-12 col-sm-12">
                            <a href="{{ asset('images/'.$product->image) }}" class="image"><span class="overlay"></span><img src="{{ asset('images/'.$product->image) }}" alt="" /></a>
                        </div>
                    @endforeach
                </div>
            </div>
            <ul class="actions">
                <li><a href="#" class="button big alt">Show more</a></li>
            </ul>
        </div>
    </section>

    <!-- Three -->
    <section id="three" class="wrapper slider style3 special">
        <div class="inner">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('images/'.$product->image) }}" alt="{{ $product->image}}">
                    </div>
                    @foreach($products as $product)
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('images/'.$product->image) }}" alt="{{ $product->image}}">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Two -->
    <section id="services" class="wrapper special" style="padding-top: 70px">
        <div class="inner">
            <div class="header">
                <h2>Services</h2>
            </div>
            <div class="about-content">
                <div class="about-title">
                    <h5>Service 1</h5>
                </div>
                <div class="about-body">
                    <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam asperiores, at
                        corporis deserunt dolores error expedita impedit iste iure, iusto modi necessitatibus nulla
                        officia quisquam ratione veniam veritatis voluptates!
                    </div>
                    <div>Accusantium asperiores aut cum delectus dolore, ea error et expedita, explicabo fuga in
                        incidunt ipsa iure nisi nobis numquam officiis quibusdam ratione repudiandae sed tempore tenetur
                        totam velit voluptatem voluptatibus!
                    </div>
                </div>
            </div>
            <div class="about-content">
                <div class="about-title">
                    <h5>Service 2</h5>
                </div>
                <div class="about-body">
                    <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam asperiores, at
                        corporis deserunt dolores error expedita impedit iste iure, iusto modi necessitatibus nulla
                        officia quisquam ratione veniam veritatis voluptates!
                    </div>
                    <div>Accusantium asperiores aut cum delectus dolore, ea error et expedita, explicabo fuga in
                        incidunt ipsa iure nisi nobis numquam officiis quibusdam ratione repudiandae sed tempore tenetur
                        totam velit voluptatem voluptatibus!
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Three -->
    <section id="three" class="wrapper style3 special">
        <div class="inner">
            <header class="major narrow	">
                <h2>Magna sed consequat tempus</h2>
                <p>Ipsum dolor tempus commodo turpis adipiscing Tempor placerat sed amet accumsan</p>
            </header>
            <ul class="actions">
                <li><a href="#" class="button big alt">Magna feugiat</a></li>
            </ul>
        </div>
    </section>

    <!-- Four -->
    <section id="contact-us" class="wrapper style2 special">
        <div class="inner">
            <header class="major narrow">
                <h2>Get in touch</h2>
                <p>Ipsum dolor tempus commodo adipiscing</p>
            </header>
            <form action="#" method="POST">
                <div class="container 75%">
                    <div class="row uniform 50%">
                        <div class="6u 12u$(xsmall)">
                            <input name="name" placeholder="Name" type="text" />
                        </div>
                        <div class="6u$ 12u$(xsmall)">
                            <input name="email" placeholder="Email" type="email" />
                        </div>
                        <div class="12u$">
                            <textarea name="message" placeholder="Message" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <ul class="actions">
                    <li><input type="submit" class="special" value="Submit" /></li>
                    <li><input type="reset" class="alt" value="Reset" /></li>
                </ul>
            </form>
        </div>
    </section>
@endsection
