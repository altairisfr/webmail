<?php
/* Copyright (C) 2012      Christophe Battarel  <christophe.battarel@altairis.fr>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *  \file       htdocs/custom/webmail/tabs/thirdpartyEmails.php
 *  \ingroup    webmail
 *  \brief      Page of tab webmail for third party
 */

require '../../../main.inc.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';
require_once DOL_DOCUMENT_ROOT.'/societe/class/societe.class.php';

$langs->load("companies");
$langs->load("other");
$langs->load("webmail@webmail");
if (! empty($conf->notification->enabled)) $langs->load("mails");

// Security check
$socid = GETPOST('socid','int');
if ($user->societe_id) $socid=$user->societe_id;
$result = restrictedArea($user, 'societe', $socid, '&societe');


/*
*	View
*/

llxHeader();

$soc = new Societe($db);
$soc->fetch($socid);

/*
 * Affichage onglets
 */
$head = societe_prepare_head($soc);
$form = new Form($db);

dol_fiche_head($head, 'webmail@webmail', $langs->trans("ThirdParty"),0,'company');

// Get Email folder
$webmailfolder = '';
$sql = "SELECT webmail from ".MAIN_DB_PREFIX."societe_extrafields where fk_object = ".$socid;
$resql=$db->query($sql);
if ($resql)
{
    $num=$db->num_rows($resql);
    if ($num > 1)
    {
        $error='Societe::Fetch several records found for ref='.$ref;
        dol_syslog($error, LOG_ERR);
        $result = -1;
    }
    if ($num)
    {
        $obj = $db->fetch_object($resql);
        $webmailfolder = $obj->webmail;
	}
}

print '<table class="border" width="100%">';

print '<tr><td width="25%">'.$langs->trans("ThirdPartyName").'</td><td colspan="3">';
print $form->showrefnav($soc,'socid','',($user->societe_id?0:1),'rowid','nom');
print '</td></tr>';

if (! empty($conf->global->SOCIETE_USEPREFIX))  // Old not used prefix field
{
    print '<tr><td>'.$langs->trans('Prefix').'</td><td colspan="3">'.$soc->prefix_comm.'</td></tr>';
}

if ($soc->client)
{
	print '<tr><td>';
	print $langs->trans('CustomerCode').'</td><td colspan="3">';
	print $soc->code_client;
	if ($soc->check_codeclient() <> 0) print ' <font class="error">('.$langs->trans("WrongCustomerCode").')</font>';
	print '</td></tr>';
}

if ($soc->fournisseur)
{
	print '<tr><td>';
	print $langs->trans('SupplierCode').'</td><td colspan="3">';
	print $soc->code_fournisseur;
	if ($soc->check_codefournisseur() <> 0) print ' <font class="error">('.$langs->trans("WrongSupplierCode").')</font>';
	print '</td></tr>';
}

if (! empty($conf->barcode->enabled))
{
	print '<tr><td>'.$langs->trans('Gencod').'</td><td colspan="3">'.$soc->barcode.'</td></tr>';
}

print "<tr><td valign=\"top\">".$langs->trans('Address')."</td><td colspan=\"3\">";
dol_print_address($soc->address, 'gmap', 'thirdparty', $soc->id);
print "</td></tr>";

// Zip / Town
print '<tr><td width="25%">'.$langs->trans('Zip').'</td><td width="25%">'.$soc->cp."</td>";
print '<td width="25%">'.$langs->trans('Town').'</td><td width="25%">'.$soc->ville."</td></tr>";

// Country
if ($soc->pays) {
	print '<tr><td>'.$langs->trans('Country').'</td><td colspan="3">';
	$img=picto_from_langcode($soc->country_code);
	print ($img?$img.' ':'');
	print $soc->pays;
	print '</td></tr>';
}

print '<tr><td>'.$langs->trans('Phone').'</td><td>'.dol_print_phone($soc->tel,$soc->country_code,0,$soc->id,'AC_TEL').'</td>';
print '<td>'.$langs->trans('Fax').'</td><td>'.dol_print_phone($soc->fax,$soc->country_code,0,$soc->id,'AC_FAX').'</td></tr>';

// EMail
print '<tr><td>'.$langs->trans('EMail').'</td><td>';
print dol_print_email($soc->email,0,$soc->id,'AC_EMAIL');
print '</td>';

// Web
print '<td>'.$langs->trans('Web').'</td><td>';
print dol_print_url($soc->url);
print '</td></tr>';

// Webmail folder
print '<td>'.$langs->trans('WebMailFolder').'</td><td colspan="3">';
print $webmailfolder;
print '</td></tr>';

print '</table>';

print '</div>';

$webmail = $conf->global->WEBMAIL_URL;
switch($conf->global->WEBMAIL_TYPE)
{
	case 'RoundCube':
		$webmail .= '/?_task=mail&_mbox=INBOX.'.$webmailfolder;
		break;
/* Gmail is not useable in iframe
	case 'Gmail':
		$webmail .= '/mail/u/0/?shva=1#label/%5BGmail%5D%2F'.$webmailfolder;
		break;
*/
}

print '<iframe id="webmail" width="100%" height="600" frameborder="0" src="'.$webmail.'">Loading...</iframe>';

print '<script type="text/javascript">

	$("#webmail").load(function() {
		// larry theme
		var lmenu = $("#webmail").contents().find("div#mailview-left");
		var rmenu = $("#webmail").contents().find("div#mailview-right");
		$(lmenu).remove();
		$(rmenu).css({left:0});
		// classic theme
		var lmenu = $("#webmail").contents().find("div#mailleftcontainer");
		var rmenu = $("#webmail").contents().find("div#mailrightcontainer");
		var splitter = $("#webmail").contents().find("div#mailviewsplitterv");
		var msgfrm = $("#webmail").contents().find("div#messageframe");
		$(lmenu).remove();
		$(splitter).remove();
		$(rmenu).css({left:0});
		$(msgfrm).css({left:0});
	});

</script>';

llxFooter();

$db->close();
?>
