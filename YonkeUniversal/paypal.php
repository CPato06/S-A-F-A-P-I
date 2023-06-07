<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba paypal</title>

    <script src="https://www.paypal.com/sdk/js?client-id=AWyby8nug-_ooLok9VV73na-OSoPuayMUU5OXba-tOU0CHPXY-2_NyJvEgsiUNGIwTa8AwENJ-YvfWTs&currency=MXN"></script>
</head>
<body>
    
  <div id="paypal-button-container"></div>

  <script>
    paypal.Buttons({
        style:{
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function(data, action){
            return actions.order.create({
               purchase_units: [{
                amounty: {
                    value: 100
                }
               }] 
            });
        },

        onApprove: function(data, actions){
            actions.order.capture().then(function (detalles){
                console.log(detalles);
            });
        },

        onCancel: function(data){
            alert("Pago cancelado");
            console.log(data);
        }
    }).render('#paypal-button-container')
  </script>

</body>
</html>