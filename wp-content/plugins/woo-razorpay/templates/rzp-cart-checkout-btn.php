<style type="text/css">
.checkout-button {
  display: none !important;
}
</style>
<div>
  <button
    id="btn-1cc"
    class="rzp-checkout-button button alt wc-forward"
    type="button"
    >PROCEED TO CHECKOUT
  </button>
</div>

<div id="rzp-spinner-backdrop"></div>
<div id="rzp-spinner">
  <div id="loading-indicator"></div>
  <div id="icon">
    <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/images/rzp-spinner.svg'; ?>" alt="Loading"  id="rzp-logo" />
  </div>
</div>
<div id="error-message">
</div>
