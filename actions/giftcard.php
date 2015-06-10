<?php

	$_SESSION['user'] = 1;
	
	/** giftcard.php XSRF
	 * 
	 * The purpose of the giftcard is to take a stored payment method from the user,
	 * and purchase a giftcard. The way the output works is that the user can easily
	 * hit a URL: 
	 * 
	 * giftcard.php?purchase=true&confirm=true&value=100&target=emailaddress&email=no
	 * 
	 * The parts of this are:
	 * 
	 * purchase: yes|no - are you making a purchase or viewing information
	 * confirm: true|NULL - we pass this after we have displayed a "confirm" the to user
	 * value: 10-1000 in $ - target will have this much given as credit
	 * target: email address - the receiver of the giftcard
	 * email: no - does the user want to have an email confirmation?
	 */

	if($_SESSION['user']) {
		// Ok, 
		if ( !isset($_GET['purchase']) ) {
			// Show the user the page about how awesome gift cards are
			
			echo "ULTIMATE GIFT BEGIN!
					
					<form action='" . $_SERVER['PHP_SELF'] . "' method='get'>
						<p>Email of person you want to give gift: <input name='target' placeholder='friend@email.com' /><br />
						We'll send them a fancy email with lovey dovey schtuff. Noice.</p>
							
						<p>Value of the giftcard: <input type='text' name='value' placeholder='0.00'/><br />
							Valid amounts are $10 to $1000.</p>
						<p><input type='hidden' name='purchase' value='true' />
							<input type='submit' name='_submut' value='Be awesome and buy!' /></p>
					</form>";
		}
		
		elseif ( isset($_GET['purchase']) && !isset($_GET['confirm']) ) {
			// Display this to the user and tell them how awesome they're being
			// Such a nice person being all gifty.
			
			echo "<h1>SUPER NICE PERSON!</h1>
					<p>You are gifting <strong>" . $_GET['value'] . "</strong> to 
							<strong>" . $_GET['target'] . "</strong></p>
					<form action='" . $_SERVER['PHP_SELF'] . "' method='get'>
						<input type='hidden' name='purchase' value='true' />
						<input type='hidden' name='value' value='" . $_GET['value'] . "' />
						<input type='hidden' name='target' value='" . $_GET['target'] . "' />
					<p>
						Send me a confirmation email: <input type='checkbox' name='email' value='true' /></p>
						<p><input type='hidden' name='confirm' value='true' />
								<input type='submit' name='_mutsub' value='Buy!' /></p>
					</form>";
		}
		

		elseif ( isset($_GET['purchase']) && isset($_GET['confirm']) ) {
			// Execute a purchase against the user and send the confirmation
			
			$Voucher = uniqid();
			
			echo "Success! You are an awesome person and purchase an awesome gift card for your friend.
					
					<br />We already sent it to them. 
					
					<br /><br />Confirmation number: " . $Voucher;
			 
			mail ( $_GET['target'] , 'USER has sent you a voucher for BACON' , 
					"Congrats! You've received a voucher for bacon.
					
					Use the voucher code: " . $Voucher . " for a value up to $" . $_GET['value'] . " worth of bacon.
					
					OM NOM ENJOY!");
		}
	}
	
	
	
	
	
	