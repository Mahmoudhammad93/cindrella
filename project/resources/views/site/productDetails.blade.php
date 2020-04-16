@extends('welcome')

@section('content')

    <!-- Main -->
    <section id="main" class="wrapper">
        @if($product)
            <div class="container">
                @include('site.siteLayout.head')
                <header class="major special">
                    <h2>{{ $product->name }}</h2>
                    <p>{{ $product->created_at->format('d M Y') }}</p>
                </header>

                <div class="details">
                    <div class="image-info">
                        <div class="img">
                            <a href="{{ asset('images/'.$product->image) }}" class="image fit" data-toggle="modal" data-target="#exampleModal"><img src="{{ asset('images/'.$product->image) }}" alt="" /></a>
                            <div class="img-footer">
                                <div class="prod-info">
                                    <p>
                                        {{ $product->name }}
                                    </p>
                                    <p>
                                        @if($product->discount)
                                            <span>
                                            <span class="badge badge-light line" style="margin-left: 20px">{{ number_format($product->pay_price, 0, ',',',') }},00 LE</span>
                                            <span class="disc">-{{ $product->discount }}%</span>
                                        </span>
                                            <span class="badge badge-warning" style="margin-left: 20px">{{ number_format($product->pay_price - ($product->pay_price * $product->discount) / 100, 0, ',',',') }},00 LE</span>
                                        @else
                                            <span class="badge badge-warning" style="margin-left: 20px">{{ number_format($product->pay_price, 0, ',',',') }},00 LE</span>
                                        @endif
                                    </p>
                                </div>
                                <p style="display: flex; align-items: center;justify-content: space-between;">{{ $product->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="rate">
                            <div class="container">
                                <h4 class="title">
                                    Feedback:
                                </h4>
                                <div class="feedback">
                                    @if($product->rate > 0)
                                        <h4 class="title">
                                            Rate
                                        </h4>
                                        <h4 style="color: #ffaf2c">
                                            <span class="rate-num">{{ $product->rate }}</span>/5
                                        </h4>
                                    @endif
                                    <div class="rating">
                                        <input type="radio" name="rating" value="5" data-id="{{ $product->id }}" data-user-id="{{ Auth::user()->id }}" id="rating-5" {{ ($product->rate == 5)? 'checked': '' }}>
                                        <label for="rating-5"></label>
                                        <input type="radio" name="rating" value="4" data-id="{{ $product->id }}" data-user-id="{{ Auth::user()->id }}" id="rating-4" {{ ($product->rate == 4)? 'checked': '' }}>
                                        <label for="rating-4"></label>
                                        <input type="radio" name="rating" value="3" data-id="{{ $product->id }}" data-user-id="{{ Auth::user()->id }}" id="rating-3" {{ ($product->rate == 3)? 'checked': '' }}>
                                        <label for="rating-3"></label>
                                        <input type="radio" name="rating" value="2" data-id="{{ $product->id }}" data-user-id="{{ Auth::user()->id }}" id="rating-2" {{ ($product->rate == 2)? 'checked': '' }}>
                                        <label for="rating-2"></label>
                                        <input type="radio" name="rating" value="1" data-id="{{ $product->id }}" data-user-id="{{ Auth::user()->id }}" id="rating-1" {{ ($product->rate == 1)? 'checked': '' }}>
                                        <label for="rating-1"></label>
                                        <div class="emoji-wrapper">
                                            <div class="emoji">
                                                <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                    <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534"/>
                                                    <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff"/>
                                                    <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347"/>
                                                    <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                                    <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff"/>
                                                    <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347"/>
                                                    <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                                    <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347"/>
                                                </svg>
                                                <svg class="rating-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                    <path d="M328.4 428a92.8 92.8 0 0 0-145-.1 6.8 6.8 0 0 1-12-5.8 86.6 86.6 0 0 1 84.5-69 86.6 86.6 0 0 1 84.7 69.8c1.3 6.9-7.7 10.6-12.2 5.1z" fill="#3e4347"/>
                                                    <path d="M269.2 222.3c5.3 62.8 52 113.9 104.8 113.9 52.3 0 90.8-51.1 85.6-113.9-2-25-10.8-47.9-23.7-66.7-4.1-6.1-12.2-8-18.5-4.2a111.8 111.8 0 0 1-60.1 16.2c-22.8 0-42.1-5.6-57.8-14.8-6.8-4-15.4-1.5-18.9 5.4-9 18.2-13.2 40.3-11.4 64.1z" fill="#f4c534"/>
                                                    <path d="M357 189.5c25.8 0 47-7.1 63.7-18.7 10 14.6 17 32.1 18.7 51.6 4 49.6-26.1 89.7-67.5 89.7-41.6 0-78.4-40.1-82.5-89.7A95 95 0 0 1 298 174c16 9.7 35.6 15.5 59 15.5z" fill="#fff"/>
                                                    <path d="M396.2 246.1a38.5 38.5 0 0 1-38.7 38.6 38.5 38.5 0 0 1-38.6-38.6 38.6 38.6 0 1 1 77.3 0z" fill="#3e4347"/>
                                                    <path d="M380.4 241.1c-3.2 3.2-9.9 1.7-14.9-3.2-4.8-4.8-6.2-11.5-3-14.7 3.3-3.4 10-2 14.9 2.9 4.9 5 6.4 11.7 3 15z" fill="#fff"/>
                                                    <path d="M242.8 222.3c-5.3 62.8-52 113.9-104.8 113.9-52.3 0-90.8-51.1-85.6-113.9 2-25 10.8-47.9 23.7-66.7 4.1-6.1 12.2-8 18.5-4.2 16.2 10.1 36.2 16.2 60.1 16.2 22.8 0 42.1-5.6 57.8-14.8 6.8-4 15.4-1.5 18.9 5.4 9 18.2 13.2 40.3 11.4 64.1z" fill="#f4c534"/>
                                                    <path d="M155 189.5c-25.8 0-47-7.1-63.7-18.7-10 14.6-17 32.1-18.7 51.6-4 49.6 26.1 89.7 67.5 89.7 41.6 0 78.4-40.1 82.5-89.7A95 95 0 0 0 214 174c-16 9.7-35.6 15.5-59 15.5z" fill="#fff"/>
                                                    <path d="M115.8 246.1a38.5 38.5 0 0 0 38.7 38.6 38.5 38.5 0 0 0 38.6-38.6 38.6 38.6 0 1 0-77.3 0z" fill="#3e4347"/>
                                                    <path d="M131.6 241.1c3.2 3.2 9.9 1.7 14.9-3.2 4.8-4.8 6.2-11.5 3-14.7-3.3-3.4-10-2-14.9 2.9-4.9 5-6.4 11.7-3 15z" fill="#fff"/>
                                                </svg>
                                                Pad
                                                <svg class="rating-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                    <path d="M336.6 403.2c-6.5 8-16 10-25.5 5.2a117.6 117.6 0 0 0-110.2 0c-9.4 4.9-19 3.3-25.6-4.6-6.5-7.7-4.7-21.1 8.4-28 45.1-24 99.5-24 144.6 0 13 7 14.8 19.7 8.3 27.4z" fill="#3e4347"/>
                                                    <path d="M276.6 244.3a79.3 79.3 0 1 1 158.8 0 79.5 79.5 0 1 1-158.8 0z" fill="#fff"/>
                                                    <circle cx="340" cy="260.4" r="36.2" fill="#3e4347"/>
                                                    <g fill="#fff">
                                                        <ellipse transform="rotate(-135 326.4 246.6)" cx="326.4" cy="246.6" rx="6.5" ry="10"/>
                                                        <path d="M231.9 244.3a79.3 79.3 0 1 0-158.8 0 79.5 79.5 0 1 0 158.8 0z"/>
                                                    </g>
                                                    <circle cx="168.5" cy="260.4" r="36.2" fill="#3e4347"/>
                                                    <ellipse transform="rotate(-135 182.1 246.7)" cx="182.1" cy="246.7" rx="10" ry="6.5" fill="#fff"/>
                                                </svg>
                                                Not pad
                                                <svg class="rating-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                    <path d="M407.7 352.8a163.9 163.9 0 0 1-303.5 0c-2.3-5.5 1.5-12 7.5-13.2a780.8 780.8 0 0 1 288.4 0c6 1.2 9.9 7.7 7.6 13.2z" fill="#3e4347"/>
                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                    <g fill="#fff">
                                                        <path d="M115.3 339c18.2 29.6 75.1 32.8 143.1 32.8 67.1 0 124.2-3.2 143.2-31.6l-1.5-.6a780.6 780.6 0 0 0-284.8-.6z"/>
                                                        <ellipse cx="356.4" cy="205.3" rx="81.1" ry="81"/>
                                                    </g>
                                                    <ellipse cx="356.4" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                                                    <g fill="#fff">
                                                        <ellipse transform="scale(-1) rotate(45 454 -906)" cx="375.3" cy="188.1" rx="12" ry="8.1"/>
                                                        <ellipse cx="155.6" cy="205.3" rx="81.1" ry="81"/>
                                                    </g>
                                                    <ellipse cx="155.6" cy="205.3" rx="44.2" ry="44.2" fill="#3e4347"/>
                                                    <ellipse transform="scale(-1) rotate(45 454 -421.3)" cx="174.5" cy="188" rx="12" ry="8.1" fill="#fff"/>
                                                </svg>
                                                Good
                                                <svg class="rating-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                                    <path d="M512 256A256 256 0 0 1 56.7 416.7a256 256 0 0 0 360-360c58.1 47 95.3 118.8 95.3 199.3z" fill="#f4c534"/>
                                                    <path d="M232.3 201.3c0 49.2-74.3 94.2-74.3 94.2s-74.4-45-74.4-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                                                    <path d="M96.1 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2C80.2 229.8 95.6 175.2 96 173.3z" fill="#d03f3f"/>
                                                    <path d="M215.2 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                                                    <path d="M428.4 201.3c0 49.2-74.4 94.2-74.4 94.2s-74.3-45-74.3-94.2a38 38 0 0 1 74.4-11.1 38 38 0 0 1 74.3 11.1z" fill="#e24b4b"/>
                                                    <path d="M292.2 173.3a37.7 37.7 0 0 0-12.4 28c0 49.2 74.3 94.2 74.3 94.2-77.8-65.7-62.4-120.3-61.9-122.2z" fill="#d03f3f"/>
                                                    <path d="M411.3 200c-3.6 3-9.8 1-13.8-4.1-4.2-5.2-4.6-11.5-1.2-14.1 3.6-2.8 9.7-.7 13.9 4.4 4 5.2 4.6 11.4 1.1 13.8z" fill="#fff"/>
                                                    <path d="M381.7 374.1c-30.2 35.9-75.3 64.4-125.7 64.4s-95.4-28.5-125.8-64.2a17.6 17.6 0 0 1 16.5-28.7 627.7 627.7 0 0 0 218.7-.1c16.2-2.7 27 16.1 16.3 28.6z" fill="#3e4347"/>
                                                    <path d="M256 438.5c25.7 0 50-7.5 71.7-19.5-9-33.7-40.7-43.3-62.6-31.7-29.7 15.8-62.8-4.7-75.6 34.3 20.3 10.4 42.8 17 66.5 17z" fill="#e24b4b"/>
                                                </svg>
                                                Very Good
                                                <svg class="rating-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <g fill="#ffd93b">
                                                        <circle cx="256" cy="256" r="256"/>
                                                        <path d="M512 256A256 256 0 0 1 56.8 416.7a256 256 0 0 0 360-360c58 47 95.2 118.8 95.2 199.3z"/>
                                                    </g>
                                                    <path d="M512 99.4v165.1c0 11-8.9 19.9-19.7 19.9h-187c-13 0-23.5-10.5-23.5-23.5v-21.3c0-12.9-8.9-24.8-21.6-26.7-16.2-2.5-30 10-30 25.5V261c0 13-10.5 23.5-23.5 23.5h-187A19.7 19.7 0 0 1 0 264.7V99.4c0-10.9 8.8-19.7 19.7-19.7h472.6c10.8 0 19.7 8.7 19.7 19.7z" fill="#e9eff4"/>
                                                    <path d="M204.6 138v88.2a23 23 0 0 1-23 23H58.2a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#45cbea"/>
                                                    <path d="M476.9 138v88.2a23 23 0 0 1-23 23H330.3a23 23 0 0 1-23-23v-88.3a23 23 0 0 1 23-23h123.4a23 23 0 0 1 23 23z" fill="#e84d88"/>
                                                    <g fill="#38c0dc">
                                                        <path d="M95.2 114.9l-60 60v15.2l75.2-75.2zM123.3 114.9L35.1 203v23.2c0 1.8.3 3.7.7 5.4l116.8-116.7h-29.3z"/>
                                                    </g>
                                                    <g fill="#d23f77">
                                                        <path d="M373.3 114.9l-66 66V196l81.3-81.2zM401.5 114.9l-94.1 94v17.3c0 3.5.8 6.8 2.2 9.8l121.1-121.1h-29.2z"/>
                                                    </g>
                                                    <path d="M329.5 395.2c0 44.7-33 81-73.4 81-40.7 0-73.5-36.3-73.5-81s32.8-81 73.5-81c40.5 0 73.4 36.3 73.4 81z" fill="#3e4347"/>
                                                    <path d="M256 476.2a70 70 0 0 0 53.3-25.5 34.6 34.6 0 0 0-58-25 34.4 34.4 0 0 0-47.8 26 69.9 69.9 0 0 0 52.6 24.5z" fill="#e24b4b"/>
                                                    <path d="M290.3 434.8c-1 3.4-5.8 5.2-11 3.9s-8.4-5.1-7.4-8.7c.8-3.3 5.7-5 10.7-3.8 5.1 1.4 8.5 5.3 7.7 8.6z" fill="#fff" opacity=".2"/>
                                                </svg>
                                                Excellent
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating-info">
                                        <a href="#" class="rate-info-btn">View rating details</a>
                                        <div class="rate-bars">
                                            <div class="bar-box">
                                                <label><i class="fa fa-star"></i> 1 :</label>
                                                <div class="progress-bar" id="progress-bar1">
                                                    <div class="progress1" style="width:1%; background-position:1%;"></div>
                                                    <input id="setVal1" type="number" name="rating_bar" value=""  pattern="\d*"/>
                                                </div>
                                            </div>
                                            <div class="bar-box">
                                                <label><i class="fa fa-star"></i> 2 :</label>
                                                <div class="progress-bar" id="progress-bar2">
                                                    <div class="progress2" style="width:1%; background-position:1%;"></div>
                                                    <input id="setVal2" type="number" name="rating_bar" value=""  pattern="\d*"/>
                                                </div>
                                            </div>
                                            <div class="bar-box">
                                                <label><i class="fa fa-star"></i> 3 :</label>
                                                <div class="progress-bar" id="progress-bar3">
                                                    <div class="progress3" style="width:1%; background-position:1%;"></div>
                                                    <input id="setVal3" type="number" name="rating_bar" value=""  pattern="\d*"/>
                                                </div>
                                            </div>
                                            <div class="bar-box">
                                                <label><i class="fa fa-star"></i> 4 :</label>
                                                <div class="progress-bar" id="progress-bar4">
                                                    <div class="progress4" style="width:1%; background-position:1%;"></div>
                                                    <input id="setVal4" type="number" name="rating_bar" value=""  pattern="\d*"/>
                                                </div>
                                            </div>
                                            <div class="bar-box">
                                                <label><i class="fa fa-star"></i> 5 :</label>
                                                <div class="progress-bar" id="progress-bar5">
                                                    <div class="progress5" style="width:1%; background-position:1%;"></div>
                                                    <input id="setVal5" type="number" name="rating_bar" value=""  pattern="\d*"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info">
                        <p>{{ $product->desc }}</p>
                        <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid culpa cum dolores dolorum, earum eligendi expedita facere, fugiat impedit laborum laudantium magnam modi neque numquam omnis quasi saepe totam voluptatem.</span><span>Accusamus animi dolor doloremque dolores doloribus earum eligendi eum, eveniet molestiae molestias nihil nostrum, quia quod rerum sapiente vitae voluptas. Dolor dolores enim, et eum iure non officia reprehenderit sint.</span><span>Architecto asperiores, blanditiis corporis distinctio ex hic laborum magni modi obcaecati odit praesentium quae quaerat quas qui quia reprehenderit rerum sequi, sit soluta suscipit? Debitis dolorem ducimus sequi. Aspernatur, necessitatibus.</span><span>Aliquid amet aperiam dolor minus officia rerum sunt. Facilis libero modi nemo nulla optio possimus repudiandae sapiente sit tenetur ullam. Ad dolor eius eligendi ex, fugit nisi quo repellendus vel.</span><span>Aliquam assumenda atque eum id iure magnam nulla officia quae quas voluptates? Aliquam aliquid, dicta distinctio dolore dolorem doloribus, eius eos harum id ipsum laudantium molestias, optio placeat quia voluptas?</span><span>Autem dolore earum id iusto nam, nostrum voluptate voluptatum. Alias aliquam, architecto aspernatur commodi consequatur eaque illo in, incidunt ipsum itaque iusto labore laborum nam nisi officiis placeat repudiandae vero.</span><span>Ad aut autem consectetur consequatur consequuntur culpa deleniti dicta explicabo fuga incidunt ipsa labore magni modi necessitatibus numquam officiis, pariatur quae, quaerat quas quibusdam quos rem similique sint tempora veniam.</span><span>A adipisci autem cupiditate debitis dicta ducimus eaque earum eum itaque iure iusto maiores modi nisi non numquam officia, quas quo quod ratione similique sit sunt tempora, ullam, veniam voluptatem.</span><span>Cumque earum exercitationem maiores non odit quasi quis saepe sunt, ullam veritatis! Deleniti eius harum perferendis! Asperiores commodi culpa esse illo ipsum magni mollitia pariatur, tempore! Facere ratione sit sunt!</span><span>Adipisci aperiam asperiores atque autem, culpa dicta dolores eligendi excepturi id in, iste laudantium molestiae nam nesciunt nisi obcaecati possimus quam quasi quia quidem quod recusandae, sequi sunt totam ullam?</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-12 col-md-12 mt-4">
                        <form class="addProduct-ToCart" action="{{ route('addProductToCart') }}" method="POST">
                            <input type="hidden" name="productName" value="{{ $product->name }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="price" value="{{ $product->pay_price }}">
                            <input type="hidden" name="desc" value="{{ $product->desc }}">
                            <input type="hidden" name="image" value="{{ $product->image }}">
                            <input type="hidden" name="discount" value="{{ $product->discount }}">
                            <input type="hidden" name="priceInDisc" value="{{ $product->priceInDisc }}">
                            <input type="hidden" name="count" value="1">
                            <button class="btn btn-warning btn-block">
                                <i class="fa fa-cart-plus"></i>
                                <span>Add To Cart</span>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog mt-5" role="document">
                        <div class="modal-content">
                            <i class="fa fa-close" data-dismiss="modal"></i>
                            <div class="modal-body">
                                <img src="{{ asset('images/'.$product->image) }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="empty" style="width: 100%">
                    <div class="image">
                        <img src="{{ asset('site/images/sad.png') }}" alt="">
                    </div>
                    <div class="text">
                        <p>
                            هذا المنتج غير موجود
                        </p>
                        <div class="text-img">
                            <img src="{{ asset('site/images/box.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
@section('script')
    <script>
        // To Rate This Product
        $(document).on('change', 'input[name=rating]', function () {
            var value = $(this).val(),
                dataId = $(this).attr('data-id');
           $.ajax({
               url: "{{ route('rating') }}",
               type: "POST",
               data: {"value": value, "dataId": dataId},
               headers: {
                   'X-CSRF-Token': "{{ csrf_token() }}"
               },
               success: function (data) {
                   $('.rate-num').text(value);
               }
           });

            $.ajax({
                url: "{{ route('vote') }}",
                type: "POST",
                data: {"value": value, "dataId": dataId},
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                success: function (data) {
                }
            });
            return false;
        });

        // To view vote
        $(document).ready(function () {
            var dataId = $('input[name="rating"]').attr('data-id');
            $('#setVal5').val(90);
            $.ajax({
                url: "{{ route('viewVote') }}",
                type: "GET",
                data: {"dataId": dataId},
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.one > 0){
                        var progress = '<div class="progress1" style="width:'+response.one+'%; background-position:'+response.one+'%;"></div><input id="setVal5" type="number" name="rating_bar" value="'+response.one+'"  pattern="\\d*"/>';
                        $('#progress-bar1').html('').append(progress);
                    }
                    if (response.two > 0) {
                        var progress = '<div class="progress2" style="width:'+response.two+'%; background-position:'+response.two+'%;"></div><input id="setVal5" type="number" name="rating_bar" value="'+response.two+'"  pattern="\\d*"/>';
                        $('#progress-bar2').html('').append(progress);
                    }
                    if (response.three > 0){
                        var progress = '<div class="progress3" style="width:'+response.three+'%; background-position:'+response.three+'%;"></div><input id="setVal5" type="number" name="rating_bar" value="'+response.three+'"  pattern="\\d*"/>';
                        $('#progress-bar3').html('').append(progress);
                    }
                    if (response.four > 0){
                        var progress = '<div class="progress4" style="width:'+response.four+'%; background-position:'+response.four+'%;"></div><input id="setVal5" type="number" name="rating_bar" value="'+response.four+'"  pattern="\\d*"/>';
                        $('#progress-bar4').html('').append(progress);
                    }
                    if (response.five > 0){
                        var progress = '<div class="progress5" style="width:'+response.five+'%; background-position:'+response.five+'%;"></div><input id="setVal5" type="number" name="rating_bar" value="'+response.five+'"  pattern="\\d*"/>';
                        $('#progress-bar5').html('').append(progress);
                    }
                }
            });
        });

        // To Insert Product To Cart
        $(document).on('submit', '.addProduct-ToCart', function (e) {
            e.preventDefault();
            var product_id  = $(this).find('input[name=product_id]').val(),
                count       = $(this).find('input[name=count]').val(),
                userId      = $(this).find('input[name=userId]').val(),
                productName = $(this).find('input[name=productName]').val(),
                price       = $(this).find('input[name=price]').val(),
                desc        = $(this).find('input[name=desc]').val(),
                image       = $(this).find('input[name=image]').val(),
                discount    = $(this).find('input[name=discount]').val(),
                priceInDisc = $(this).find('input[name=priceInDisc]').val(),
                url         = $(this).attr('action'),
                type        = $(this).attr('method');
            <?php $pId = '"product_id"' ?>
            $.ajax({
                url: url,
                type: type,
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                data: {
                    "product_id": product_id,
                    "userId": userId,
                    "count": count,
                    "productName":productName,
                    "price": price,
                    "desc": desc,
                    "image": image,
                    "discount": discount,
                    "priceInDisc": priceInDisc,
                },
                success: function (data) {
                    if (data==0){
                        var cartCount = parseInt($('.cart .badge').text(), 10) +1;
                        $('.cart .badge').text(cartCount);
                        $('.nav-cart .badge').text(cartCount);
                        $('.addProduct-ToCart button').addClass('btn-default').removeClass('btn-warning');
                        $('.addProduct-ToCart button span').text('Plus Another One');
                    }
                    iziToast.success({
                        title: 'تم',
                        timeout: 2000,
                        message: 'تم اضافة المنتج بنجاح',
                        onClosed: function () {
                            // location.reload();
                        }
                    });
                }
            })
        });

        $(document).ready(function () {
            var dataId = $('input[name=rating]').attr('data-id');
            $.ajax({
                url: "{{ route('viewProductInCart') }}",
                type: "GET",
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                data: {"dataId": dataId},
                success:function (data) {
                    if (data){
                        data.forEach(function (ele) {
                            if (ele.product_id === dataId){
                                console.log(ele.product_id);
                                $('.addProduct-ToCart button').addClass('btn-default').removeClass('btn-warning');
                                $('.addProduct-ToCart button span').text('Plus Another One')
                            }
                        });
                    }
                }
            })
        });
    </script>
@endsection

