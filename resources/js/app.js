require('./bootstrap');

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import '@nextapps-be/livewire-sortablejs';
import "@fontsource/inter";
import "../../vendor/lowerrocklabs/laravel-livewire-tables-advanced-filters/resources/css/numberRange.min.css";
import '../../node_modules/flag-icons/css/flag-icons.min.css';

import SlimSelect from "slim-select";
window.SlimSelect = SlimSelect;


window.Alpine = Alpine;
window.Alpine.plugin(focus);
window.Alpine.start();
