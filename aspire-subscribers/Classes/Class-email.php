<?php
Class SubscriberEmails
{
   public function emailFooter()
	{
		$footer='<tr>
				    <td style="padding: 20px 15px 20px ; color: #333" align="left" width="100%" valign="top">
				        <p style="margin: 0px ; font-size: 10pt ; margin-bottom: 0px;text-align: left;color:#dd4814;">
				            Thank you,<br/>
							'.site_url().'
				        </p>
				    </td>
					</tr>
					</table>
					</td>
					</tr>
					</tbody></table>
					</body>';
		return $footer;
	}

	public function emailHeader()
	{
		$header='<body style="background:#f1f1f1;">
					<table style="font-family: Arial, Helvetica Neue;"  align="center" width="600" cellspacing="0" cellpadding="0" border="0">
					    <tbody>
					    <tr>
					        <td width="100%">&nbsp;</td>
					    </tr>
					    <tr>
					        <td style="padding-bottom: 30px" align="center" width="100%" valign="top">

					            <a title="bstore.be" href="'.site_url().'" style="display: block ; width: 235px" target="_other" rel="nofollow">
								<img style="max-width: 100%" src="https://bstore.be/wp-content/uploads/2021/04/bstore-logo.png" alt="bstore.be"></a>

					        </td>
					    </tr>';
		return $header;
	}

   public static function SubscribeUSerEmail($to,$username, $subject)
   {
		ob_start();
		$emailHeader= self::emailHeader();
		$message = '<tr>
	       			 <td style="padding: 18px 40px 23px ; color: #fff" align="left" width="100%" valign="top" bgcolor="#dd4814">
	           			 <h2 class="anchor_color" style=" font-weight:normal;margin: 0px ; font-size: 24pt ; letter-spacing: 0.05em;color:#fff;">'.$subject.'</h2> 
	       			 </td>
						 </tr>
							<tr>
							   <td>
							        <table style="background-color: #fff;border: 1px solid #80808042;width: 100%;padding: 0px 25px 23px;">
					    		<tr>
					    	<td style="font-size: 11pt; padding: 35px 15px 10px;color: #333333;">
					               Hi '.ucfirst($username).', <br/>
								   <p>Thank you for subscribing, now you will receive the offers on your wishlist products.</p>
								   <p><a style="color: #dd4814;" target="_blank" href='.$wishisListPage_link.'>Click Here</a></p>            
					          </td>
						</tr>';
		$emailFooter=self::emailFooter();
		ob_end_clean();
		$body= $emailHeader.$message.$emailFooter;
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$send= wp_mail( $to, $subject, $body, $headers );
   }

}

?>