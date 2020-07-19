const buildedRoutes = require('./routes.json');

const JsRoutes = (function () {
    let routes = {
        ...buildedRoutes,
        route: function (name, parameters) {
            let route = this.getByName(name);

            if (!route) {
                return undefined;
            }
            return this.toRoute(route, parameters);
        },

        toRoute: function (route, parameters) {
            let uri = this.replaceNamedParameters(route.uri, parameters);
            let qs = this.getRouteQueryString(parameters);
            if (this.absolute && this.isOtherHost(route)) {
                return "//" + route.host + "/" + uri + qs;
            }

            return this.getCorrectUrl(uri + qs);
        },

        isOtherHost: function (route) {
            return route.host && route.host != window.location.hostname;
        },

        replaceNamedParameters: function (uri, parameters) {
            uri = uri.replace(/\{(.*?)\??\}/g, function (match, key) {
                if (parameters.hasOwnProperty(key)) {
                    let value = parameters[key];
                    delete parameters[key];
                    return value;
                } else {
                    return match;
                }
            });

            // Strip out any optional parameters that were not given
            uri = uri.replace(/\/\{.*?\?\}/g, '');

            return uri;
        },

        getRouteQueryString: function (parameters) {
            let qs = [];
            for (let key in parameters) {
                if (parameters.hasOwnProperty(key)) {
                    qs.push(key + '=' + parameters[key]);
                }
            }

            if (qs.length < 1) {
                return '';
            }

            return '?' + qs.join('&');
        },

        getByName: function (name) {
            for (let key in this.routes) {
                if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                    return this.routes[key];
                }
            }
        },

        getCorrectUrl: function (uri) {
            let url = this.prefix + '/' + uri.replace(/^\/?/, '');

            if (!this.absolute) {
                return url;
            }

            return this.rootUrl.replace('/\/?$/', '') + url;
        }
    };

    return {
        route: function (route, parameters) {
            parameters = parameters || {};
            return routes.route(route, parameters);
        }
    };

}).call(this);

window.route = JsRoutes.route;

