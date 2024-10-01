import axios from "axios";
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import $ from "jquery";
window.$ = $;

import "bootstrap-icons/font/bootstrap-icons.css"
import dataTable from 'datatables.net-bs5';

import 'datatables.net-buttons';
import 'datatables.net-buttons-bs5';

