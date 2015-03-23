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
/*+----------------------------------------------------------------------------
  | awards_userprofile_customtabs_hook
  +--------------------------------------------------------------------------*/
if (!class_exists('awards_userprofile_customtabs_hook')){
  class awards_userprofile_customtabs_hook extends gen_class
  {

	/**
	  * userprofile_customtabs
	  * display the achievement tab
	  */
	public function userprofile_customtabs($intUserID){
		if($this->user->check_auths(array('u_awards_view', 'a_awards_manage'), 'OR', false)){
			$arrAchIDs		= $this->pdh->get('awards_achievements', 'id_list');
			$intUserID		= $intUserID['user_id'];
			$intViewerID	= $this->user->id;
			$allAwards		= array();
			$intAP			= 0;
			$status_count	= 0;
			$status_row		= '';
			$content		= '';
			
			//sorting -- newest date = up, false = unreached
			foreach($arrAchIDs as $intAchID){
				$award = $this->awards->award($intAchID, $intUserID);
				if(is_array($award['member_r'][$intUserID])){
					$allAwards[$award['id']] = $award['date'];
				}else{
					$allAwards[$award['id']] = false;
				}
			}
			arsort($allAwards);
			
			//split $allAwards for pagination
			$intPage = $this->in->get('page', 0);
			$arrUserSettings = $this->pdh->get('user', 'plugin_settings', array($intViewerID));
			$arrUserSettings['aw_pagination'] = (isset($arrUserSettings['aw_pagination']))? $arrUserSettings['aw_pagination'] : 25;
			$allAwardsCount = count($allAwards);
			$allAwards = array_slice($allAwards, $intPage * $arrUserSettings['aw_pagination'], $arrUserSettings['aw_pagination'], true);
			
			
			//build the content
			$content = '
				<div id="awards">
					<div id="progress-header">
						<div class="progress-left floatLeft">Fortschritt:&nbsp;</div>
						<div class="progress-right floatRight">
							<span id="achievement-points">Loading...</span>&nbsp;<i class="fa fa-bookmark-o"></i>
						</div>
						<div id="my_aw_progress">
							<div class="progress-label">Loading...</div>
						</div>
					</div>
					<div class="aw-list">
			';
			
			//now build each award
			foreach($allAwards as $intAchID => $status){
				$award = $this->awards->award($intAchID, $intUserID);
				
				//check persmission to see
				$perm_admin = $this->user->check_auth('a_', false);
				$perm_user  = $this->pdh->get('awards_library', 'member_of_award', array($intAchID));
				$perm_user  = in_array($intViewerID, $perm_user);
				if($award['special'] && !($perm_user || $perm_admin)) continue;
				
				if(	   $award['dkp'] < 0){ $blnAchDKP = 1; }
				elseif($award['dkp'] > 0){ $blnAchDKP = 2; }
				else{					   $blnAchDKP = 0; }
				
				if($status > 0){
					$status_count++; $intAP += $award['points'];
					if( empty($status_row) ){ $content .= '<div class="reached">'; $status_row = 'reached'; }
				}else{
					if( empty($status_row) ){ $content .= '<div class="unreached">'; $status_row = 'unreached'; }
					if($status_row == 'reached'){ $content .= '</div><div class="unreached">'; $status_row = 'unreached'; }
				}
				
				if(!$award['active']) $strActive = '<i class="fa fa-clock-o ac-inactive" title="Award is inactive"></i>';
				if($award['special']) $strSpecial = '<i class="fa fa-eye-slash ac-special" title="Award is secret"></i>';
				
				$content .= '
					<div class="award ac-'.$intAchID.' awToggleTrigger">
						<div class="ac-icon floatLeft">
							'.$this->awards->build_icon($intAchID, $award['icon'], unserialize($award['icon_colors'])).'
							'.$strActive.$strSpecial.'
						</div>
						<div class="ac-points floatRight">
				';
				
				if($blnAchDKP != 0){
					if($blnAchDKP == 1){ $content .= '<span class="ac-points-big" style="color: #C03D00;">'; }
					else { $content .= '<span class="ac-points-big" style="color: #20C000;">'; }
					$content .= $award['dkp'].'<span class="ac-points-small">'.$award['points'].'</span></span>';
					
				} else { $content .= '<span class="ac-points-big">'.$award['points'].'</span>'; }
				
				$content .= '
					</div>
					<div class="ac-main">
						<h2 class="ac-title">'.$this->user->multilangValue($award['name']).'</h2>
						<p class="ac-desc">'.$this->user->multilangValue($award['desc']).'</p>
						<p class="ac-date">'.$this->time->user_date($award['date']).'</p>
					</div>
					<div class="ac-user-list" style="display:none;">
				';
				
				if($award['member_r'][$intUserID])
					foreach($award['member_r'][$intUserID] as $intMemberID => $intMemberDate){
						$content .= '
							<div class="ac-member-reached user-'.$intMemberID.'">
								'.$this->pdh->get('member', 'html_name', array($intMemberID)).' - '.$this->time->user_date($intMemberDate).'
							</div>
						';
					}
					
				$content .= '</div></div>';
			}
			
			$content .= '</div></div></div>
				<div class="contentFooter">'.generate_pagination($this->strPath.$this->SID, $allAwardsCount, $arrUserSettings['aw_pagination'], $intPage, 'page').'</div>';
			
			$this->tpl->add_js('
				$("#my_aw_progress").progressbar({
					value: '.$status_count.',
					max: '.$allAwardsCount.',
				});
				$(".progress-label").text("'.$status_count.' / '.$allAwardsCount.'");
				$("#achievement-points").text("'.$intAP.'");
				
				$(".awToggleTrigger").on("click", function(event){
					if ($(this).hasClass("show-member")){
						$(this).removeClass("show-member");
						$(this).children(".ac-user-list").hide(50);
					}else{
						$(".awToggleTrigger").each(function(){
							$(this).removeClass("show-member");
							$(this).children(".ac-user-list").hide(50);
						});
						$(this).addClass("show-member");
						$(this).children(".ac-user-list").show(200);
					}
				});
			', 'docready');
			
			
		}else{ $content = 'You don\'t have the permission to see the awards'; }
		
		//-----------------------------------------------------------------------------------
			$output = array(
				'title'   => $this->user->lang('aw_customtab_title'),
				'content' => $content,
			);
			return $output;
	}


  } //end class
} //end if class not exists
?>