import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel/dist/assets/owl.theme.default.css';
import "@fancyapps/ui/dist/fancybox.css";

import 'owl.carousel';
import { Fancybox } from "@fancyapps/ui";

$(function () {
    $(".owl-carousel").owlCarousel({
        items: 1,
        margin: 10,
        autoHeight: true,
        // nav: true,
    });
})
