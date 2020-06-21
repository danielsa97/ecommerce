import routes from './routes';

const normalizePath = (route, path) => {
    let newPath;
    if (route.path && route.path.trim().substr(0, 1) === '/') {
        route.path = route.path.trim().substr(1, route.path.length - 1);
    }
    if (path.trim().substr(path.trim().length - 1, 1) === '/') {
        newPath = path + (route.path ? route.path : '');
    } else {
        newPath = path + (route.path ? '/' + route.path : '');
    }
    return newPath;
};
export default {
    toRouter: () => {
        let list = [];
        let tmpRoutes = routes;
        const getUrl = function (routes, path = '/') {
            routes.forEach(route => {
                route = Object.assign({}, route);
                delete route.menu;
                let newPath = normalizePath(route, path);
                if (route.hasOwnProperty('children')) {
                    getUrl(route.children, newPath);
                    delete route.children;
                }
                if (route.component) {
                    route.path = newPath;
                    list.push(route);
                }
            });
        };
        getUrl(tmpRoutes);
        return list;
    },
    toMenu: () => {
        let tmpRoutes = routes;
        const getUrl = function (routes, path = '/') {
            return routes.map(route => {
                route = Object.assign({}, route);
                let newPath = normalizePath(route, path);
                if (route.hasOwnProperty('children')) {
                    route.children = getUrl(route.children, newPath);
                }
                if (route.component) {
                    route.path = newPath;
                }
                return route;
            });
        };
        return getUrl(tmpRoutes);
    }
}
