import { initPopovers } from './popover';
import { initTooltips } from './tooltip';

export function initFlowbite() {
    initTooltips();
    initPopovers();
}

if (typeof window !== 'undefined') {
    window.initFlowbite = initFlowbite;
}
