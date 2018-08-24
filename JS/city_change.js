$("#city_change").submit(function(){
   $.ajax({
      type: "GET",
      url: "PHP/city_set.php",
      data: $(this).serialize(),
   });
});

$.ajax({
  url: "post.php",
  data: {id: 123
    },

    // Whether this is a POST or GET request
    type: "GET",

    // The type of data we expect back
    dataType : "json",
})
})
