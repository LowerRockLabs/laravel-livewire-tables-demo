import './bootstrap';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Clipboard from '@ryangjchandler/alpine-clipboard'
//import flatpickr from "flatpickr";
//import '../../node_modules/flatpickr/dist/flatpickr.min.css'
//window.flatpickr = flatpickr;

///import '../../vendor/rappasoft/laravel-livewire-tables/resources/imports/laravel-livewire-tables.js';

//import '../../vendor/rappasoft/laravel-livewire-tables-v3/resources/js/test'
Alpine.plugin(Clipboard)
Livewire.start()
