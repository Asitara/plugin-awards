<?php
/*	Project:	EQdkp-Plus
 *	Package:	Awards Plugin
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2015 EQdkp-Plus Developer Team
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Affero General Public License as published
 *	by the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Affero General Public License for more details.
 *
 *	You should have received a copy of the GNU Affero General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if (!defined('EQDKP_INC')){
	header('HTTP/1.0 404 Not Found');exit;
}

$lang = array(
  'awards'						=> 'Awards',

  // Description
  'awards_short_desc'			=> 'Dieses Plugin ermöglicht es Erfolge zu erhalten',
  'awards_long_desc'			=> 'Dieses Plugin ermöglicht es Erfolge zu erhalten.',
  
  // General
  'aw_manage_achievements'		=> 'Erfolge verwalten',
  'aw_manage_assignments'		=> 'Zuweisungen verwalten',
  
  'aw_add_achievement'			=> 'Erfolg hinzufügen',
  'aw_edit_achievement'			=> 'Erfolg editieren',
  'aw_add_assignment'			=> 'Erfolg zuweisen',
  'aw_edit_assignment'			=> 'Zuweisung editieren',
  'aw_icon_header'				=> 'Icon auswählen',
  'aw_upload_icon'				=> 'Icon hinzufügen',
  'aw_special'					=> 'Spezial',
  'aw_auto_assign'				=> 'Automatisch zuweisen',
  'aw_value'					=> 'AP Wert',
  'aw_dkp_value'				=> 'DKP Wert',
  'aw_multidkp'					=> 'Multidkp-Konten',
  'aw_sortation'				=> 'Sortierung',
  'aw_points'					=> 'Punkte',
  'aw_dkp'						=> 'DKP',
  'aw_icon_colors'				=> 'Icon Farben',
  'aw_module'					=> 'Modul',
  'aw_event_id'					=> 'Ereignis ID',
  'aw_adj_id'					=> 'Korrektur ID',
  'aw_adj_gk'					=> 'Korrektur Group Key',
  'aw_achievement'				=> 'Erfolg',
  'aw_achievements'				=> 'Erfolge',
  'aw_show_all'					=> 'Zeige alle Erfolge',
  
  'aw_name_help'				=> 'Name / Titel des Erfolgs',
  'aw_desc_help'				=> 'Beschreibung des Erfolgs',
  'aw_active_help'				=> 'Bestimmt, ob dieser Erfolg zugewiesen werden darf.',
  'aw_special_help'				=> 'Besondere Erfolge sind erst sichtbar wenn diese errungen wurden.',
  'aw_auto_assign_help'			=> '"Plugins: Awards" Cronjob muss aktiviert sein!<br />
									Beispiel: [Ab X Raids] 100',
  
  'aw_customtab_title'			=> 'Meine Erfolge',
  'aw_listachiev_footcount'		=> '... %s Erfolg(e) gefunden / %s pro Seite',
  'aw_listassign_footcount'		=> '... %s Zuweisung(en) gefunden / %s pro Seite',
  
  
  // Cronjob Modules
  'aw_cronmodule_disabled'		=> 'Kein Modul ausgewählt',
  'aw_cronmodule_raids'			=> 'ab X Raids',
  
  
  // System Messages
  'action_achievement_deleted'	=> 'Erfolg gelöscht',
  'action_achievement_added'	=> 'Erfolg erstellt',
  'action_achievement_updated'	=> 'Erfolg aktualisiert',
  
  'aw_plugin_not_installed'		=> 'Das Awards-Plugin ist nicht installiert.',
  'aw_add_success'				=> '%s wurde hinzugefügt',
  'aw_add_nosuccess'			=> '%s konnte nicht hinzugefügt werden',
  'aw_assign_success'			=> '%s wurde<br />%s zugewiesen',
  'aw_assign_nosuccess'			=> '%s konnte nicht zugewiesen werden',
  'aw_del_assign'				=> 'Zuweisung(en) entfernt',
  
  'aw_confirm_delete_achievement'	=> 'Bist du sicher, dass Du die Erfolge %s wirklich löschen willst? Alle erhaltenen DKP werden dabei auch gelöscht!',
  'aw_confirm_delete_assignment'	=> 'Bist du sicher, dass Du die Zuweisungen %s wirklich löschen willst? Alle erhaltenen DKP werden dabei auch gelöscht!',
  

);

?>
