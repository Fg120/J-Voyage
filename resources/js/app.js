import './bootstrap';

import Alpine from 'alpinejs';
import 'preline/preline';
import Toastify from 'toastify-js';
import { createIcons, icons } from 'lucide';
import ApexCharts from 'apexcharts';

window.Alpine = Alpine;
window.Toastify = Toastify;
window.ApexCharts = ApexCharts;

Alpine.start();

// Auto-reinitialize Preline components on Alpine updates
document.addEventListener('DOMContentLoaded', () => {
    if (window.HSStaticMethods) {
        window.HSStaticMethods.autoInit();
    }
    
    // Initialize Lucide icons
    createIcons({ icons });
});
