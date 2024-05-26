var Constants = {
   get_api_base_url: function() {
      if (location.hostname =='localhost'){
         return "http://localhost/WebProgramming/backend/";
      }else{
         return "https://oyster-app-ppfen.ondigitalocean.app/backend/";
      }
   }
   //"API_BASE_URL" : "http://localhost/WebProgramming/backend/",
};
