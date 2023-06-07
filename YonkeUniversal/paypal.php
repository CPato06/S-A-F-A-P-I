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
    <script data-sdk-integration-source="integrationbuilder_sc"></script>
    <div id="paypal-button-container"></div>
    <script
    src="https://www.paypal.com/sdk/js?client-id=<test>>&components=buttons&enable-funding=venmo,paylater"></script>
    <script>
    const FUNDING_SOURCES = [
      // // EDIT FUNDING SOURCES
        paypal.FUNDING.PAYPAL,
        paypal.FUNDING.PAYLATER,
        paypal.FUNDING.VENMO,
        paypal.FUNDING.CARD
    ];
    FUNDING_SOURCES.forEach(fundingSource => {
      paypal.Buttons({
        fundingSource,

        style: {
          layout: 'vertical',
          shape: 'rect',
          color: (fundingSource == paypal.FUNDING.PAYLATER) ? 'gold' : '',
        },

        createOrder: async (data, actions) => {
          try {
            const response = await fetch("http://localhost:9597/orders", {
              method: "POST"
            });

            const details = await response.json();
            return details.id;
          } catch (error) {
            console.error(error);
            // Handle the error or display an appropriate error message to the user
          }
        },

        

        onApprove: async (data, actions) => {
          try {
            const response = await fetch(`http://localhost:9597/orders/${data.orderID}/capture`, {
              method: "POST"
            });

            const details = await response.json();
            // Three cases to handle:
            //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
            //   (2) Other non-recoverable errors -> Show a failure message
            //   (3) Successful transaction -> Show confirmation or thank you message

            // This example reads a v2/checkout/orders capture response, propagated from the server
            // You could use a different API or structure for your 'orderData'
            const errorDetail = Array.isArray(details.details) && details.details[0];

            if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
              return actions.restart();
              // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
            }

            if (errorDetail) {
              let msg = 'Sorry, your transaction could not be processed.';
              msg += errorDetail.description ? ' ' + errorDetail.description : '';
              msg += details.debug_id ? ' (' + details.debug_id + ')' : '';
              alert(msg);
            }

            // Successful capture! For demo purposes:
            console.log('Capture result', details, JSON.stringify(details, null, 2));
            const transaction = details.purchase_units[0].payments.captures[0];
            alert('Transaction ' + transaction.status + ': ' + transaction.id + 'See console for all available details');
          } catch (error) {
            console.error(error);
            // Handle the error or display an appropriate error message to the user
          }
        },
      }).render("#paypal-button-container");
    })
  </script>
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
<script src="https://www.paypal.com/sdk/js?client-id=AWyby8nug-_ooLok9VV73na-OSoPuayMUU5OXba-tOU0CHPXY-2_NyJvEgsiUNGIwTa8AwENJ-YvfWTs&cureency=MXN&components=buttons"></script>
</html>