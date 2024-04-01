$(document).ready(function() {
  console.log("Hello from main index file!")

  $("main#spapp > section").height($(document).height() - 60);


  var app = $.spapp({
    defaultView  : "#home",
    templateDir  : "./pages/"
    
  });
  
  app.route({
    view : "home",
    load : "home.html",
    onCreate: function() {  },
    onReady: function() {  }
  });

  app.route({
    view : "clubs",
    load : "clubs.html",
    onCreate: function() {  },
    onReady: function() {  }
  });

  app.route({
    view : "fixtures",
    load : "fixtures.html",
    onCreate: function() {  },
    onReady: function() {  }
  });

  app.route({
    view : "players",
    load : "players.html",
    onCreate: function() {  },
    onReady: function() {  }
  });

  app.route({
    view : "results",
    load : "results.html",
    onCreate: function() {  },
    onReady: function() {  }
  });

  app.route({
    view : "about",
    load : "about.html",
    onCreate: function() {  },
    onReady: function() {  }
  });

  app.route({
    view : "login",
    load : "login.html",
    onCreate: function() {  },
    onReady: function() {  }
  });

  app.route({
    view : "admin",
    load : "admin.html",
    onCreate: function() {  },
    onReady: function() {  }
  });

  app.route({
    view : "register",
    load : "register.html",
    onCreate: function() {  },
    onReady: function() {  }
  });

  app.route({
    view : "login",
    load : "login.html",
    onCreate: function() {  },
    onReady: function() {  }
  });
  app.route({
    view : "adteams",
    load : "adteams.html",
    onCreate: function() {  },
    onReady: function() {  }
  });
  app.route({
    view : "adeditplayer",
    load : "adeditplayer.html",
    onCreate: function() {  },
    onReady: function() {  }
  });
  

  app.run();
});