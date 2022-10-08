<?php
/*
Template Name: Payment Page
*/
get_header(); 
?>
<!-- replace "demo" with your verified subdomain -->
<script src="https://demo.trustshare.co/sdk.js" async defer></script>
<button class="checkout">Checkout</button>
<?php
get_footer();
?>
<script>
document
  .querySelector('.checkout')
  .addEventListener('click', () => {
    trustshare.checkout.modal({
      to: 'andrew@heyjobba.com',
      from: 'nishant.mehra@imarkinfotech.com',
      amount: 150000,
      depositAmount: 100000,
      description: 'An example description',
      onClose({ status, token }) {
        // see `status` table below
        console.log({ status, token });
      }
    })
  })
</script>