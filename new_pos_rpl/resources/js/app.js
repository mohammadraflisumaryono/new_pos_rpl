import "./bootstrap";
import "../scss/app.scss";
import $ from "jquery";

// Contoh penggunaan jQuery
$(document).ready(function () {
    console.log("jQuery is ready!");
});

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
import * as bootstrap from "bootstrap";
