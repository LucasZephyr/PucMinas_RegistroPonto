    //####################### API mapbox #######################

    //Minha chave de acesso
    mapboxgl.accessToken = 'pk.eyJ1IjoibHVjYXNjYXJtb3NlZHVjIiwiYSI6ImNsZjc4em4wZDF0dXUzc2s3NWFzdGxmNDQifQ.xS4_VN4m8zneH1KbItrkNA';

    //pego as coordenadas aqui
    navigator.geolocation.getCurrentPosition(function(position) {
        
        var latitude   = position.coords.latitude;
        var longitude  = position.coords.longitude;

        console.log('Latitude: ' + latitude + '\n' + 'Longitude: ' + longitude);

        //Codigo da API para mostrar o MAPA
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [longitude, latitude],
            zoom: 15
        });
        
    // Adicionando um marcador para a posição do usuário
    new mapboxgl.Marker()
        .setLngLat([longitude, latitude])
        .addTo(map)
        .setPopup(new mapboxgl.Popup().setHTML('<h3>Sua Localização</h3>'));



  fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${longitude},${latitude}.json?access_token=${mapboxgl.accessToken}`)
    .then(response => response.json())
    .then(data => {
        const enderecoCompleto = data.features[0].place_name;
        
        console.log('Endereco: ' + enderecoCompleto);
        $("#endereco").html(enderecoCompleto);


    })

});


function obterLocalizacao() {

  Swal.fire({
    title: 'Aguarde...',
    html: '<div class="spinner-border" style="overflow:none" role="status"></div>',
    showConfirmButton: false, //remove o botao fechar 
    allowOutsideClick: false, //impede que o usuario feche o alert clicando fora dele
    allowEscapeKey: false  //impede que o usuario feche o alert pressionando Esc
  });

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(enviarLocalizacao, erroLocalizacao);
  } else {
    console.log("Geolocalizacao nao e suportada neste navegador.");
  }
}

function enviarLocalizacao(position) {

  const latitude = position.coords.latitude;
  const longitude = position.coords.longitude;

  // Criar objeto com os dados de localização
  let dados = {
    'latitude': latitude,
    'longitude': longitude
  };

  $.ajax({
    url: "ajax/registrarPonto.php",
    data: dados,
    type: "POST",
    dataType: "json",
    success: function(resp) {
      Swal.close();

        if(resp.informacao == "SUCESSO"){
          Swal.fire({
            title: 'SUCESSO',
            text: 'Registro Inserido!',
            icon: 'success'
          });

        }else{

          Swal.fire({
            title: resp.informacao,
            text: resp.text,
            icon: 'error'
          });

        }

    },
    error: function() {
      Swal.close();
      Swal.fire({
        icon: 'error',
        title: 'Erro',
        text: 'Erro ao tentar registrar ponto!',
        showConfirmButton: true
      });
    }
  });
}

function erroLocalizacao(error) {
  console.log("Erro ao obter a localização: " + error.message);

  Swal.close();
  Swal.fire({
    title: error.message,
    icon: 'question',
    text: 'Erro ao obter a localização'
  });
}




















