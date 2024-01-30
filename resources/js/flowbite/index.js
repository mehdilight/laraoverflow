import Events from './dom/events';
import { initTooltips } from './components/tooltip';
import { initPopovers } from './components/popover';
import './components/index';

// setup events for data attributes
const events = new Events('load', [
    initTooltips,
    initPopovers,
]);

events.init();

// export all components
export { default as Popover } from './components/popover';
export { default as Tooltip } from './components/tooltip';

// export init functions
export { initPopovers } from './components/popover';
export { initTooltips } from './components/tooltip';

// export all init functions
export { initFlowbite } from './components/index';
