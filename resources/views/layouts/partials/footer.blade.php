    <!-- footer -->
    <div class="bg-dark">
        <div class="container py-4 small">
            <div class="row">
                <!-- contacto -->
                <div class="col-md-3 mb-3">
                    <p class="h6 fw-bold text-white">Contacto</p>
                    <ul class="list-unstyled light text-light">
                        <li> Av. H. Yrigoyen 15750 (1852) <br>
                            Burzaco, Buenos Aires, Argentina</li>
                        <li class="pt-3 pb-2 fw-bold h5 text-white"> (5411) 4002-4400 | <br>
                            4238-4000</li>
                    </ul>
                    <p class="h6 fw-bold text-white">Horarios</p>
                    <span class="text-light light"> lun a vier 9 a 12 y de 14 a 17:30</span>
                </div>
                <!-- categorias -->
                <div class="col-md-3 mb-3">
                    <p class="h6 fw-bold text-white">Categorías de productos</p>
                    <ul class="list-unstyled text-white-50 light">
                        <li><a href="{{ route('home') }}" class="text-decoration-none link-light"
                                title="Saber más sobre la Empresa"> Empresa
                            </a></li>
                        <li><a href="{{ route('home') }}" class="text-decoration-none link-light"
                                title="Todos los servicios">
                                Servicios
                            </a></li>
                        <li><a href="{{ route('home') }}" class="text-decoration-none link-light"
                                title="Todos nuestros productos">
                                Productos </a></li>
                        <li><a href="/" class="text-decoration-none link-light" title="Solicitá tu presupuesto">
                                Presupuestos </a></li>
                        <li><a href="{{ route('home') }}" class="text-decoration-none link-light"
                                title="Todas la últimas novedades">
                                Novedades </a></li>
                        <li><a href="{{ route('contacto') }}" class="text-decoration-none link-light"
                                title="Nuestros contactos">
                                Contacto </a>
                        </li>
                    </ul>
                </div>
                <!-- data fiscal -->
                <div class="col-md-3 mb-3">
                    <p class="h6 fw-bold text-white">Data fiscal</p>
                    <img src="{{ asset('img/datafiscal-qr.png') }}" title="Imagen de data fiscal de la empresa">
                </div>
                <!-- redes -->
                <div class="col-md-3">
                    <p class="h6 fw-bold text-white">Nuestras redes</p>
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item bg-transparent ps-0 border-0 light text-light">
                            <a href="/" class="text-decoration-none link-light"
                                title="Mirá nuestro canal de youtube"> <i class="fa-brands fa-youtube"></i> </a>
                        </li>
                        <li class="list-group-item bg-transparent ps-0 border-0 light text-light">
                            <a href="/" class="text-decoration-none link-light" title="Nuestro Instagram"> <i
                                    class="fa-brands fa-instagram"></i> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN footer -->


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Leaflet CSS y JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js" crossorigin=""></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" charset="utf-8">
        // tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // menú dropdown hover
        const $dropdown = $(".dropdown");
        const $dropdownToggle = $(".dropdown-toggle");
        const $dropdownMenu = $(".dropdown-menu");
        const showClass = "show";

        $(window).on("load resize", function() {
            if (this.matchMedia("(min-width: 768px)").matches) {
                $dropdown.hover(
                    function() {
                        const $this = $(this);
                        $this.addClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "true");
                        $this.find($dropdownMenu).addClass(showClass);
                    },
                    function() {
                        const $this = $(this);
                        $this.removeClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "false");
                        $this.find($dropdownMenu).removeClass(showClass);
                    }
                );
            } else {
                $dropdown.off("mouseenter mouseleave");
            }
        });

        // search animado
        const searchBtn = document.querySelector('#searchBtn');
        const animatedInput = document.querySelector('#animated-input');

        searchBtn.addEventListener('click', openSearch);

        function openSearch(e) {
            animatedInput.focus();
        }
        // Check if there is text in input every 50ms
        setInterval(function() {
            if (animatedInput.value) {
                animatedInput.style.width = '225px';
            }
        }, 50);
    </script>
