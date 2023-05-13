$(document).ready(function () {
  $("form").submit(function (event) {
    var formData = {
      query: $("#ip").val(),
    };
	var url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/iplocate/address?ip=";
	var token = "a0334f2b906868d9a15c7318d7d03906c4aab011";

    $.ajax({
      type: "GET",
      url: url + formData.query,
	  beforeSend: function(xhr) {
                 xhr.setRequestHeader("Authorization", "Token "+ token) 
            },
      data: '',
      dataType: "json",
      encode: true,
    }).done(function (result) {
        let reshtml = `<pre>Страна: ${result.location.data.country}\r`;
        reshtml += `Регион: ${result.location.data.federal_district}\r`;
        reshtml += `Город: ${result.location.data.city}</pre>`;
        $('#result').html(reshtml);
        console.log(result);
	});

    event.preventDefault();
  });
});