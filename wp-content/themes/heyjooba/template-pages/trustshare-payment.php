<?php
/*
Template Name: Trustshare payment
*/
get_header();
?>
<script type="module">
  import sdk from 'https://unpkg.com/@trustshare/sdk/dist/index.esm.js';
//  const trustshare = createSDK('sandbox_pk_n64AZDbEYxKRyJdHlbfiGiIUJvbVJmPe');
    
  const start = async function() {
  const {
    api: {
      v1: { createPaymentIntent },
    },
  } = await trustshare.api.v1.createPaymentIntent({
    type: "checkout",
    currency: "gbp",
    fee_flat: 0,
    fee_percentage: 0.015,
    from: {
      name: "Nishant Mehra",
      email:'nishant.mehra@imarkinfotech.com',
    },
    settlements: [
      {
        type: "funding",
        amount: 1000,
        description: "Deposit",
      },
    ],
  });
}
  
  start();
</script>
<!--
<script>
const trustshare = createSDK('sandbox_pk_n64AZDbEYxKRyJdHlbfiGiIUJvbVJmPe');
    
const start = async function() {
const result = await trustshare.api.v1.createPaymentIntent({
  type: 'checkout',
  currency: 'usd',
  from: {
    email: 'nishant.mehra@imarkinfotech.com',
  },
  settlements: [
    {
      type: 'escrow',
      amount: 150000,
      description: 'An example of a line item',
      to: {
        email: 'heemadri.sharma@imarkinfotech.com',
      }
    }
  ]
});
}

start();
</script>
-->
<?php
get_footer();
?>