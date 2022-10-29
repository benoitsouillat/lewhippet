<?php
include_once('waCommonFunction.php');
include_once('waErrorFunction.php');
$reply_to="";
$text="";
$b_have_info=false;
$wa_form0= waRetrievePostParameter('field_0_wa_id_364jqo1hkh1sto3y');
$text.= "Nom * :\n".$wa_form0."\n\n";
if (($b_have_info==false) && (strlen($wa_form0)>0)) $b_have_info=true;
$wa_form1= waRetrievePostParameter('field_1_wa_id_364jqo1hkh1sto3y');
$text.= "Prénom * :\n".$wa_form1."\n\n";
if (($b_have_info==false) && (strlen($wa_form1)>0)) $b_have_info=true;
$wa_form2= waRetrievePostParameter('field_2_wa_id_364jqo1hkh1sto3y');
$text.= "Votre Email * :\n".$wa_form2."\n\n";
if (($b_have_info==false) && (strlen($wa_form2)>0)) $b_have_info=true;
$wa_form3= waRetrievePostParameter('field_3_wa_id_364jqo1hkh1sto3y');
$text.= "Indiquez ci-dessous la raison de votre contact et les question qui en résultent :\n\n";
$wa_form4= waRetrievePostParameter('field_4_wa_id_364jqo1hkh1sto3y');
$text.= $wa_form4."\n\n";
if (($b_have_info==false) && (strlen($wa_form4)>0)) $b_have_info=true;
$wa_form5= waRetrievePostParameter('field_5_wa_id_364jqo1hkh1sto3y');
$text.= "Le champ contenant des * sont obligatoires.\n\n";
$message_error="";
$res=false;
$destinataire="laromancedesdamoiseaux@lewhippet.com";
$title="MAIL DU SITE";
if ($b_have_info){
$res = waSendMail($destinataire, $title,$text,$reply_to);
$message_error=waGetError();
if (($res==true) && ($waErrorPhpMailReporting==1)) $message_error="";
}
else
{
$message_error="Nothing to send $wa_form2";
}
echo "{\"success\":".(($res)?'true':'false').",\"error\":\"".$message_error."\"}";
?>
