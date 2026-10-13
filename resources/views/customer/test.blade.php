<style>
body{font-family: 'Open Sans', sans-serif;}
a {
    color:#333;
    text-decoration:none;
    font-weight:bold;
}
a:hover {
    color:#f7971c;
}
.orangeFont {
    color:#f7971c;
    text-shadow:0px 2px 0px rgba(255,255,255,1);
}
.boxHeading {
    color: #414141;
    font-weight: bold;
    position: relative;
    margin:0em 0px 0.4em;
    z-index: 99;
    font-size:30px;
    text-shadow:0px 3px 0px rgba(255,255,255,1);
}
.content {
    width: 1250px;
    margin: 4em auto;
}
</style>
<div class="content">
<div align="center">
<div>
 </div>
  <div style="margin:0 0 20px 0;">
    <a href="http://www.sitedudes.com" target="_blank"><img border='0' src='https://www.sitedudes.com/logo/logo450.png' width='300' height='100'></a></td>
  </div>
  <div style="margin:0 0 60px 0;">
  <u>SiteDudes.com Payment Contract, Credit Card Authorization & Pre-payment Form </u><br>
  <a href="http://www.sitedudes.com/landing" target="_blank">www.SiteDudes.com</a> - 548 King St West, 301 Suite, Toronto, ON, M5V 1M3 - sales@siteDudes.com
  </div>
<table width="100%">.
<tr>.
<td colspan="4"><div class="boxHeading">SECTION A: Client/Company Info - <span class="orangeFont">{{$rec->customer_id}}</span></div></td>
</tr>
<tr>
<td height="10"></td>
</tr>
<tr class="txt11pxwht">.
<td width="200">Client/Company Name:</td>
<td colspan="3">{{$lead->salutation.' '. $lead->first_name . ' ' . $lead->last_name}}&nbsp;/&nbsp;{{$lead->company}}</td>
</tr>
<tr class="txt11pxwht">.
<td>Address:</td>
<td width="200">{{$lead->address}} </td>
<td width="40">City</td>
<td width="150"> {{$lead->city}}</td>
</tr>
<tr class="txt11pxwht">.
<td>State:</td>
<td>{{$lead->state}}</td>
<td>Zip/Postal Code:</td>
<td>{{$lead->zip}}</td>
</tr>
<tr class="txt11pxwht">.
<td>Telephone #</td>
<td>{{$lead->area.' '.$lead->phone.' '.$lead->phone2}} ext: {{$lead->ext}}</td>
<td>Fax #:</td>
<td>{{$lead->fax_area.' '.$lead->fax_1.' '.$lead->fax_2}}</td>
</tr>
<tr class="txt11pxwht">.
<td>Email:</td>
<td>{{ $lead->email_address }}</td>
<td>Website:</td>
<td>{{ $lead->url }}</td>
</tr>
</table>
<br /><br />
<table width="100%">
<tr>
<td colspan="4"><div class="boxHeading">SECTION B: Payment Info</b></div></td>
</tr>
<tr>
<td height="10"></td>
</tr>
<tr class="txt11pxwht">
<td colspan="4"> <span class="txt11pxwht">I,</span> <span class="orangeFont">{{$lead->first_name . ' ' . $lead->last_name}}</span>
<span class="txt11pxwht"> hereby grant SiteDudes.com authorization to charge my Credit Card.</span></td>
</tr>
<tr>
<td colspan="4"> <table width="" border="0" cellpadding="0" cellspacing="0">
<tr>
<td height="10"></td>
</tr>
<tr class="txt11pxwht">
<td width="200">Name On Card:</td>
<td width="200">S  Bhise</td>
<td width="104"></td>
<td width="179" colspan="2"></td>
</tr>
<tr class="txt11pxwht">
<td>Card Number:</td>
<td>XXXX XXXX XXXX&nbsp;144C</td>
<td>Expiry Date:</td>
<td>01/28</td>
</tr>
<tr class="txt11pxwht">
<td>Cardholder Phone #:</td>
<td colspan="3">--</td>
</tr>
<tr class="txt11pxwht">
<td>Billing Address:</td>
<td colspan="3">{{$rec->ch_billing_address}}</td>
</tr>
<tr class="txt11pxwht">
<td>Billing City:</td>
<td>{{$rec->ch_city}}</td>
<td>Billing State:</td>
<td>{{$rec->ch_state}}</td>
</tr>
<tr class="txt11pxwht">.
<td>Billing Zip/Postal Code:</td>
<td>{{$rec->ch_zip}}</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table></td>
</tr>
<tr>
<td height="40"></td>
</tr>

