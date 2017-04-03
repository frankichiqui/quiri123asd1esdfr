function loadRoutingLocale(locale) {
  var routes = Routing.getRoutes();
  for (var i = 0; i < routes.a.length; i++) {
    routes.c[routes.a[i]].defaults._locale = locale;
  }
  Routing.setRoutes(routes);
}

