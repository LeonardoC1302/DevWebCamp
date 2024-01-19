<main class="register">
    <h2 class="register__heading"><?php echo $title; ?></h2>
    <p class="register__description">Choose Your Plan</p>

    <div class="packages__grid">
        <div class="package">
            <h3 class="package__name">Free Pass</h3>
            <ul class="package__list">
                <li class="package__element">Virtual Access to DevWebCamp</li>
            </ul>
            <p class="package__price">$0</p>

            <form action="/finish-registration/free" method="POST">
                <input type="submit" class="packages__submit" value="Free Inscription">
            </form>
        </div>

        <div class="package">
            <h3 class="package__name">In-Person Pass</h3>
            <ul class="package__list">
                <li class="package__element">In-Person Access to DevWebCamp</li>
                <li class="package__element">2 Day Pass</li>
                <li class="package__element">Access to Workshops and Conferences</li>
                <li class="package__element">Access to Event Recordings</li>
                <li class="package__element">Event T-Shirt</li>
                <li class="package__element">Food and Drinks</li>
            </ul>
            <p class="package__price">$199</p>
            <div id="smart-button-container">
              <div style="text-align: center;">
                <div id="paypal-button-container"></div>
              </div>
            </div>
        </div>

        <div class="package">
            <h3 class="package__name">Virtual Pass</h3>
            <ul class="package__list">
                <li class="package__element">Virtual Access to DevWebCamp</li>
                <li class="package__element">2 Day Pass</li>
                <li class="package__element">Links to Workshops and Conferences</li>
                <li class="package__element">Access to Event Recordings</li>
            </ul>
            <p class="package__price">$49</p>
            <div id="smart-button-container">
              <div style="text-align: center;">
                <div id="paypal-button-container-virtual"></div>
              </div>
            </div>
        </div>
    </div>
</main>

<script src="https://www.paypal.com/sdk/js?client-id=ARaB5qplSXNS_xYowqWxhjyBk63SuxnzvcJEC6JN8K6dNs5DY67HcspM64Zf8hkmOidL84D_FRGLeR5F&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
 
<script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"1","amount":{"currency_code":"USD","value":199}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            const data = new FormData();
            data.append('packageId', orderData.purchase_units[0].description);
            data.append('paymentId', orderData.purchase_units[0].payments.captures[0].id);
            
            fetch('/finish-registration/pay',{
                method: 'POST',
                body: data
            })
            .then(answer => answer.json())
            .then(result => {
                if(result.result){
                    actions.redirect('http://localhost:3000/finish-registration/conferences');
                }
            })
          });
        },
 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');

      // VIRTUAL PASS
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'blue',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"2","amount":{"currency_code":"USD","value":49}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            const data = new FormData();
            data.append('packageId', orderData.purchase_units[0].description);
            data.append('paymentId', orderData.purchase_units[0].payments.captures[0].id);
            
            fetch('/finish-registration/pay',{
                method: 'POST',
                body: data
            })
            .then(answer => answer.json())
            .then(result => {
                if(result.result){
                    actions.redirect('http://localhost:3000/finish-registration/conferences');
                }
            })
          });
        },
 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container-virtual');
    }
 
  initPayPalButton();
</script>
