import { router } from '@inertiajs/vue3';

const active = (item) => {
    return item.route.current
        ? route().current(item.route.current)
        : route().current(item.route.name);
};

const expand = (items) => {
    const keys = {};

    for (let node of items.value) {
        if (node.items && node.items.length) {
            keys[node.key] = true;

            for (let child of node.items) {
                if (child.items && child.items.length) {
                    keys[child.key] = true;
                }
            }
        }
    }

    return {...keys};
};

const handle = (item, menu, close) => {
    const method = item.route.method || 'get';
    const params = item.route.params || null;
    const url = typeof item.route.url !== 'undefined'
        ? item.route.url
        : route(item.route.name);
    router.get(url);
    if (close) {
        menu.toggle(false);
    }
};

const make = (menu) => {
    const items = [];
    Object.values(menu.items, items)
        .forEach((item) => {
            if (item.items) {
                item.items = make(item);
            }
            if (item.route) {
                if (typeof item.route === 'string') {
                    item.route = { name: item.route, url: route(item.route) };
                } else if (typeof item.route.url === 'undefined') {
                    item.route.url = route(item.route.name);
                }
            }
            items.push(item);
        });
    return items;
};

export function useMenus() {
    return {
        active,
        expand,
        handle,
        make,
    };
};
