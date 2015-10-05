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
 *	\file       htdocs/custom/webmail/index.php
 *	\ingroup    Prices Management
 *	\brief      Prices management index
 */

require '../../main.inc.php';

$langs->load("webmail@webmail");


/*
 * View
 */
$conf->global->MAIN_HIDE_LEFT_MENU = '1';
llxHeader('',$langs->trans("WebMail"));

$text=$langs->trans("WebMail");
print_fiche_titre($text);

print '<iframe width="100%" height="600" frameborder="0" src="'.$conf->global->WEBMAIL_URL.'">Loading...</iframe>';

llxFooter();
?>
