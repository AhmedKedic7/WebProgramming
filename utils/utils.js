const Utils = {
    
  init_spapp: function () {
    var app = $.spapp({
      defaultView  : "#home",
      templateDir: "./pages/"
    });
    app.run();
  },
  logout : function(){
    localStorage.clear();
    location.reload();
   
  },
    set_to_localstorage: function(key, value) {
      window.localStorage.setItem(key, JSON.stringify(value));
    },
    get_from_localstorage: function(key) {
      return window.localStorage.getItem(key);
    }
  };