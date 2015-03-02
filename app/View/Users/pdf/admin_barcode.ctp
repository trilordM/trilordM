<table width="462" height="295" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" style="border: 5px solid #4e1111;">
	
    <tr>
    	<td width="50%" align="left"><img src="<?php echo WWW_ROOT.'/images/trilord-market.png';?>" /></td>
        <?php if(file_exists(WWW_ROOT.'/providers_photo/thumbs/'.$userInfo['User']['profile_photo'])&&!empty($userInfo['User']['profile_photo'])){?>
        <td width="" align="right" valign="top"><img src="<?php echo WWW_ROOT.'/providers_photo/thumbs/'.$userInfo['User']['profile_photo']?>" height="130" /></td>
        <?php }else{ ?>
		<td width="" align="right" valign="top"><img src="<?php echo WWW_ROOT.'/images/avatar.gif'?>" height="130" /></td>
		<?php  }?>
    </tr>
    
    <tr>
    	<td colspan="2">
            <table border="0" cellpadding="2" cellspacing="0" style="font-size:20px;">
            
                <tr>
                    <td colspan="2"><i>T</i>#<?php echo $userInfo['User']['card_number']?></td>
                </tr>
                
                <tr>
                    <td align="left"><i>Name/Company :</i></td>
                    <td align="left"><?php echo $userInfo['User']['name']?></td>
                </tr>
                
                 
                <tr>
                    <td><i>Date of Issue :</i></td>
                    <td align="left"><?php if($userInfo['User']['issue_date']!='0000-00-00'){
					echo $this->Time->format('M d, Y',$userInfo['User']['issue_date']);
					}?></td>
                </tr>
                
                <tr>
                    <td><i>Date of Expiry :</i></td>
                    <td align="left"><?php if($userInfo['User']['expire_date']!='0000-00-00'){
					echo $this->Time->format('M d, Y',$userInfo['User']['expire_date']);
					}?></td>
                </tr>
            </table>
        </td>
    </tr>
    
    <tr>
    	<td width="80%" align="center">
        	<p style="font-size:12px;"><b>trilordMARKET.com</b><br />
has issued this ID for verification and security purpose only and is not responsible or liable for the actions of this ID holder.<br />
 <b>If found please contact, 01-4220007 or, email us at email@trilordmarket.com</b>

</p>
        </td>
        
        <td width="20%" align="right">
        	<?php
	 echo $this->QrCode->url(SITE_URL.'provider/'.$userInfo['User']['id']); 
	?>
        </td>
    </tr>
   

</table>