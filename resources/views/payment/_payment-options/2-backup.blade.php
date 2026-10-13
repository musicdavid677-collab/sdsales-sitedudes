<div class="form-group">
    <label for="chName">Name On Cheque</label>
    <input type="text" 
        name="pbc_name_on_cheque" 
        value="{{ old_set('pbc_name_on_cheque', NULL, $customer) }}" 
        id="chName" 
        class="form-control">
</div>
<div class="form-group" style="display:hidden;">
<label>Phone Number On Cheque</label>
<input type="text" name="" value="" id="" class="form-control">
</div>
<label>Address On Cheque</label>
<input type="text" name="pbc_address" value="{{ old_set('pbc_address', NULL, $customer) }}" id="" class="form-control">

<div class="row">
    <div class="col-md-5">
        <label>Cheque City</label>
        <input type="text" name="pbc_city" value="{{ old_set('pbc_city', NULL, $customer) }}" id="" class="form-control">
    </div>
    <div class="col-md-4">
<label for="chequeState">Cheque State</label>
<select name="pbc_state" id="chequeState" class="form-control">
<option value="" selected="">-Select a State- </option>
<option value="AL">Alabama </option>
<option value="AK">Alaska </option>
<option value="AZ">Arizona </option>
<option value="AR">Arkansas </option>
<option value="CA">California </option>
<option value="CO">Colorado </option>
<option value="CT">Connecticut </option>
<option value="DE">Delaware </option>
<option value="FL">Florida </option>
<option value="GA">Georgia </option>
<option value="HI">Hawaii </option>
<option value="ID">Idaho </option>
<option value="IL">Illinois </option>
<option value="IN">Indiana </option>
<option value="IA">Iowa </option>
<option value="KS">Kansas </option>
<option value="KY">Kentucky </option>
<option value="LA">Louisiana </option>
<option value="ME">Maine </option>
<option value="MD">Maryland </option>
<option value="MA">Massachusetts </option>
<option value="MI">Michigan </option>
<option value="MN">Minnesota </option>
<option value="MS">Mississippi </option>
<option value="MO">Missouri </option>
<option value="MT">Montana </option>
<option value="NE">Nebraska </option>
<option value="NV">Nevada </option>
<option value="NH">New Hampshire </option>
<option value="NJ">New Jersey </option>
<option value="NM">New Mexico </option>
<option value="NY">New York </option>
<option value="NC">North Carolina </option>
<option value="ND">North Dakota </option>
<option value="OH">Ohio </option>
<option value="OK">Oklahoma </option>
<option value="OR">Oregon </option>
<option value="PA">Pennsylvania </option>
<option value="RI">Rhode Island </option>
<option value="SC">South Carolina </option>
<option value="SD">South Dakota </option>
<option value="TN">Tennessee </option>
<option value="TX">Texas </option>
<option value="UT">Utah </option>
<option value="VT">Vermont </option>
<option value="VA">Virginia </option>
<option value="WA">Washington </option>
<option value="DC">Washington DC </option>
<option value="WV">West Virginia </option>
<option value="WI">Wisconsin </option>
<option value="WY">Wyoming </option>
<option value="AB">Alberta</option>
<option value="BC">British Columbia</option>
<option value="MB">Manitoba</option>
<option value="NB">New Brunswick</option>
<option value="NL">Newfoundland and Labrador</option>
<option value="NS">Nova Scotia</option>
<option value="NT">Northwest Territories</option>
<option value="NU">Nunavut</option>
<option value="ON">Ontario</option>
<option value="PE">PEI</option>
<option value="QC">Quebec</option>
<option value="SK">Saskatchewan</option>
<option value="YT">Yukon</option>
</select>
</div>
<div class="col-md-3">
<label>Cheque Zip</label>
<input type="text" name="pbc_zip" value="{{ old_set('pbc_zip', NULL, $customer) }}" id="" class="form-control">
</div>
</div><!--row-->

    <div class="form-group">
        <label>Cheque Number</label>
        <input type="text" 
            name="chq_num" 
            value="{{ old_set('chq_num', NULL, $customer) }}" 
            id="" 
            class="form-control">
    </div>

    <div class="form-group">
        <label>Signature Name</label>
        <input type="text" 
            name="pbc_signature_name" 
            value="{{ old_set('pbc_signature_name', NULL, $customer) }}" 
            id="" 
            class="form-control">
    </div>
<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Bank Routing Code &amp; Account Number</span>
  </div>
  <input type="text" name="pbc_routing_code" value="{{ old_set('pbc_routing_code', NULL, $customer) }}" aria-label="Bank Routing Code" class="form-control">
  <input type="text" name="pbc_account_number" value="{{ old_set('pbc_account_number', NULL, $customer) }}" aria-label="Account Number" class="form-control">
</div>
<br />
