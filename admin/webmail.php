<?php
/* Copyright (C) 2012	Christophe Battarel	<christophe.battarel@altairis.fr>
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
 *      \file       /htdocs/custom/webmail/admin/webmail.php
 *		\ingroup    webmail
 *		\brief      Page to setup advanced webmail module
 */

include '../../../main.inc.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';

$langs->load("admin");
$langs->load("webmail@webmail");

if (! $user->admin) accessforbidden();


/*
 * Action
 */
if (GETPOST('WebMailURL'))
{
    if (dolibarr_set_const($db, 'WEBMAIL_URL', GETPOST('WebMailURL'), 'string', 0, '', $conf->entity) > 0)
    {
          $conf->global->WEBMAIL_URL = GETPOST('WebMailURL');
    }
    else
    {
        dol_print_error($db);
    }
}

if (GETPOST('WebMailType'))
{
    if (dolibarr_set_const($db, 'WEBMAIL_TYPE', GETPOST('WebMailType'), 'string', 0, '', $conf->entity) > 0)
    {
          $conf->global->WEBMAIL_TYPE = GETPOST('WebMailType');
    }
    else
    {
        dol_print_error($db);
    }
}

if (GETPOST('WebMailURL'))
{
    if (dolibarr_set_const($db, 'WEBMAIL_URL', GETPOST('WebMailURL'), 'string', 0, '', $conf->entity) > 0)
    {
          $conf->global->WEBMAIL_URL = GETPOST('WebMailURL');
    }
    else
    {
        dol_print_error($db);
    }
}

/*
 * View
 */

llxHeader('',$langs->trans("WebMailSetup"));


$linkback='<a href="'.DOL_URL_ROOT.'/admin/modules.php">'.$langs->trans("BackToModuleList").'</a>';
print_fiche_titre($langs->trans("WebMailSetup"),$linkback,'setup');

//dol_fiche_head('', 'parameters', $langs->trans("WebMail"), 0, 'webmail');

print "<br>";

print_fiche_titre($langs->trans("MemberMainOptions"),'','');
print '<form method="post">';

print '<table class="noborder" width="100%">';
print '<tr class="liste_titre">';
print '<td>'.$langs->trans("Description").'</td>';
print '<td align="left">'.$langs->trans("Value").'</td>'."\n";
print '<td align="left">'.$langs->trans("Details").'</td>'."\n";
print '</tr>';

$var=true;
$form = new Form($db);

//Webmail type
$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("WebMailType").'</td>';
print '<td align="left">';
print '<select name="WebMailType">';
print '<option value="RoundCube"';
if ($conf->global->WEBMAIL_TYPE == 'RoundCube')
	print ' selected';
print '>RoundCube</option>';
/* Gmail is not useable in iframe
print '<option value="Gmail"';
if ($conf->global->WEBMAIL_TYPE == 'Gmail')
	print ' selected';
print '>Gmail</option>';
*/
print '</select>';
print '</td>';
print '<td>'.$langs->trans('WebMailTypeDetails');
print '</td>';
print '</tr>';

// Webmail url
$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("WebMailURL").'</td>';
print '<td align="left">';
print '<input type="text" size=60 name="WebMailURL" value="'.$conf->global->WEBMAIL_URL.'" />';
print '</td>';
print '<td>'.$langs->trans('WebMailURLDetails');
print '</td>';
print '</tr>';

// submit button
$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td align="center" colspan="3">';
print '<input type="submit" class="button" />';
print '</td>';
print '</tr>';

print '</table>';
print '<br>';

print '</form>';

llxFooter();
$db->close();
?>
