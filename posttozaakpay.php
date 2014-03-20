<?php
/*
Template Name: PostToZaakpayPage
*/
?>
<?php
Class Checksum {
	static function calculateChecksum($secret_key, $all) {
		$hash = hash_hmac('sha256', $all , $secret_key);
		$checksum = $hash;
		return $checksum;
	}

	static function getAllParams() {
		//ksort($_POST);
		$all = '';
		foreach($_POST as $key => $value)	{
			if($key != 'checksum') {
				$all .= "'";
				if ($key == 'returnUrl') {
					$all .= Checksum::sanitizedURL($value);
				} else {
					$all .= Checksum::sanitizedParam($value);
				}
				$all .= "'";
			}
		}
		
		return $all;
	}

	static function outputForm($checksum) {
		//ksort($_POST);
		foreach($_POST as $key => $value) {
			if ($key == 'returnUrl') {
				echo '<input type="hidden" name="'.$key.'" value="'.Checksum::sanitizedURL($value).'" />'."\n";
			} else {
				echo '<input type="hidden" name="'.$key.'" value="'.Checksum::sanitizedParam($value).'" />'."\n";
			}
		}
		echo '<input type="hidden" name="checksum" value="'.$checksum.'" />'."\n";
	}

	static function verifyChecksum($checksum, $all, $secret) {
		$cal_checksum = Checksum::calculateChecksum($secret, $all);
		$bool = 0;
		if($checksum == $cal_checksum)	{
			$bool = 1;
		}

		return $bool;
	}

	static function sanitizedParam($param) {
		$pattern[0] = "%,%";
	        $pattern[1] = "%#%";
	        $pattern[2] = "%\(%";
       		$pattern[3] = "%\)%";
	        $pattern[4] = "%\{%";
	        $pattern[5] = "%\}%";
	        $pattern[6] = "%<%";
	        $pattern[7] = "%>%";
	        $pattern[8] = "%`%";
	        $pattern[9] = "%!%";
	        $pattern[10] = "%\\$%";
	        $pattern[11] = "%\%%";
	        $pattern[12] = "%\^%";
	        $pattern[13] = "%=%";
	        $pattern[14] = "%\+%";
	        $pattern[15] = "%\|%";
	        $pattern[16] = "%\\\%";
	        $pattern[17] = "%:%";
	        $pattern[18] = "%'%";
	        $pattern[19] = "%\"%";
	        $pattern[20] = "%;%";
	        $pattern[21] = "%~%";
	        $pattern[22] = "%\[%";
	        $pattern[23] = "%\]%";
	        $pattern[24] = "%\*%";
	        $pattern[25] = "%&%";
        	$sanitizedParam = preg_replace($pattern, "", $param);
		return $sanitizedParam;
	}

	static function sanitizedURL($param) {
		$pattern[0] = "%,%";
	        $pattern[1] = "%\(%";
       		$pattern[2] = "%\)%";
	        $pattern[3] = "%\{%";
	        $pattern[4] = "%\}%";
	        $pattern[5] = "%<%";
	        $pattern[6] = "%>%";
	        $pattern[7] = "%`%";
	        $pattern[8] = "%!%";
	        $pattern[9] = "%\\$%";
	        $pattern[10] = "%\%%";
	        $pattern[11] = "%\^%";
	        $pattern[12] = "%\+%";
	        $pattern[13] = "%\|%";
	        $pattern[14] = "%\\\%";
	        $pattern[15] = "%'%";
	        $pattern[16] = "%\"%";
	        $pattern[17] = "%;%";
	        $pattern[18] = "%~%";
	        $pattern[19] = "%\[%";
	        $pattern[20] = "%\]%";
	        $pattern[21] = "%\*%";
        	$sanitizedParam = preg_replace($pattern, "", $param);
		return $sanitizedParam;
	}

	static function outputResponse($bool) {
		foreach($_POST as $key => $value) {
			if ($bool == 0) {
				if ($key == "responseCode") {
					echo '<tr><td width="50%" align="center" valign="middle">'.$key.'</td>
						<td width="50%" align="center" valign="middle"><font color=Red>***</font></td></tr>';
				} else if ($key == "responseDescription") {
					echo '<tr><td width="50%" align="center" valign="middle">'.$key.'</td>
						<td width="50%" align="center" valign="middle"><font color=Red>This response is compromised.</font></td></tr>';
				} else {
					echo '<tr><td width="50%" align="center" valign="middle">'.$key.'</td>
						<td width="50%" align="center" valign="middle">'.$value.'</td></tr>';
				}
			} else {
				echo '<tr><td width="50%" align="center" valign="middle">'.$key.'</td>
					<td width="50%" align="center" valign="middle">'.$value.'</td></tr>';
			}
		}
		echo '<tr><td width="50%" align="center" valign="middle">Checksum Verified?</td>';
		if($bool == 1) {
			echo '<td width="50%" align="center" valign="middle">Yes</td></tr>';
			}
		else {
			echo '<td width="50%" align="center" valign="middle"><font color=Red>No</font></td></tr>';
		}
	}
}
?>
<?php
	$secret = '30d222cb9bc44f0bb4434bd89f1b03b7';

	$all = Checksum::getAllParams();
	$checksum = Checksum::calculateChecksum($secret, $all);
?>
<center>
<table width="500px;">
	<tr>
		<td align="center" valign="middle">Do Not Refresh or Press Back <br/> Redirecting to Zaakpay</td>
	</tr>
	<tr>
		<td align="center" valign="middle">
			<form action="https://api.zaakpay.com/transact" method="post">
				<?php
				Checksum::outputForm($checksum);
				?>
			</form>
		</td>

	</tr>

</table>

</center>
<script type="text/javascript">
var form = document.forms[0];
form.submit();
</script>