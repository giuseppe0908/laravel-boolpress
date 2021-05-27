require('./bootstrap');
let app = new Vue({
  el: '#root',
  data: {
    id: null,
  },

  methods:{

    delete_comic: function(id){
      console.log(id);
      this.id= id;
    },
    no_elimina: function(){
        this.id= null;
    },
  }
});
