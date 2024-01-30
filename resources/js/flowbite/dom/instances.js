class Instances {
    constructor() {
        this._instances = {
            Popover: {},
            Tooltip: {},
        };
    }

    addInstance(
        component,
        instance,
        id,
        override = false
    ) {
        if (!this._instances[component]) {
            console.warn(`Flowbite: Component ${component} does not exist.`);
            return false;
        }

        if (this._instances[component][id] && !override) {
            console.warn(`Flowbite: Instance with ID ${id} already exists.`);
            return;
        }

        if (override && this._instances[component][id]) {
            this._instances[component][id].destroyAndRemoveInstance();
        }

        this._instances[component][id ? id : this._generateRandomId()] =
            instance;
    }

    getAllInstances() {
        return this._instances;
    }

    getInstances(component) {
        if (!this._instances[component]) {
            console.warn(`Flowbite: Component ${component} does not exist.`);
            return false;
        }
        return this._instances[component];
    }

    getInstance(component, id) {
        if (!this._componentAndInstanceCheck(component, id)) {
            return;
        }

        if (!this._instances[component][id]) {
            console.warn(`Flowbite: Instance with ID ${id} does not exist.`);
            return;
        }
        return this._instances[component][id];
    }

    destroyAndRemoveInstance(
        component,
        id
    ) {
        if (!this._componentAndInstanceCheck(component, id)) {
            return;
        }
        this.destroyInstanceObject(component, id);
        this.removeInstance(component, id);
    }

    removeInstance(component, id) {
        if (!this._componentAndInstanceCheck(component, id)) {
            return;
        }
        delete this._instances[component][id];
    }

    destroyInstanceObject(
        component,
        id
    ) {
        if (!this._componentAndInstanceCheck(component, id)) {
            return;
        }
        this._instances[component][id].destroy();
    }

    instanceExists(component, id) {
        if (!this._instances[component]) {
            return false;
        }

        return this._instances[component][id];
    }

    _generateRandomId() {
        return Math.random().toString(36).substr(2, 9);
    }

    _componentAndInstanceCheck(
        component,
        id
    ) {
        if (!this._instances[component]) {
            console.warn(`Flowbite: Component ${component} does not exist.`);
            return false;
        }

        if (!this._instances[component][id]) {
            console.warn(`Flowbite: Instance with ID ${id} does not exist.`);
            return false;
        }

        return true;
    }
}

const instances = new Instances();

export default instances;

if (typeof window !== 'undefined') {
    window.FlowbiteInstances = instances;
}
