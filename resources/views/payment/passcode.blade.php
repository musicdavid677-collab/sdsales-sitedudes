<div class="hx-credit-card" style="padding:1rem;border:1px solid #bfcbd9;margin-bottom:1rem;">
	<?php $url = url('payment-options?customer_id='. $request->customer_id . '&id=' . $request->id . '&payment_type=' . $request->payment_type) ?>
	<form action="{{ $url }}"
	  method="POST"
	  autocomplete="off"
	  data-hx-post="{{ $url }}"
	  data-hx-target="this" 
	  data-hx-swap="outerHTML swap:1s">
	<div class="alert alert-info">In able to create/view the credit card credentials, you must enter the passcode.</div>
	@if (session()->has('failed'))<div class="alert alert-danger">{{ session('failed') }}</div>@endif
	  @csrf()	  
	  <label for="passcode" class="form-label">Passcode</label>
	  <div class="input-group">
	    <input type="password" 
	    	name="passcode" 
	    	class="form-control" 
	    	id="passcode" 
	    	placeholder="Enter passcode" 
	    	aria-label="Enter passcode" 
	    	aria-describedby="button-submit-passcode passcodeHelp" 
	    	autocomplete="off">
	    <button class="btn btn-outline-secondary" type="submit" id="button-submit-passcode">Submit</button>
	  </div>
      <div class="form-text" id="passcodeHelp">Enter passcode to view the credentials.</div>
	</form>
</div>
